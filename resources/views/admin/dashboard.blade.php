@extends('layouts.app')

@section('title', 'Dashboard - E-Voting OSIS')

@push('styles')
<style>
    body{
        background-image: 
        linear-gradient(180deg, rgba(252, 253, 253, 0.95) 0%, rgba(255, 251, 251, 0.93) 100%),
            url('{{ asset("img/lap_sekolah.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
    }
    .navbar { background-color: #ffffff; border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 100; }
    .navbar-content { max-width: 1280px; margin: 0 auto; padding: 0 24px; height: 68px; display: flex; align-items: center; justify-content: space-between; }
    .brand-box { display: flex; align-items: center; gap: 12px; }
    .brand-icon { width: 40px; height: 40px; background-color: var(--sky-bg); border: 1px solid var(--sky-border); color: var(--sky-main); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
    .brand-title h2 { font-size: 15px; font-weight: 700; }
    .brand-title span { font-size: 11px; color: var(--text-muted); }
    .btn-logout { background: none; border: 1px solid var(--border); padding: 8px 12px; border-radius: 10px; color: var(--text-muted); cursor: pointer; display: flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; }
    .btn-logout:hover { color: #e11d48; border-color: #fecdd3; background-color: #fff1f2; }
    .main-container { max-width: 1280px; margin: 0 auto; padding: 32px 24px; width: 100%; flex: 1; }
    .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; }
    .page-header h1 { font-size: 24px; font-weight: 700; }
    .page-header p { font-size: 13px; color: var(--text-muted); margin-top: 4px; }
    .kpi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 28px; }
    .kpi-card { background-color: #ffffff; border: 1px solid var(--border); border-radius: 16px; padding: 20px; box-shadow: var(--shadow-sm); }
    .kpi-head { display: flex; justify-content: space-between; align-items: center; font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--text-muted); margin-bottom: 10px; }
    .kpi-num { font-size: 24px; font-weight: 700; color: var(--text-main); }
    .kpi-desc { font-size: 12px; color: var(--text-muted); margin-top: 4px; }
    .dashboard-layout { display: grid; grid-template-columns: 1.6fr 1fr; gap: 24px; }
    @media (max-width: 992px) { .dashboard-layout { grid-template-columns: 1fr; } }
    .card-box { background-color: #ffffff; border: 1px solid var(--border); border-radius: 16px; padding: 24px; box-shadow: var(--shadow-sm); margin-bottom: 24px; }
    .box-title { display: flex; justify-content: space-between; align-items: center; padding-bottom: 16px; border-bottom: 1px solid var(--border); margin-bottom: 20px; }
    .box-title h3 { font-size: 16px; font-weight: 700; }
    .box-title p { font-size: 12px; color: var(--text-muted); }
    .chart-height { position: relative; height: 420px; width: 100%; }
    .class-stat-item { margin-bottom: 16px; }
    .class-stat-head { display: flex; justify-content: space-between; font-size: 13px; font-weight: 600; margin-bottom: 6px; }
    .progress-bg { height: 8px; background-color: #ebebeb; border-radius: 10px; overflow: hidden; }
    .progress-fill { height: 100%; border-radius: 10px; }
    .paslon-card { border: 1px solid var(--border); border-radius: 12px; padding: 14px 16px; margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between; background-color: #ffffff; }
    .paslon-left { display: flex; align-items: center; gap: 14px; }
    .paslon-badge { width: 40px; height: 40px; border-radius: 10px; font-weight: 700; font-size: 15px; display: flex; align-items: center; justify-content: center; }
    .paslon-details h4 { font-size: 14px; font-weight: 700; }
    .paslon-details p { font-size: 12px; color: var(--text-muted); }
    .paslon-right { text-align: right; }
    .paslon-right .vote-count { font-size: 15px; font-weight: 700; }
    .paslon-right .vote-pct { font-size: 12px; color: var(--text-muted); }
    .footer { border-top: 1px solid var(--border); background-color: #ffffff; padding: 20px; text-align: center; font-size: 12px; color: var(--text-muted); margin-top: 40px; }
</style>
@endpush

@section('content')
<header class="navbar">
    <div class="navbar-content">
        <div class="brand-box">
            <div class="brand-icon">
                <i data-lucide="vote" style="width:22px; height:22px;"></i>
            </div>
            <div class="brand-title">
                <h2>{{ session('nama_lengkap', 'Admin Pilketos') }}</h2>
                <span>{{ session('asal_sekolah', 'SMK Wikrama 1 Jepara') }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i data-lucide="log-out" style="width:16px; height:16px;"></i>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</header>

<main class="main-container">
    <div class="page-header">
        <div>
            <h1>Hasil Rekapitulasi Pemilihan</h1>
            <p>Pemantauan perolehan suara ketua & wakil ketua OSIS periode {{ date('Y') }}/{{ date('Y')+1 }}.</p>
        </div>
    </div>

    <!-- KPI Summary Cards -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-head">
                <span>Jumlah Paslon</span>
                <i data-lucide="user-check" style="width:18px; height:18px; color: var(--sky-main);"></i>
            </div>
            <div class="kpi-num">{{ count($paslonList) }} Pasangan</div>
            <div class="kpi-desc">Kandidat Ketua & Wakil OSIS</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <span>Total DPT</span>
                <i data-lucide="users" style="width:18px; height:18px; color: var(--sky-main);"></i>
            </div>
            <div class="kpi-num">{{ number_format($totalDpt) }}</div>
            <div class="kpi-desc">Guru & Siswa memiliki hak pilih</div>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <span>Suara Masuk</span>
                <i data-lucide="check-circle-2" style="width:18px; height:18px; color: var(--emerald-main);"></i>
            </div>
            <div class="kpi-num" style="color: var(--emerald-main);">{{ number_format($suaraMasuk) }}</div>
            <div class="kpi-desc">Partisipasi mencapai <b>{{ $persentaseMasuk }}%</b></div>
        </div>

        <div class="kpi-card">
            <div class="kpi-head">
                <span>Belum Memilih</span>
                <i data-lucide="clock" style="width:18px; height:18px; color: var(--amber-main);"></i>
            </div>
            <div class="kpi-num" style="color: var(--amber-main);">{{ number_format($belumMemilih) }}</div>
            <div class="kpi-desc">Sebanyak <b>{{ round(100 - $persentaseMasuk, 1) }}%</b> belum memilih</div>
        </div>
    </div>

    <div class="dashboard-layout">
        <div>
            <div class="card-box" style="margin-bottom: 0;">
                <div class="box-title">
                    <div>
                        <h3>Perolehan Suara Paslon</h3>
                        <p>Perbandingan jumlah suara aktual antar pasangan calon</p>
                    </div>
                </div>
                <div class="chart-height">
                    <canvas id="voteChart"></canvas>
                </div>
            </div>
        </div>

        <div>
            <div class="card-box">
                <div class="box-title">
                    <div>
                        <h3>Peringkat Perolehan</h3>
                        <p>Detail angka pasangan calon</p>
                    </div>
                </div>

                @foreach($paslonList as $paslon)
<div class="paslon-card" @if($loop->last) style="margin-bottom:0;" @endif>
    <div class="paslon-left">
        <div class="paslon-badge" style="background-color: {{ $paslon['badge_bg'] }}; color: {{ $paslon['badge_color'] }}; border: 1px solid {{ $paslon['badge_border'] }};">
            {{ $paslon['peringkat'] }}
        </div>
        <div class="paslon-details">
            <h4>{{ $paslon['nama'] }}</h4>
            <p>Paslon Nomor Urut {{ $paslon['no_urut'] }}</p>
        </div>
    </div>
    <div class="paslon-right">
        <div class="vote-count" style="color: {{ $paslon['badge_color'] }};">{{ $paslon['suara'] }}</div>
        <div class="vote-pct">{{ $paslon['persentase'] }}%</div>
    </div>
</div>
@endforeach
            </div>
            <div class="card-box" style="margin-bottom: 0;">
                <div class="box-title">
                    <div>
                        <h3>Partisipasi Per Angkatan</h3>
                        <p>Persentase suara masuk tiap tingkat</p>
                    </div>
                </div>

                @foreach($partisipasiAngkatan as $item)
                <div class="class-stat-item" @if($loop->last) style="margin-bottom: 0;" @endif>
                    <div class="class-stat-head">
                        <span>{{ $item['kelas'] }}</span>
                        <span>{{ $item['memilih'] }} / {{ $item['total'] }} ({{ $item['persen'] }}%)</span>
                    </div>
                    <div class="progress-bg">
                        <div class="progress-fill" style="width: {{ $item['persen'] }}%; background-color: {{ $item['color'] }};"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>

<footer class="footer">
    Panel E-Voting Pemilihan Ketua OSIS &bull; Dim Dev
</footer>
@endsection


@push('scripts')
    @vite(['resources/js/dashboard.js'])

    <script>
        // ngirim data
        window.paslonData = @json($paslonList);
    </script>
@endpush