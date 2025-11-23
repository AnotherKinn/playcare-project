<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
     public function index(Request $request)
    {
        $search = $request->search;
        $statusTransaksi = $request->status_transaksi;
        $statusBooking = $request->status_booking;

        $transactions = Transaction::with(['booking', 'user'])
            // Filter status transaksi
            ->when($statusTransaksi, function ($q) use ($statusTransaksi) {
                $q->where('status', $statusTransaksi);
            })

            // Filter status booking
            ->when($statusBooking, function ($q) use ($statusBooking) {
                $q->whereHas('booking', function ($booking) use ($statusBooking) {
                    $booking->where('status', $statusBooking);
                });
            })

            // Fitur pencarian
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('id', 'LIKE', "%$search%")
                        ->orWhere('payment_method', 'LIKE', "%$search%")
                        ->orWhereHas('user', function ($u) use ($search) {
                            $u->where('name', 'LIKE', "%$search%");
                        })
                        ->orWhereHas('booking.child', function ($c) use ($search) {
                            $c->where('name', 'LIKE', "%$search%");
                        });
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.transaction.index', compact('transactions'));
    }
}
