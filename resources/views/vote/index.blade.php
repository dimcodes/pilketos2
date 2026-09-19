@extends('layouts.app')

@section('title', 'Bilik Suara - E-Voting OSIS')

@push('styles')
<style>
    .vote-wrapper {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
        padding: 32px 20px;
    }

    .voter-banner {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        box-shadow: var(--shadow-sm);
    }

    .voter-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .voter-avatar {
        width: 44px;
        height: 44px;
        background: var(--sky-bg);
        border: 1px solid var(--sky-border);
        color: var(--sky-main);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .voter-details h2 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
    }

    .voter-details p {
        font-size: 13px;
        color: var(--text-muted);
    }

    .section-title {
        text-align: center;
        margin-bottom: 28px;
    }

    .section-title h1 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-main);
    }

    .section-title p {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .paslon-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }

    .paslon-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s, border-color 0.2s;
    }

    .paslon-card:hover {
        transform: translateY(-4px);
        border: 2px solid #7887cf;
        box-shadow: 2px 3px 10px rgba(0,0,0, 0.12);
        background: rgba(0,0,0, 0.01);
    }

    .paslon-number {
        display: inline-block;
        padding: 4px 14px;
        background: var(--sky-bg);
        color: var(--sky-main);
        border: 1px solid var(--sky-border);
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 16px;
        align-self: center;
    }

    .paslon-poster {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid var(--border);
        margin-bottom: 16px;
    }

    .paslon-name {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 16px;
    }

    /* Section Visi & Misi */
    .visi-misi-box {
        text-align: left;
        background: var(--bg-main);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
    }

    .visi-misi-title {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .visi-text {
        font-size: 13px;
        color: var(--text-main);
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .misi-list {
        font-size: 13px;
        color: var(--text-main);
        padding-left: 18px;
        line-height: 1.5;
    }

    .misi-list li {
        margin-bottom: 4px;
    }

    .btn-coblos {
        width: 100%;
        padding: 12px;
        background: #c81111;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-coblos:hover {
        background: #b41919;
    }

    @media (max-width: 640px) {
        .voter-banner {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="vote-wrapper">

    <div class="voter-banner">
        <div class="voter-info">
            <div class="voter-avatar">
                <i data-lucide="user" style="width: 22px; height: 22px;"></i>
            </div>
            <div class="voter-details">
                <h2>{{ session('voter_nama') }}</h2>
                <p>NISN: {{ session('voter_nisn') }} &bull; Kelas: {{ session('voter_kelas') }}</p>
            </div>
        </div>
    </div>

    <div class="section-title">
        <h1>paslon Ketua & Wakil Ketua OSIS</h1>
        <p>Pilih salah satu paslon di bawah ini dengan menekan tombol pilih paslon</p>
    </div>

    @if($errors->any())
        <div style="background-color: #ffe4e6; border: 1px solid #fecdd3; color: #e11d48; padding: 12px; border-radius: 10px; font-size: 13px; margin-bottom: 24px; text-align: center;">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="paslon-grid">
        @forelse($paslonList as $paslon)
            <div class="paslon-card">
                <div>
                    <span class="paslon-number">Paslon #{{ sprintf('%02d', $paslon->no_urut) }}</span>
                    <img src="{{ $paslon->foto ? asset('storage/'.$paslon->foto) : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80' }}" 
                         alt="Poster {{ $paslon->nama_paslon }}" 
                         class="paslon-poster">
                    <h3 class="paslon-name">{{ $paslon->nama_paslon }}</h3>
                    <div class="visi-misi-box">
                        <div class="visi-misi-title">
                            <i data-lucide="target" style="width: 14px; height: 14px;"></i>
                            <span>Visi</span>
                        </div>
                        <p class="visi-text">
                            {{ $paslon->visi ?? 'Mewujudkan OSIS SMK Wikrama 1 Jepara yang aktif, inovatif, berintegritas, serta berlandaskan nilai-nilai karakter mulia.' }}
                        </p>

                        <div class="visi-misi-title">
                            <i data-lucide="list-checks" style="width: 14px; height: 14px;"></i>
                            <span>Misi</span>
                        </div>
                        <ul class="misi-list">
                            @if(!empty($paslon->misi))
                                @foreach(explode("\n", $paslon->misi) as $misiItem)
                                    @if(trim($misiItem) != '')
                                        <li>{{ $misiItem }}</li>
                                    @endif
                                @endforeach
                            @else
                                <li>Meningkatkan partisipasi siswa dalam kegiatan keahlian & seni.</li>
                                <li>Membangun komunikasi yang terbuka antara siswa dan pihak sekolah.</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <form id="vote-form-{{ $paslon->id }}" method="POST" action="{{ route('vote.store') }}">
                    @csrf
                    <input type="hidden" name="paslon_id" value="{{ $paslon->id }}">
                    <button type="submit" 
                            class="btn-coblos" 
                            data-paslon-no="{{ sprintf('%02d', $paslon->no_urut) }}"
                            data-paslon-nama="{{ $paslon->nama_paslon }}">
                        <i data-lucide="check-circle-2" style="width: 18px; height: 18px;"></i>
                        <span>Pilih Paslon Ini</span>
                    </button>
                </form>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; color: var(--text-muted); padding: 40px;">
                Belum ada data paslon yang terdaftar.
            </div>
        @endforelse
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const coblosButtons = document.querySelectorAll('.btn-coblos');

        coblosButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const nomor = this.dataset.paslonNo;
                const nama = this.dataset.paslonNama;
                const form = this.closest('form');

                Swal.fire({
                    title: 'Konfirmasi Pilihan',
                    html: `Apakah Anda yakin ingin memilih <br><b>Paslon #${nomor} - ${nama}</b>?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#16a34a',
                    cancelButtonColor: '#dc2626', 
                    confirmButtonText: 'Ya, Yakin!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-xl px-5 py-2.5 font-medium',
                        cancelButton: 'rounded-xl px-5 py-2.5 font-medium'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush