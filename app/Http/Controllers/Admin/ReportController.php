<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffReport;
use App\Models\Review;
use App\Models\IncomeReport;
use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        // Hitung total laporan staff
        $totalStaffReports = \App\Models\Report::count();

        // Hitung total review parent
        $totalParentReviews = \App\Models\Review::count();

        // Hitung total pendapatan (semua transaksi yang success)
        $totalIncome = \App\Models\Transaction::where('status', 'success')->sum('amount');

        // Hitung total transaksi yang success
        $totalTransactions = \App\Models\Transaction::where('status', 'success')->count();

        return view('admin.reports.index', compact(
            'totalStaffReports',
            'totalParentReviews',
            'totalIncome',
            'totalTransactions'
        ));
    }


    public function indexStaffReport()
    {
        $childReport = Report::with(['child', 'booking'])->latest()->get();

        return view('admin.reports.staff-report.index', compact('childReport'));
    }

    public function indexParentReview()
    {
        // Ambil semua review, beserta relasi parent (user) dan booking
        $reviews = Review::with(['parent', 'booking'])
            ->latest()
            ->get();

        return view('admin.reports.parent-review.index', compact('reviews'));
    }


    public function indexIncomeReport()
    {
        // Ambil seluruh transaksi sukses dikelompokkan per bulan
        $monthlyIncome = Transaction::where('status', 'success')
            ->whereNotNull('paid_at')
            ->selectRaw('MONTH(paid_at) as month, YEAR(paid_at) as year, SUM(amount) as total_income')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $months = $monthlyIncome->map(function ($r) {
            return date('F', mktime(0, 0, 0, $r->month, 1)) . ' ' . $r->year;
        })->toArray();

        $totals = $monthlyIncome->pluck('total_income')
            ->map(fn($v) => (int) $v)
            ->values();

        // Transaksi list
        $transactions = Transaction::with(['booking.parent'])
            ->where('status', 'success')
            ->latest()
            ->get();

        return view('admin.reports.income-report.index', compact('months', 'totals', 'transactions'));
    }


    public function indexChildrenReport()
    {
        return view('admin.reports.children-report.index');
    }
}
