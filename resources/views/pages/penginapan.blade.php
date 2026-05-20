@extends('layouts.app')
@section('title', "Penginapan — Citiis'Go")

@section('content')

    {{-- Spacer navbar --}}
    <div class="h-20"></div>

    {{-- ════════════════════════════
     FEATURED PENGINAPAN
════════════════════════════ --}}
    @php $featured = $penginapan->first(); @endphp

    @if ($featured)
        <section class="py-12 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

                    {{-- Foto featured --}}
                    <div class="rounded-2xl overflow-hidden h-72 lg:h-80">
                        <img src="{{ asset($featured->foto ?? 'images/placeholder.jpg') }}"
                            onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80'"
                            alt="{{ $featured->name ?? $featured->nama }}" class="w-full h-full object-cover">
                    </div>

                    {{-- Detail featured --}}
                    <div>
                        {{-- Tipe --}}
                        <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">
                            {{ $featured->type ?? ($featured->tipe ?? 'Penginapan') }}
                        </span>

                        <h1 class="font-display text-2xl lg:text-3xl font-bold mt-1 mb-2">
                            {{ $featured->name ?? $featured->nama }}
                        </h1>

                        {{-- Harga --}}
                        <p class="text-xl font-bold text-brand mb-3">
                            Rp {{ number_format($featured->harga_per_malam ?? ($featured->harga ?? 0), 0, ',', '.') }}
                            <span class="text-sm font-normal text-gray-400">/malam</span>
                        </p>

                        {{-- Deskripsi --}}
                        <p class="text-gray-500 text-sm leading-relaxed mb-2">
                            {{ $featured->deskripsi ?? 'Nikmati pengalaman menginap yang nyaman dan menyenangkan di tengah keindahan alam Galunggung. Fasilitas lengkap tersedia untuk memastikan kenyamanan selama menginap.' }}
                        </p>

                        {{-- Kapasitas --}}
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-5">
                            <div class="flex items-center gap-1.5">
                                <i class="ti ti-users text-brand"></i>
                                Kapasitas {{ $featured->kapasitas ?? 0 }} orang
                            </div>
                            <div class="flex items-center gap-1.5">
                                @if ($featured->tersedia ?? true)
                                    <i class="ti ti-circle-check text-green-500"></i>
                                    <span class="text-green-600 font-medium">Tersedia</span>
                                @else
                                    <i class="ti ti-circle-x text-red-400"></i>
                                    <span class="text-red-500 font-medium">Penuh</span>
                                @endif
                            </div>
                        </div>

                        {{-- Fasilitas --}}
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach (['WiFi', 'AC', 'Kamar Mandi Dalam', 'Parkir', 'Air Panas'] as $fas)
                                <span class="px-3 py-1 rounded-full bg-brand-light text-brand-dark text-xs font-medium">
                                    {{ $fas }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Tombol --}}
                        @if ($featured->tersedia ?? true)
                            <a href="{{ route('reservasi', ['tipe' => 'penginapan', 'item' => $featured->name ?? $featured->nama]) }}"
                                class="inline-flex items-center gap-2 w-full justify-center px-6 py-3.5 rounded-xl
                              bg-brand text-white font-semibold text-sm hover:bg-brand-dark transition-colors mb-2">
                                <i class="ti ti-calendar-plus"></i> Pesan Sekarang
                            </a>
                        @else
                            <button disabled
                                class="w-full px-6 py-3.5 rounded-xl bg-gray-100 text-gray-400 font-semibold text-sm cursor-not-allowed mb-2">
                                Tidak Tersedia
                            </button>
                        @endif

                        <p class="text-xs text-gray-400 text-center">
                            <i class="ti ti-info-circle"></i>
                            Pembayaran dilakukan langsung saat check-in
                        </p>
                    </div>

                </div>
            </div>
        </section>
    @endif

    {{-- ════════════════════════════
     PENGINAPAN LAINNYA
════════════════════════════ --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">

            <h2 class="font-display text-2xl font-bold mb-8">Penginapan Lainnya</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($penginapan->skip(1) as $item)
                    <div
                        class="bg-white rounded-2xl border border-gray-100 overflow-hidden
                            hover:-translate-y-1 hover:shadow-lg transition-all duration-250">

                        {{-- Foto --}}
                        <div class="h-48 overflow-hidden relative">
                            <img src="{{ asset($item->foto ?? 'images/placeholder.jpg') }}"
                                onerror="this.src='https://images.unsplash.com/photo-1587061949409-02df41d5e562?w=500&q=80'"
                                alt="{{ $item->name ?? $item->nama }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                loading="lazy">

                            {{-- Badge --}}
                            <div class="absolute top-2.5 right-2.5">
                                @if ($item->tersedia ?? true)
                                    <span
                                        class="px-2.5 py-1 rounded-full bg-brand-light text-brand-dark text-[10px] font-bold">
                                        ✓ Tersedia
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-red-50 text-red-600 text-[10px] font-bold">
                                        ✗ Penuh
                                    </span>
                                @endif
                            </div>

                            {{-- Tipe --}}
                            <div
                                class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full
                                    bg-black/40 backdrop-blur-sm text-white text-[10px] font-medium">
                                {{ $item->type ?? ($item->tipe ?? 'Penginapan') }}
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="p-4">
                            <h3 class="font-semibold text-sm mb-1">{{ $item->name ?? $item->nama }}</h3>

                            <p class="text-xs text-gray-400 mb-1">
                                {{ $item->deskripsi ?? 'Penginapan nyaman di kawasan wisata Citiis Galunggung.' }}
                            </p>

                            <div class="flex items-center gap-1 text-xs text-gray-400 mb-3">
                                <i class="ti ti-users text-xs"></i>
                                Kapasitas {{ $item->kapasitas ?? 0 }} orang
                            </div>

                            {{-- Harga --}}
                            <p class="font-bold text-brand text-sm mb-4">
                                Rp {{ number_format($item->harga_per_malam ?? ($item->harga ?? 0), 0, ',', '.') }}
                                <span class="text-gray-400 font-normal text-xs">/malam</span>
                            </p>

                            {{-- Tombol --}}
                            @if ($item->tersedia ?? true)
                                <a href="{{ route('reservasi', ['tipe' => 'penginapan', 'item' => $item->name ?? $item->nama]) }}"
                                    class="block text-center w-full px-4 py-2.5 rounded-xl
                                      bg-brand text-white text-xs font-semibold
                                      hover:bg-brand-dark transition-colors">
                                    Pesan Sekarang
                                </a>
                            @else
                                <button disabled
                                    class="w-full px-4 py-2.5 rounded-xl bg-gray-100
                                           text-gray-400 text-xs cursor-not-allowed">
                                    Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-400">
                        <i class="ti ti-home-off text-5xl block mb-3 opacity-30"></i>
                        <p class="text-sm">Belum ada penginapan lain tersedia</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection
