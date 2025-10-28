<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

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

        // Statistik ringkas
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'menunggu')->count(),
            'approved' => Booking::where('status', 'disetujui')->count(),
            'rejected' => Booking::where('status', 'ditolak')->count(),
            'finished' => Booking::where('status', 'selesai')->count(),
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
            'status' => 'required|in:disetujui,ditolak,menunggu',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = 'disetujui';
        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Status booking berhasil diperbarui!');
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
        $booking->status = 'ditugaskan';
        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Staff berhasil ditugaskan!');
    }

    /**
     * Tandai booking sudah selesai (biasanya dari laporan staff).
     */
    public function markAsFinished($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'selesai';
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
