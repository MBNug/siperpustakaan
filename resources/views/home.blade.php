@extends('layouts.guest')

@section('title', 'Absensi Pengunjung — SIPerpustakaan')

@section('content')
    <div class="kiosk-card">
        <div class="mb-4">
            <h1 class="page-title" style="font-size: 26px;">Catat Kunjungan Perpustakaan</h1>
            <p class="page-desc">Masukkan atau pilih NIS Anda untuk mencatat kehadiran hari ini di meja sirkulasi.</p>
        </div>

        @if (session('status'))
            <div class="desk-alert desk-alert-success" role="alert">
                <div>
                    <i class="fas fa-circle-check mr-2"></i>{{ session('status') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="desk-alert desk-alert-danger" role="alert">
                <div>
                    <i class="fas fa-triangle-exclamation mr-2"></i>{{ session('error') }}
                </div>
            </div>
        @endif

        <form action="{{ route('home.hadir') }}" method="POST" autocomplete="off">
            @csrf
            <div class="desk-field mb-3">
                <label for="nis" class="desk-label">Nomor Induk Siswa (NIS)</label>
                <input
                    id="nis"
                    name="nis"
                    list="niss"
                    type="text"
                    class="desk-input kiosk-input @error('nis') is-invalid @enderror"
                    placeholder="Ketik atau pilih NIS anggota..."
                    value="{{ old('nis') }}"
                    autofocus
                    required
                >
                <datalist id="niss">
                    @foreach ($members as $member)
                        <option value="{{ $member->nis }}">{{ $member->nama }}</option>
                    @endforeach
                </datalist>
                @error('nis')
                    <div class="text-danger mt-2" style="font-size: 13px;">{{ $message }}</div>
                @else
                    <div class="desk-help">Gunakan NIS yang terdaftar pada data keanggotaan perpustakaan.</div>
                @enderror
            </div>

            <button type="submit" class="btn-desk btn-desk-primary kiosk-submit">
                <i class="fas fa-user-check"></i>
                <span>Catat Kehadiran Sekarang</span>
            </button>
        </form>

        <div class="kiosk-stats">
            <div class="kiosk-stat-item">
                <div class="stat-label">Pengunjung Hari Ini</div>
                <div class="stat-value num mt-1" style="font-size: 24px;">{{ $todayStats->jumlah ?? 0 }}</div>
                <div class="stat-foot">{{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}</div>
            </div>
            <div class="kiosk-stat-item">
                <div class="stat-label">Total Judul Koleksi</div>
                <div class="stat-value num mt-1" style="font-size: 24px;">{{ $totalBooks ?? 0 }}</div>
                <div class="stat-foot">{{ $members->count() }} anggota terdaftar</div>
            </div>
        </div>
    </div>
@endsection
