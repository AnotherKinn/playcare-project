<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function indexStaffReport()
    {
        return view('admin.reports.staff-report.index');
    }

    public function indexParentReview()
    {
        return view('admin.reports.parent-review.index');
    }

    public function indexIncomeReport()
    {
        return view('admin.reports.income-report.index');
    }

    public function indexChildrenReport()
    {
        return view('admin.reports.children-report.index');
    }
}
