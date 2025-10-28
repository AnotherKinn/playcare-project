<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return view('admin.data-staff.index');
    }

    public function create()
    {
        return view('admin.data-staff.create');
    }

    public function edit($id)
    {
        return view('admin.data-staff.edit');
    }

    public function store()
    {

    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }

}
