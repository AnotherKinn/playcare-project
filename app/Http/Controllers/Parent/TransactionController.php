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
        // Ambil parameter pencarian dan filter dari request
        $search = $request->input('search');
        $status = $request->input('status');

        // Ambil transaksi milik parent yang sedang login
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
}
