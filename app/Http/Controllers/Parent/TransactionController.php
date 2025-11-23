<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $transactions = Transaction::with(['booking.child'])
            ->whereHas('booking', function ($query) {
                $query->where('parent_id', Auth::id());
            })
            ->when($search, function ($query, $search) {
                $query->whereHas('booking.child', function ($childQuery) use ($search) {
                    $childQuery->where('name', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('parent.transaction.index', compact('transactions', 'search', 'status'));
    }

    public function qrView($id)
    {
        $transaction = Transaction::with(['booking.child', 'booking.parent'])->findOrFail($id);

        return view('parent.transaction.qr-view', [
            'transaction' => $transaction,
            'booking' => $transaction->booking,
        ]);
    }
}
