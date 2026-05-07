@extends('layouts.app')
@section('title', 'Informasi Wisata — Citiis\'Go')

@section('content')

    <h2 class="section-title">Informasi Wisata Citiis</h2>
    <p class="section-sub">Citiis Galunggung terletak di kaki Gunung Galunggung, Tasikmalaya, Jawa Barat.</p>

    {{-- Tentang --}}
    <div class="card" style="padding:1.5rem; margin-bottom:1.5rem;">
        <h3 style="font-size:16px; font-weight:500; margin-bottom:.75rem;">Tentang Wisata</h3>
        <p style="font-size:14px; line-height:1.7; color:#6b7280;">
            Wisata Citiis Galunggung menawarkan pengalaman alam yang tak terlupakan dengan keindahan alam sekitar Gunung
            Galunggung.
            Tersedia berbagai fasilitas modern yang tetap mempertahankan nuansa alam asli.
            Tempat ini ideal untuk keluarga, rombongan, maupun solo traveler yang ingin menikmati keindahan alam
            Tasikmalaya.
        </p>
    </div>

    {{-- Harga Tiket --}}
    <h3 style="font-size:16px; font-weight:500; margin:1.5rem 0 .75rem;">Harga Tiket Masuk</h3>
    <div class="price-table">
        @foreach ($hargaTiket as $t)
            <div class="price-row">
                <span>{{ $t['tipe'] }}</span>
                <strong style="color:var(--green-dark);">{{ $t['harga'] }}</strong>
            </div>
        @endforeach
    </div>

    {{-- Fasilitas --}}
    <h3 style="font-size:16px; font-weight:500; margin:1.5rem 0 .75rem;">Fasilitas</h3>
    <div class="grid-sm">
        @foreach ($fasilitas as $f)
            <div class="card" style="padding:1rem; display:flex; gap:10px; align-items:flex-start;">
                <span style="font-size:20px;">{{ $f['icon'] }}</span>
                <div>
                    <strong style="font-size:13px; display:block;">{{ $f['title'] }}</strong>
                    <p style="font-size:12px; color:#6b7280; margin-top:2px;">{{ $f['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

@endsection
