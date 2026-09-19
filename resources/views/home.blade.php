@extends('layouts.app')

@section('title', 'E-Voting OSIS - SMK Wikrama 1 Jepara')

@push('styles')
<style>
    body {
        justify-content: space-between;
        align-items: center;
        background-image: 
        linear-gradient(180deg, rgba(252, 253, 253, 0.91) 0%, rgba(255, 251, 251, 0.93) 100%),
            url('{{ asset("img/lap_sekolah.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
    }

    .admin-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--text-muted);
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 8px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        transition: all 0.2s ease;
        box-shadow: var(--shadow-sm);
    }

    .admin-link:hover {
        color: var(--sky-main);
        border-color: var(--sky-border);
        background: var(--sky-bg);
    }

    .main-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        width: 100%;
        max-width: 620px;
    }

    .hero-card {
        width: 100%;
        background: rgba(255,255,255, 0.5);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 40px 32px;
        text-align: center;
        box-shadow: var(--shadow-lg);
        backdrop-filter: blur(8px);
    }

    .badge-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: var(--sky-bg);
        border: 1px solid var(--sky-border);
        border-radius: 20px;
        color: var(--sky-main);
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .hero-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 12px;
    }

    .hero-subtitle {
        font-size: 15px;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 32px;
    }

    .btn-voter-login {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 14px 20px;
        background: var(--sky-main);
        color: #ffffff;
        font-weight: 600;
        font-size: 15px;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.2s ease;
        box-shadow: var(--shadow-sm);
    }

    .btn-voter-login:hover {
        background: var(--sky-hover);
    }

    .footer {
        padding: 24px;
        text-align: center;
        font-size: 13px;
        color: var(--text-muted);
    }

    @media (max-width: 480px) {
        .hero-card {
            padding: 28px 20px;
        }
        .hero-title {
            font-size: 22px;
        }
    }
</style>
@endpush

@section('content')

@if (session('success'))
    <div 
        x-cloak
        x-data="{ show: false }"
        x-init="
            setTimeout(() => { show = true }, 250);
            setTimeout(() => { show = false }, 4000);
        "
        x-show="show"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
        style="position: fixed; top: 20px; left: 0; right: 0; margin-left: auto; margin-right: auto; z-index: 999;"
        class="max-w-md w-full p-4 text-sm text-green-800 rounded-xl bg-green-50/95 border border-green-200 flex items-center justify-between shadow-lg backdrop-blur-sm"
        role="alert">
        
        <div class="flex items-center gap-2.5">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-600 flex-shrink-0"></i>
            <span class="font-medium leading-snug">{{ session('success') }}</span>
        </div>
    </div>
@endif
    <main class="main-container">
        <div class="hero-card">
            <div class="badge-tag">
                <span>OSIS Periode 2026/2027</span>
            </div>

            <h1 class="hero-title">Selamat Datang</h1>
            
            <p class="hero-subtitle">
                Di website Pemilihan Ketua OSIS <span class="school-highlight">SMK Wikrama 1 Jepara</span>.<br>
                Silakan login untuk menentukan hak pilih dan kandidat pilihanmu.
            </p>

            <a href="{{ route('login') }}" class="btn-voter-login">
                <i data-lucide="log-in" style="width:18px; height:18px;"></i>
                <span>Login untuk Memilih Kandidat</span>
            </a>
        </div>
    </main>

    <footer class="footer">
     E-Voting OSIS System &copy; {{ date('Y') }} &bull; SMK Wikrama 1 Jepara
    </footer>
@endsection