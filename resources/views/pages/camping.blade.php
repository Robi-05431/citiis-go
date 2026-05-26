@extends('layouts.app')
@section('title', 'Camping — Citiis\'Go')

@section('content')

    {{-- Header Section --}}
    <div class="h-20"></div>

    <section class="py-16 bg-gradient-to-br from-brand-light via-white to-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand/10 border border-brand/20 text-brand text-sm font-semibold mb-4">
                    <i class="ti ti-tent"></i> Area Camping Eksklusif
                </span>
                <h1 class="font-display text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Jelajahi Zona Camping Terbaik
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Temukan pengalaman camping yang sempurna dengan pemandangan alam yang menakjubkan. Pilih zona favorit Anda dan pesan sekarang!
                </p>
            </div>

            {{-- Filter/Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                    <div class="text-3xl font-bold text-brand mb-2">{{ $camping->count() }}</div>
                    <p class="text-gray-600">Zona Camping Tersedia</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                    <div class="text-3xl font-bold text-brand-mid mb-2">{{ $camping->where('status', 'Tersedia')->count() }}</div>
                    <p class="text-gray-600">Zona Aktif</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                    <div class="text-3xl font-bold text-amber-500 mb-2">⭐ 4.9</div>
                    <p class="text-gray-600">Rating dari Wisatawan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Camping Cards Section --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($camping as $zona)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                        {{-- Card Header Image --}}
                        <div class="relative h-48 bg-gradient-to-br from-brand-light to-brand/20 flex items-center justify-center overflow-hidden">
                            <div class="text-6xl animate-bounce">⛺</div>
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1.5 rounded-full text-sm font-bold {{ $zona->status === 'Tersedia' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $zona->status }}
                                </span>
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="p-6">
                            <h3 class="font-bold text-xl text-gray-900 mb-2 group-hover:text-brand transition-colors">
                                {{ $zona->name }}
                            </h3>

                            <div class="space-y-3 mb-5">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="ti ti-users text-brand"></i>
                                    <span class="text-sm">{{ $zona->kapasitas }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="ti ti-map-pin text-brand"></i>
                                    <span class="text-sm">{{ $zona->fitur }}</span>
                                </div>
                                <div class="pt-2 border-t border-gray-200">
                                    <p class="text-2xl font-bold text-brand">{{ $zona->harga }}<span class="text-sm text-gray-600">/tenda</span></p>
                                </div>
                            </div>

                            {{-- Action Button --}}
                            @if ($zona->status === 'Tersedia')
                                <a href="{{ route('reservasi', ['tipe' => 'camping', 'item' => $zona->name]) }}"
                                    class="w-full block text-center px-4 py-3 rounded-xl bg-gradient-to-r from-brand to-brand-dark text-white font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200">
                                    <i class="ti ti-calendar-plus"></i> Pesan Sekarang
                                </a>
                            @else
                                <button disabled class="w-full px-4 py-3 rounded-xl bg-gray-100 text-gray-400 font-semibold cursor-not-allowed">
                                    Zona Penuh
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <i class="ti ti-tent-off text-6xl text-gray-300 mb-4 block"></i>
                        <p class="text-gray-500 text-lg">Data camping belum tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Info Section --}}
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="font-display text-3xl font-bold text-gray-900 mb-8">Mengapa Memilih Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-brand-light text-brand text-2xl mb-4">
                        <i class="ti ti-shield-check"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-600 text-sm">Fasilitas keamanan lengkap 24/7</p>
                </div>
                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-brand-light text-brand text-2xl mb-4">
                        <i class="ti ti-users-group"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Komunitas Seru</h3>
                    <p class="text-gray-600 text-sm">Bertemu wisatawan dari berbagai tempat</p>
                </div>
                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-brand-light text-brand text-2xl mb-4">
                        <i class="ti ti-nature"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Alam Asri</h3>
                    <p class="text-gray-600 text-sm">Pemandangan pegunungan yang indah</p>
                </div>
                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-brand-light text-brand text-2xl mb-4">
                        <i class="ti ti-discount-2"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Harga Terjangkau</h3>
                    <p class="text-gray-600 text-sm">Paket hemat untuk grup & keluarga</p>
                </div>
            </div>
        </div>
    </section>

@endsection
