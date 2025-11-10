<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        // Ambil semua data transaksi, bisa ditambah pagination nanti
        $transactions = Transaction::with(['booking', 'user'])->latest()->paginate(10);

        // Kirim ke view
        return view('admin.transaction.index', compact('transactions'));
    }
}
