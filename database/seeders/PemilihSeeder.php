<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemilih;

class PemilihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataPemilih = [
            [
                'nisn'          => '24140000',
                'nama'          => 'Ahmad Fardan Adhim',
                'kelas'         => 'XI PPLG 2',
                'tanggal_lahir' => '2008-01-30',
                'sudah_memilih' => false,
            ],
        ];

        foreach ($dataPemilih as $pemilih) {
            Pemilih::updateOrCreate(
                ['nisn' => $pemilih['nisn']],
                $pemilih
            );
        }
    }
}