<?php

namespace Database\Seeders;

use App\Models\Child;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Child::create([
            'parent_id' => 2,
            'name' => 'Yanto Gimank',
            'age' => 17,
            'gender' => 'Laki-laki',
            'allergy' => 'Kacang, Susu',
            'notes' => 'Anaknya sering rewel kalo bangun tidur'
        ]);
    }
}
