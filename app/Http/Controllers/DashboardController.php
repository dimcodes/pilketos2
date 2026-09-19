<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilih;
use App\Models\Paslon;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('is_admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Data Utama Pemilih (DPT)
        $totalDpt = Pemilih::count();
        $suaraMasuk = Pemilih::where('sudah_memilih', true)->count();
        $belumMemilih = $totalDpt - $suaraMasuk;
        $persentaseMasuk = $totalDpt > 0 ? round(($suaraMasuk / $totalDpt) * 100, 1) : 0;

        // Data Paslon & Perolehan Suara
        $badgeStyles = [
            1 => ['bg' => 'var(--sky-bg)', 'color' => '#0284c7', 'border' => 'var(--sky-border)'],
            2 => ['bg' => 'var(--emerald-bg)', 'color' => '#059669', 'border' => 'var(--emerald-border)'],
            3 => ['bg' => 'var(--amber-bg)', 'color' => '#d97706', 'border' => 'var(--amber-border)'],
        ];

        $paslonData = Paslon::orderBy('suara', 'desc')
                    ->orderBy('no_urut', 'asc')
                    ->get();

$paslonList = $paslonData->map(function ($paslon, $index) use ($suaraMasuk, $badgeStyles) {
    $noUrut = $paslon->no_urut;
    $peringkat = $index + 1; 
    $persentase = $suaraMasuk > 0 ? round(($paslon->suara / $suaraMasuk) * 100, 1) : 0;
    $style = $badgeStyles[$noUrut] ?? $badgeStyles[1];

    return [
        'peringkat'    => sprintf('%02d', $peringkat),
        'no_urut'      => sprintf('%02d', $noUrut),
        'nama'         => $paslon->nama_paslon,
        'suara'        => $paslon->suara,
        'persentase'   => $persentase,
        'badge_bg'     => $style['bg'],
        'badge_color'  => $style['color'],
        'badge_border' => $style['badge_border'] ?? $style['border'],
    ];
});

        // Partisipasi Suara Angkatan
        $tingkatList = [
            ['kode' => 'X', 'label' => 'Kelas X', 'color' => 'var(--sky-main)'],
            ['kode' => 'XI', 'label' => 'Kelas XI', 'color' => 'var(--emerald-main)'],
            ['kode' => 'XII', 'label' => 'Kelas XII', 'color' => 'var(--amber-main)'],
        ];

        $partisipasiAngkatan = [];

        foreach ($tingkatList as $item) {
            $totalTingkat = Pemilih::where(function ($query) use ($item) {
        $query->where('kelas', 'LIKE', $item['kode'] . ' %')
              ->orWhere('kelas', $item['kode']);
    })
    ->count();

            $memilihTingkat = Pemilih::where(function ($query) use ($item) {
                    $query->where('kelas', 'LIKE', $item['kode'] . ' %')
                          ->orWhere('kelas', $item['kode']);
                })
                ->where('sudah_memilih', true)
                ->count();

            $persen = $totalTingkat > 0 ? round(($memilihTingkat / $totalTingkat) * 100, 1) : 0;

            $partisipasiAngkatan[] = [
                'kelas'   => $item['label'],
                'memilih' => $memilihTingkat,
                'total'   => $totalTingkat,
                'persen'  => $persen,
                'color'   => $item['color'],
            ];
        }

        return view('admin.dashboard', compact(
            'totalDpt',
            'suaraMasuk',
            'belumMemilih',
            'persentaseMasuk',
            'paslonList',
            'partisipasiAngkatan'
        ));
    }
}