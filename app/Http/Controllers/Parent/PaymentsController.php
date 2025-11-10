<?php

namespace App\Http\Controllers\Parent;

use App\Events\PaymentUploaded;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
            'payment_method' => 'required|in:cod,dana,bca,mandiri',
        ]);

        // Ambil booking terkait dan pastikan milik parent yang login
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

        // Generate kode transaksi unik
        $lastId = Transaction::max('id') ?? 0;
        $transactionCode = 'TRX' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        // Update transaksi
        $transaction->update([
            'transaction_code' => $transactionCode,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        // 🔔 Buat notifikasi baru untuk parent
        Notification::create([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'transaction_id' => $transaction->id,
            'type_notification' => 'information', // tipe notifikasi
        ]);

        return redirect()
            ->route('parent.booking.index')
            ->with('success', 'Pembayaran berhasil dilakukan, silahkan upload detail pembayaran!');
    }

    /**
     * 🧾 Form Upload Bukti Pembayaran
     */
    public function uploadForm($id)
    {
        $transaction = \App\Models\Transaction::findOrFail($id);

        return view('parent.transaction.upload', compact('transaction'));
    }

    /**
     * 💳 Simpan Bukti Pembayaran
     */
    public function uploadStore(Request $request, $id)
    {
        $transaction = \App\Models\Transaction::findOrFail($id);

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan file bukti pembayaran
        $path = $request->file('payment_proof')->store('payment_proof', 'public');

        // Update transaksi
        $transaction->update([
            'payment_proof' => $path,
            'status' => 'pending_verification',
        ]);

        event(new PaymentUploaded($transaction));
        Log::info('✅ Event PaymentUploaded dikirim untuk transaksi ID: '.$transaction->id);

        return redirect()->route('parent.notifications.index')->with('success', 'Bukti pembayaran berhasil diupload!');
    }
}
