<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Data dummy staff
        $staff = [
            'id' => 1,
            'nama' => 'Rina Hartati',
            'jabatan' => 'Pengasuh Anak',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '1998-03-12',
            'telepon' => '0812-3456-7890',
            'alamat' => 'Jl. Melati No. 45, Bandung',
            'email' => 'rina.hartati@playcare.com',
            'username' => 'rinahartati98',
            'status' => 'Aktif',
            'foto' => 'https://via.placeholder.com/100',
            'bergabung_sejak' => 'Februari 2024',
            'tugas_selesai' => 32,
            'laporan_dibuat' => 15,
            'booking_ditangani' => 28,
        ];

        return view('staff.profile.index', compact('staff'));
    }

    public function edit($id)
    {
        // Data dummy staff (bisa pakai data yang sama dengan index)
        $staff = [
            'id' => $id,
            'nama' => 'Rina Hartati',
            'jabatan' => 'Pengasuh Anak',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '1998-03-12',
            'telepon' => '0812-3456-7890',
            'alamat' => 'Jl. Melati No. 45, Bandung',
            'email' => 'rina.hartati@playcare.com',
            'username' => 'rinahartati98',
            'status' => 'Aktif',
            'foto' => 'https://via.placeholder.com/100',
        ];

        return view('staff.profile.edit', compact('staff'));
    }
}
