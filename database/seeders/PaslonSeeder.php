<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paslon;

class PaslonSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['no_urut' => 1, 'nama_paslon' => 'Difas & Chikita', 'suara' => 0],
            ['no_urut' => 2, 'nama_paslon' => 'Syarif & Ellen', 'suara' => 0],
            ['no_urut' => 3, 'nama_paslon' => 'Bintang & Raffa', 'suara' => 0],
        ];

        foreach ($data as $paslon) {
            Paslon::updateOrCreate(['no_urut' => $paslon['no_urut']], $paslon);
        }
    }
}