<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
{
    if (session('is_admin_logged_in')) {
        return redirect()->route('admin.dashboard');
    }

    return view('admin.login');
}

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari admin di database berdasarkan kolom 'usn'
        $admin = Admin::where('usn', $request->username)->first();

        // Cek apakah admin ditemukan dan password-nya cocok
        if ($admin && Hash::check($request->password, $admin->pw)) {
            // Simpan data admin ke dalam session
            session([
                'is_admin_logged_in' => true,
                'admin_id'           => $admin->id,
                'nama_lengkap'       => $admin->nama_lengkap,
                'asal_sekolah'       => $admin->asal_sekolah,
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Username atau password salah!'])->withInput();
    }

    public function logout()
    {
        session()->forget(['is_admin_logged_in', 'admin_id', 'nama_lengkap', 'asal_sekolah']);
        return redirect()->route('admin.login');
    }
}