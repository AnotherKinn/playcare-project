<?php

namespace App\Http\Controllers\Admin;

use App\Events\BookingVerified;
use App\Events\StaffAssigned;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar semua booking untuk admin.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $bookings = Booking::with(['parent', 'child', 'transaction', 'staff'])
            ->when($search, function ($query, $search) {
                $query->whereHas('parent', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('child', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();
        // di BookingController@index (atau saat loop di view)
        $bookings = Booking::with(['transaction'])->get();

        // contoh saat mengirim ke view, kamu bisa juga map urlnya:
        // not required — bisa dipanggil langsung di blade
        foreach ($bookings as $b) {
            // $b->transaction->payment_proof = 'payment_proof/xxx.jpg'
            $b->proof_url = $b->transaction?->payment_proof
                ? Storage::url($b->transaction->payment_proof)
                : null;
        }

        // Statistik ringkas
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'approved' => Booking::where('status', 'approved')->count(),
            'rejected' => Booking::where('status', 'cancelled')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
        ];

        $staffs = User::where('role', 'staff')->get();

        return view('admin.booking.index', compact('bookings', 'stats', 'staffs'));
    }

    /**
     * Verifikasi booking: disetujui atau ditolak.
     */
    public function verify(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable|in:disetujui,ditolak,menunggu',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        Notification::create([
            'user_id' => $booking->parent_id,
            'booking_id' => $booking->id,
            'type_notification' => 'information',
            'message' => $booking->status === 'approved'
                ? 'Booking kamu sudah disetujui oleh admin.'
                : 'Booking kamu ditolak oleh admin.',
        ]);


        broadcast(new BookingVerified($booking->parent_id, 'approved', 'Booking kamu sudah disetujui!'));


        return redirect()->route('admin.booking.index')->with('success', 'Status booking berhasil diperbarui!');
    }

    public function rejected(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable|in:disetujui,ditolak,menunggu',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        Notification::create([
            'user_id' => $booking->parent_id,
            'booking_id' => $booking->id,
            'type_notification' => 'information',
            'message' => $booking->status === 'approved'
                ? 'Booking kamu sudah disetujui oleh admin.'
                : 'Booking kamu ditolak oleh admin.',
        ]);

        broadcast(new BookingVerified($booking->parent_id, 'cancelled', 'Booking kamu gagal diverifikasi admin!'));


        return redirect()->route('admin.booking.index')->with('success', 'Status booking berhasil ditolak!');
    }

    /**
     * Tampilkan form assign staff ke booking.
     */
    public function assignForm($id)
    {
        $booking = Booking::with(['parent', 'child'])->findOrFail($id);
        $staffs = User::where('role', 'staff')->get();

        return view('admin.booking.assign', compact('booking', 'staffs'));
    }

    /**
     * Proses assign staff ke booking.
     */
    public function assignStaff(Request $request, $id)
    {
        $request->validate([
            'staff_id' => 'required|exists:users,id',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->staff_id = $request->staff_id;
        $booking->status = 'assigned';
        $booking->save();

        // kirim event real-time ke staff terkait
        event(new StaffAssigned($booking, Auth::user()->name));

        return redirect()->route('admin.booking.index')->with('success', 'Staff berhasil ditugaskan!');
    }


    /**
     * Tandai booking sudah selesai (biasanya dari laporan staff).
     */
    public function markAsFinished($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'completed';
        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil ditandai selesai!');
    }

    /**
     * Hapus data booking (opsional, kalau admin ingin menghapus data lama).
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.booking.index')->with('success', 'Data booking berhasil dihapus!');
    }
}
