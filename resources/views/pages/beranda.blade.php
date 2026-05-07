@extends('layouts.app')
@section('title', 'Beranda — Citiis\'Go')

@section('content')

    {{-- HERO --}}
    <div class="hero">
        <p style="font-size:14px; opacity:.85; margin-bottom:8px;">Wisata Alam Tasikmalaya</p>
        <h1>Selamat Datang di<br><span>Citiis Galunggung</span></h1>
        <p>Nikmati keindahan alam Galunggung dengan penginapan nyaman, area camping eksklusif, dan layanan reservasi mudah.
        </p>
        <div class="hero-actions">
            <a href="{{ route('reservasi') }}" class="btn-primary" style="background:#fff; color:var(--green-dark);">Reservasi
                Sekarang</a>
            <a href="{{ route('informasi') }}" class="btn-ghost">Jelajahi Wisata</a>
        </div>
    </div>

    {{-- STATS --}}
    <div class="grid-3" style="margin-bottom:1.5rem;">
        @foreach ([['Penginapan', '12 Unit'], ['Area Camping', '8 Zona'], ['Peralatan Sewa', '50+ Item']] as [$label, $value])
            <div class="stat-card">
                <div class="stat-value">{{ $value }}</div>
                <div class="stat-label">{{ $label }}</div>
            </div>
        @endforeach
    </div>

    {{-- FASILITAS --}}
    <h2 style="font-size:20px; font-weight:500; margin:1.5rem 0 1rem;">Fasilitas Unggulan</h2>
    <div class="grid-sm" style="margin-bottom:1.5rem;">
        @foreach ($fasilitas as $f)
            <div class="card" style="padding:1.25rem 1rem;">
                <div style="font-size:24px; margin-bottom:8px;">{{ $f['icon'] }}</div>
                <strong style="font-size:14px; display:block; margin-bottom:4px;">{{ $f['title'] }}</strong>
                <p style="font-size:12px; color:#6b7280; line-height:1.5;">{{ $f['desc'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- CTA --}}
    <div class="cta-strip">
        <div>
            <strong style="color:var(--green-dark);">Siap merencanakan perjalananmu?</strong>
            <p style="font-size:13px; color:var(--green-dark); opacity:.8;">Pesan penginapan atau area camping sekarang</p>
        </div>
        <a href="{{ route('reservasi') }}" class="btn-primary" style="white-space:nowrap;">Buat Reservasi</a>
    </div>

@endsection
