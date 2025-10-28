<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '082329453188',
            'address' => 'Ciangsana'
        ]);

        User::create([
            'name' => 'Parent 1',
            'email' => 'parent@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'parent',
            'phone' => '082329452190',
            'address' => 'Ciangsana'
        ]);

        User::create([
            'name' => 'Staff 1',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'phone' => '082329453244',
            'address' => 'Ciangsana'
        ]);
    }
}
