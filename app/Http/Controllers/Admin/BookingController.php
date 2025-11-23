<?php

namespace App\Http\Controllers\Admin;

use App\Events\BookingVerified;
use App\Events\StaffAssigned;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\StaffSchedule;
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
        $query = Booking::with(['parent', 'child', 'transaction']);

        // 🔍 Fitur pencarian (case-insensitive)
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('parent', function ($sub) use ($search) {
                    $sub->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                })->orWhereHas('child', function ($sub) use ($search) {
                    $sub->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                });
            });
        }

        // 🔥 Filter booking yang:
        // 1. Status transaksi = pending_verification
        // 2. ATAU status booking termasuk: approved, in_progress, assigned, completed
        $query->where(function ($q) {
            $q->whereHas('transaction', function ($t) {
                $t->where('status', 'pending_verification');
            })
                ->orWhere(function ($b) {
                    $b->whereIn('status', [
                        'approved',
                        'in_progress',
                        'assigned',
                        'completed'
                    ]);
                });
        });

        // 🔽 Urutkan & paginate
        $bookings = $query->latest()->paginate(10)->withQueryString();

        // 🔗 Tambahkan URL bukti pembayaran
        foreach ($bookings as $b) {
            $b->proof_url = $b->transaction?->payment_proof
                ? Storage::url($b->transaction->payment_proof)
                : null;
        }

        // 📊 Statistik
        $stats = [
            'total'     => Booking::count(),
            'pending'   => Booking::whereHas('transaction', fn($q) => $q->where('status', 'pending_verification'))->count(),
            'approved'  => Booking::where('status', 'approved')->count(),
            'rejected'  => Booking::where('status', 'cancelled')->count(),
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
        // $request->validate([
        //     'status' => 'nullable|in:disetujui,ditolak,menunggu',
        // ]);

        $booking = Booking::with('transaction')->findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        if ($booking->transaction) {
            $booking->transaction->status = 'success';
            $booking->transaction->paid_at = now();
            $booking->transaction->save();
        }


        // Buat notifikasi ke parent
        Notification::create([
            'user_id' => $booking->parent_id,
            'booking_id' => $booking->id,
            'type_notification' => 'information',
            'message' => 'Booking kamu sudah disetujui oleh admin.',
        ]);

        // Broadcast event real-time
        broadcast(new BookingVerified($booking->parent_id, 'approved', 'Booking kamu sudah disetujui!'));

        return redirect()->route('admin.booking.index')->with('success', 'Status booking & transaksi berhasil diperbarui!');
    }

    public function rejected(Request $request, $id)
    {
        // $request->validate([
        //     'status' => 'nullable|in:disetujui,ditolak,menunggu',
        // ]);

        $booking = Booking::with('transaction')->findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        // Update status transaksi
        if ($booking->transaction) {
            $booking->transaction->status = 'failed';
            $booking->transaction->save();
        }

        // Buat notifikasi ke parent
        Notification::create([
            'user_id' => $booking->parent_id,
            'booking_id' => $booking->id,
            'type_notification' => 'information',
            'message' => 'Booking kamu ditolak oleh admin.',
        ]);

        // Broadcast event real-time
        broadcast(new BookingVerified($booking->parent_id, 'cancelled', 'Booking kamu gagal diverifikasi admin!'));

        return redirect()->route('admin.booking.index')->with('success', 'Status booking & transaksi berhasil ditolak!');
    }


    /**
     * Tampilkan form assign staff ke booking.
     */
    public function assignForm(Request $request, $id)
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
        $booking = Booking::with('transaction')->findOrFail($id);

        if (
            $booking->status === 'pending' ||
            ($booking->transaction && $booking->transaction->status === 'pending_verification')
        ) {
            return redirect()->back()->with('error', 'Booking belum diverifikasi!');
        }

        $request->validate([
            'staff_id' => 'required|exists:users,id',
        ]);

        // assign staff ke booking
        $booking->staff_id = $request->staff_id;
        $booking->status = 'assigned';
        $booking->save();

        // update atau buat staff schedule
        $staffSchedule = StaffSchedule::where('staff_id', $request->staff_id)
            ->whereNull('booking_id') // pastikan ambil slot kosong
            ->first();

        if ($staffSchedule) {
            $staffSchedule->update([
                'booking_id' => $booking->id,
                'status' => 'assigned',
            ]);
        } else {
            StaffSchedule::create([
                'staff_id' => $request->staff_id,
                'booking_id' => $booking->id,
                'status' => 'assigned',
            ]);
        }

        Notification::create([
            'user_id' => $request->staff_id,
            'booking_id' => $booking->id,
            'type_notification' => 'assigned_staff',
        ]);

        event(new StaffAssigned($booking, Auth::user()->name));

        return redirect()->route('admin.booking.index')->with('success', 'Staff berhasil ditugaskan!');
    }



    /**
     * Tandai booking sudah selesai (biasanya dari laporan staff).
     */
    public function markAsFinished(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'completed';
        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil ditandai selesai!');
    }

    /**
     * Hapus data booking (opsional, kalau admin ingin menghapus data lama).
     */
    public function destroy(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.booking.index')->with('success', 'Data booking berhasil dihapus!');
    }
}
