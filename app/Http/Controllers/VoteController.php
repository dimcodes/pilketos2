<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paslon;
use App\Models\Pemilih;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VoteController extends Controller
{
    public function index()
    {
        // Jika belum login
        if (!session('is_voter_logged_in')) {
            return redirect()->route('login');
        }

        $paslonList = Paslon::orderBy('no_urut', 'asc')->get();

        return view('vote.index', compact('paslonList'));
    }

    public function store(Request $request)
    {
        if (!session('is_voter_logged_in')) {
            return redirect()->route('login');
        }

        $request->validate([
            'paslon_id' => 'required|exists:paslons,id',
        ], [
            'paslon_id.required' => 'Pilih salah satu kandidat terlebih dahulu!',
        ]);

        $voterId = session('voter_id');

        try {
            DB::transaction(function () use ($request, $voterId) {

                $pemilih = Pemilih::where('id', $voterId)->lockForUpdate()->first();

                if (!$pemilih || $pemilih->sudah_memilih) {
                    throw ValidationException::withMessages([
                        'paslon_id' => 'Hak pilih Anda sudah digunakan atau sesi tidak valid.',
                    ]);
                }

                Paslon::where('id', $request->paslon_id)->increment('suara');

                $pemilih->update(['sudah_memilih' => true]);
            });
        } catch (ValidationException $e) {
            session()->forget(['is_voter_logged_in', 'voter_id', 'voter_nisn', 'voter_nama', 'voter_kelas']);

            return redirect()->route('login')->withErrors(['login' => $e->validator->errors()->first('paslon_id')]);
        }

        // langsung logout
        session()->forget(['is_voter_logged_in', 'voter_id', 'voter_nisn', 'voter_nama', 'voter_kelas']);

        return redirect()->route('home')->with('success', 'Terima kasih! Hak pilih Anda telah berhasil disimpan.');
    }
}