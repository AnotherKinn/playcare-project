<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class IncomeReportController extends Controller
{
    public function exportPdf()
    {
        // Ambil transaksi yang sukses saja
        $transactions = Transaction::with(['booking.parent', 'booking.child'])
            ->where('status', 'success')
            ->orderBy('paid_at', 'desc')
            ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // Total pendapatan per bulan (success only)
        $totals = Transaction::selectRaw('MONTH(paid_at) as month, SUM(amount) as total')
            ->where('status', 'success')
            ->groupBy('month')
            ->pluck('total', 'month');

        // Generate PDF
        $pdf = FacadePdf::loadView('admin.reports.income-report.pdf', [
            'transactions' => $transactions,
            'months'       => $months,
            'totals'       => $totals,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-keuangan.pdf');
    }
}
