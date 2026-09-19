@extends('layouts.app')

@section('title', 'Login - E-Voting OSIS')

@push('styles')
<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: linear-gradient(180deg, #fcfdfd 0%, #fffbfb 100%);
    }
    .login-card {
        width: 100%;
        max-width: 400px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 36px 32px;
        box-shadow: var(--shadow-lg);
    }
    .login-brand { display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 28px; }
    .login-logo {
        width: 50px; height: 50px; background-color: var(--sky-bg); border: 1px solid var(--sky-border);
        color: var(--sky-main); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;
    }
    .login-brand h1 { font-size: 20px; font-weight: 700; }
    .login-brand p { font-size: 13px; color: var(--text-muted); margin-top: 4px; }
    .form-group { margin-bottom: 18px; }
    .form-group label { display: block; font-size: 12px; font-weight: 600; margin-bottom: 8px; }
    .input-wrapper { position: relative; display: flex; align-items: center; width: 100%; }
    .input-wrapper i, .input-wrapper svg {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        color: var(--text-light); width: 18px; height: 18px; pointer-events: none;
    }
    .input-wrapper input {
        width: 100%; padding: 12px 14px 12px 44px; font-size: 14px;
        border: 1px solid var(--border); border-radius: 12px; background-color: var(--bg-main); outline: none; transition: all 0.2s;
    }
    .input-wrapper input:focus { border-color: var(--sky-main); background-color: #ffffff; box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1); }
    .btn-submit {
        width: 100%; padding: 12px; background-color: var(--sky-main); color: #ffffff;
        border: none; border-radius: 12px; font-size: 14px; font-weight: 600; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 8px;
    }
    .btn-submit:hover { background-color: var(--sky-hover); }
    .alert-error {
        font-weight: 500;
        background-color: #ffe4e6; border: 1px solid #fecdd3; color: #e11d48;
        padding: 10px; border-radius: 10px; font-size: 12.5px; margin-bottom: 16px; text-align: center;
    }
    .login-footer { margin-top: 28px; padding-top: 18px; border-top: 1px solid var(--border); text-align: center; font-size: 12px; color: var(--text-light); }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-brand">
            <div class="login-logo">
                <i data-lucide="vote" style="width: 26px; height: 26px;"></i>
            </div>
            <h1>Portal Admin PILKETOS</h1>
            <p>Masukkan akun resmi panitia pemilihan</p>
        </div>

       @if($errors->any())
    <div class="alert-error">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('admin.login.post') }}">
    @csrf
    <div class="form-group">
        <label>Username Panitia</label>
        <div class="input-wrapper">
            <input type="text" name="username" required value="{{ old('username') }}" placeholder="admin_pilketos" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            <i data-lucide="user"></i>
        </div>
    </div>

    <div class="form-group">
        <label>Kata Sandi</label>
        <div class="input-wrapper">
            <input type="password" name="password" required placeholder="••••••••">
            <i data-lucide="lock"></i>
        </div>
    </div>

    <button type="submit" class="btn-submit">
        <span>Masuk ke Dashboard Admin</span>
        <i data-lucide="arrow-right" style="width:16px; height:16px;"></i>
    </button>
</form>

        <div class="login-footer">
            E-Voting OSIS System &copy; {{ date('Y') }} &bull; SMK Wikrama 1 Jepara
        </div>
    </div>
</div>
@endsection