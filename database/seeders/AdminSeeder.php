<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'usn'          => 'adhim',
            'pw'           => Hash::make('adhim67'),
            'nama_lengkap' => 'Ahmad Fardan Adhim',
            'asal_sekolah' => 'SMK Wikrama 1 Jepara',
        ]);
    }
}