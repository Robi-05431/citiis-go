@extends('layouts.app')
@section('title', 'Penginapan — Citiis\'Go')

@section('content')

    <h2 class="section-title">Penginapan</h2>
    <p class="section-sub">Pilih penginapan yang sesuai kebutuhan Anda. Cek ketersediaan real-time di bawah ini.</p>

    <div class="grid-auto">
        @foreach ($penginapan as $item)
            <x-card-penginapan :penginapan="$item" />
        @endforeach
    </div>

@endsection
