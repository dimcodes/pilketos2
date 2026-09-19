<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilih;
use Illuminate\Support\Facades\Hash;

class VoterAuthController extends Controller
{
    /**
     * Menampilkan halaman login untuk pemilih.
     */
    public function showLoginForm()
    {
        if (session('is_voter_logged_in')) {
            return redirect()->route('vote.index');
        }

        return view('auth.login');
    }

    /**
     * Memproses autentikasi pemilih.
     */
    public function login(Request $request)
{
    // Validasi Input
    $request->validate([
        'nisn'          => 'required',
        'tanggal_lahir' => 'required|date',
    ], [
        'nisn.required'          => 'Nomor NISN wajib diisi!',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi!',
        'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid!',
    ]);

    // Cari Pemilih di Database
    $pemilih = Pemilih::where('nisn', $request->nisn)->first();

    // Cek Kecocokan Data (NISN & Tanggal Lahir)
    if (!$pemilih || $pemilih->tanggal_lahir !== $request->tanggal_lahir) {
        return back()->withErrors(['login' => 'NISN atau Tanggal Lahir tidak cocok!'])->withInput();
    }

    // Cek Jika Sudah Pernah Memilih
    if ($pemilih->sudah_memilih) {
        return back()->withErrors(['login' => 'Anda sudah menggunakan hak pilih Anda!'])->withInput();
    }

    // Set Session Login Pemilih
    session([
        'is_voter_logged_in' => true,
        'voter_id'           => $pemilih->id,
        'voter_nisn'         => $pemilih->nisn,
        'voter_nama'         => $pemilih->nama,
        'voter_kelas'        => $pemilih->kelas,
    ]);

    return redirect()->route('vote.index');
}
}