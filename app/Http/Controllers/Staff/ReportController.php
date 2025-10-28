<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('staff.report.index');
    }

    public function create()
    {
        return view('staff.report.create');
    }

    public function edit($id)
    {
        return view('staff.report.edit');
    }
}
