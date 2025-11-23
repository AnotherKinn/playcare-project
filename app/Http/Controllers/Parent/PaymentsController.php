<?php

namespace App\Http\Controllers\Parent;

use App\Events\PaymentUploaded;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\Transaction;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
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

        $booking = Booking::with('child')
            ->where('parent_id', Auth::id())
            ->findOrFail($request->booking_id);

        // Ambil atau buat transaksi
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

        /**
         * ===============================
         * 🔥 Jika metode BANK → Generate VA
         * ===============================
         */
        $vaNumber = null;
        if (in_array($request->payment_method, ['bca', 'mandiri'])) {
            $vaNumber = $this->generateVaNumber();
        }

        /**
         * ===================================
         * 🔥 Jika metode DANA → Generate QRIS
         * ===================================
         */
        $qrBase64 = null;

        if ($request->payment_method === 'dana') {
            $paymentUrl = route('parent.transaction.qr-view', $transaction->id);

            $qr = (new Builder(writer: new PngWriter()))
                ->build(
                    data: $paymentUrl,
                    size: 300,
                    margin: 10
                );

            $qrBase64 = $qr->getDataUri();
        }

        // Update transaksi
        $transaction->update([
            'transaction_code' => $transactionCode,
            'payment_method' => $request->payment_method,
            'virtual_account' => $vaNumber,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        // Simpan notifikasi
        Notification::create([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'transaction_id' => $transaction->id,
            'type_notification' => 'information',
        ]);

        /**
         * ===================================
         * 🔥 Redirect dan kirim session sesuai metode
         * ===================================
         */

        // Jika BANK → tampilkan VA dummy
        if ($vaNumber) {
            return redirect()
                ->route('parent.payments.create', ['booking_id' => $booking->id])
                ->with('success_va', [
                    'payment_method' => $request->payment_method,
                    'kode_transaksi' => $transaction->transaction_code,
                    'va' => $vaNumber,
                ]);
        }

        // Jika DANA → tampilkan QR
        if ($request->payment_method === 'dana') {
            return redirect()
                ->route('parent.payments.create', ['booking_id' => $booking->id])
                ->with('success_payment', [
                    'payment_method' => $request->payment_method,
                    'kode_transaksi' => $transaction->transaction_code,
                    'qr_base64' => $qrBase64,
                ]);
        }

        // COD → tanpa apa-apa
        return redirect()
            ->route('parent.payments.create', ['booking_id' => $booking->id])
            ->with('success_cod', "Booking berhasil dipesan, jangan lupa upload bukti pembayaran ya");
    }

    /**
     * Generate 16 digit VA Dummy
     */
    private function generateVaNumber()
    {
        return '9' . str_pad(rand(0, 999999999999999), 15, '0', STR_PAD_LEFT);
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
        Log::info('✅ Event PaymentUploaded dikirim untuk transaksi ID: ' . $transaction->id);

        return redirect()->route('parent.notifications.index')->with('success', 'Bukti pembayaran berhasil diupload!');
    }
}
