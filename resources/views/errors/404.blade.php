@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - E-Voting OSIS')

@push('styles')
<style>
    body {
        justify-content: center;
        align-items: center;
        background-image: 
            linear-gradient(180deg, rgba(252, 253, 253, 0.94) 0%, rgba(255, 251, 251, 0.97) 100%),
            url('{{ asset("img/lap_sekolah.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
    }

    .error-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        width: 100%;
        max-width: 620px;
    }

    .error-card {
        width: 100%;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 48px 32px;
        text-align: center;
        box-shadow: var(--shadow-lg);
    }

    .error-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: var(--rose-bg);
        border: 1px solid var(--rose-border);
        color: var(--rose-main);
        margin-bottom: 24px;
    }

    .error-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 12px;
    }

    .error-subtitle {
        font-size: 15px;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 32px;
    }

    .btn-back-home {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 24px;
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

    .btn-back-home:hover {
        background: var(--sky-hover);
    }

    .footer {
        padding: 24px;
        text-align: center;
        font-size: 13px;
        color: var(--text-muted);
    }

    @media (max-width: 480px) {
        .error-card {
            padding: 32px 20px;
        }
        .error-title {
            font-size: 21px;
        }
    }
</style>
@endpush

@section('content')

    <main class="error-container">
        <div class="error-card">
            <div class="error-badge">
                <i data-lucide="search-x" style="width: 32px; height: 32px;"></i>
            </div>

            <h1 class="error-title">Error 404!</h1>

            <p class="error-subtitle">
                Halaman yang Anda cari tidak tersedia.<br>
                Silakan kembali ke beranda <span class="school-highlight">E-Voting OSIS</span>.
            </p>

            <a href="{{ route('home') }}" class="btn-back-home">
                <i data-lucide="home" style="width:18px; height:18px;"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </main>

    <footer class="footer">
       E-Voting OSIS System &copy; {{ date('Y') }} &bull; SMK Wikrama 1 Jepara
    </footer>
@endsection