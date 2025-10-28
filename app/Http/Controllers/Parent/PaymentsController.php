<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    public function create(Request $request)
    {
        // Ambil ID booking dari query (contoh: ?booking_id=12)
        $bookingId = $request->query('booking_id');

        $booking = Booking::with('child')
            ->where('parent_id', Auth::id())
            ->findOrFail($bookingId);

        // Cek apakah transaksi sudah dibuat sebelumnya
        $transaction = Transaction::firstOrCreate(
            ['booking_id' => $booking->id],
            [
                'status' => 'pending',
                'amount' => $booking->total_price,
            ]
        );

        return view('parent.payments.create', compact('booking', 'transaction'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:transfer_bank,qris,bayar_ditempat',
        ]);

        $booking = Booking::with('child')
            ->where('parent_id', Auth::id())
            ->findOrFail($request->booking_id);

        // Ambil atau buat transaksi pending
        $transaction = Transaction::firstOrCreate(
            ['booking_id' => $booking->id],
            [
                'status' => 'pending',
                'amount' => $booking->total_price,
            ]
        );

        // Generate kode transaksi
        $lastId = Transaction::max('id') ?? 0;
        $transactionCode = 'TRX' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        // Update transaksi
        $transaction->update([
            'transaction_code' => $transactionCode,
            'payment_method' => $request->payment_method,
            'status' => 'pending', // bisa ubah ke 'pending' dulu kalau mau diverifikasi manual
            'notes' => $request->notes,
        ]);

        return redirect()->route('parent.booking.index')
            ->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
