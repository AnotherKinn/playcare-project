<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role parent
        $parents = User::where('role', 'parent')->with('children')->latest()->get();

        return view('admin.data-parent.index', compact('parents'));
    }
}
