@extends('layouts.app')
@section('title', 'Camping — Citiis\'Go')

@section('content')

    <h2 class="section-title">Area Camping</h2>
    <p class="section-sub">Pilih zona camping dengan pemandangan terbaik. Ketersediaan diperbarui secara real-time.</p>

    <div style="margin-bottom:1.5rem;">
        @foreach ($camping as $zona)
            <x-card-camping :zona="$zona" />
        @endforeach
    </div>

@endsection
