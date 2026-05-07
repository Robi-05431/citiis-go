@extends('layouts.app')
@section('title', 'Sewa Peralatan — Citiis\'Go')

@section('content')

    <h2 class="section-title">Sewa Peralatan Camping</h2>
    <p class="section-sub">Lengkapi petualanganmu dengan peralatan camping berkualitas. Stok tersedia secara real-time.</p>

    <div class="grid-sm">
        @foreach ($peralatan as $alat)
            <x-card-peralatan :alat="$alat" />
        @endforeach
    </div>

@endsection
