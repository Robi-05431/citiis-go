@extends('layouts.app')
@section('title', "Beranda — Citiis'Go Wisata Galunggung")

@section('content')

    {{-- ════════════════════════════════
     HERO
════════════════════════════════ --}}
    <section class="relative min-h-screen flex items-center overflow-hidden">
        {{-- Background foto --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero-galunggung.jpg') }}"
                onerror="this.src='https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1600&q=85'"
                alt="Wisata Galunggung" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-black/75 via-black/50 to-black/30"></div>
        </div>

        {{-- Konten hero --}}
        <div class="relative z-10 max-w-6xl mx-auto px-6 w-full pt-20">
            <div class="max-w-2xl">
                {{-- Eyebrow --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                  bg-white/15 border border-white/25 backdrop-blur-sm
                  text-white text-sm font-medium mb-6">
                    <i class="ti ti-map-pin text-brand-mid text-sm"></i>
                    Citiis, Tasikmalaya, Jawa Barat
                </div>

                {{-- Judul --}}
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-[1.1] mb-5">
                    Jelajahi Keindahan<br>Alam Bersama<br>
                    <span class="text-brand-mid">Citiis'Go</span>
                </h1>

                {{-- Deskripsi --}}
                <p class="text-white/80 text-base sm:text-lg leading-relaxed mb-8 max-w-lg">
                    Nikmati pengalaman wisata tak terlupakan di kaki Gunung Galunggung —
                    penginapan nyaman, area camping eksklusif, dan jalur hiking yang menakjubkan.
                </p>

                {{-- CTA --}}
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('penginapan') }}"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl
                  bg-white text-brand-dark font-semibold text-sm
                  hover:bg-brand-light transition-all duration-200
                  hover:-translate-y-0.5 hover:shadow-lg">
                        <i class="ti ti-search"></i> Lihat Destinasi
                    </a>
                    <a href="{{ route('reservasi') }}"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl
                  bg-white/15 border border-white/40 backdrop-blur-sm
                  text-white font-semibold text-sm
                  hover:bg-white/25 transition-all duration-200">
                        <i class="ti ti-calendar-plus"></i> Mulai Jelajah
                    </a>
                </div>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="hero-scroll absolute bottom-8 left-1/2 flex flex-col items-center gap-1.5 text-white/50">
            <i class="ti ti-chevron-down text-xl"></i>
            <span class="text-[10px] tracking-widest uppercase">Scroll</span>
        </div>
    </section>

    {{-- ════════════════════════════════
     STATS ROW
════════════════════════════════ --}}
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-gray-100">

                @php
                    $stats = [
                        [
                            'icon' => 'ti-home',
                            'value' => isset($penginapan) ? $penginapan->count() . '+' : '50+',
                            'label' => 'Unit Penginapan',
                            'color' => 'text-brand',
                        ],
                        [
                            'icon' => 'ti-tent',
                            'value' => isset($camping) ? $camping->count() : '50',
                            'label' => 'Zona Camping',
                            'color' => 'text-brand',
                        ],
                        [
                            'icon' => 'ti-backpack',
                            'value' => '50+',
                            'label' => 'Peralatan Sewa',
                            'color' => 'text-brand',
                        ],
                        [
                            'icon' => 'ti-star-filled',
                            'value' => '4.9',
                            'label' => 'Rating Wisatawan',
                            'color' => 'text-amber-500',
                        ],
                    ];
                @endphp

                @foreach ($stats as $s)
                    <div class="flex items-center gap-3 px-6 py-6 sm:py-7">
                        <div class="w-11 h-11 rounded-xl bg-brand-light flex items-center justify-center flex-shrink-0">
                            <i class="ti {{ $s['icon'] }} {{ $s['color'] }} text-xl"></i>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-brand leading-none">{{ $s['value'] }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $s['label'] }}</div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{-- ════════════════════════════════
     TENTANG
════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-xs font-semibold text-brand uppercase tracking-widest mb-3 block">Tentang
                        Citiis'Go</span>
                    <h2 class="font-display text-3xl lg:text-4xl font-bold mb-5">Citiis Go</h2>
                    <p class="text-gray-500 leading-relaxed mb-4">
                        Citiis'Go hadir sebagai platform informasi wisata yang membantu wisatawan menemukan berbagai
                        destinasi
                        menarik di kawasan Galunggung. Mulai dari wisata alam, area camping, dan tempat beristirahat yang
                        cocok
                        untuk menyegarkan diri dari rutinitas dan kegiatan sehari-hari.
                    </p>
                    <p class="text-gray-500 leading-relaxed mb-8">
                        Nikmati pengalaman terbaik untuk dapatkan informasi lokasi, fasilitas, galeri foto, dan rekomendasi
                        tempat terbaik untuk dikunjungi bersama keluarga maupun teman.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('penginapan') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                    bg-brand text-white text-sm font-semibold
                    hover:bg-brand-dark transition-colors">
                            <i class="ti ti-arrow-right"></i> Lihat Destinasi
                        </a>
                        <a href="{{ route('informasi') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                    border border-brand text-brand text-sm font-semibold
                    hover:bg-brand-light transition-colors">
                            Info Lengkap
                        </a>
                    </div>
                </div>
                <div class="rounded-3xl overflow-hidden h-80 lg:h-[420px]">
                    <img src="{{ asset('images/tentang-citiis.jpg') }}"
                        onerror="this.src='https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=700&q=80'"
                        alt="Wisata Citiis" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════
     DESTINASI POPULER
════════════════════════════════ --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-10">
                <span class="text-xs font-semibold text-brand uppercase tracking-widest mb-2 block">Temukan</span>
                <h2 class="font-display text-3xl lg:text-4xl font-bold">Destinasi Populer</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                {{-- Card besar --}}
                <div class="group rounded-3xl overflow-hidden relative min-h-[400px] cursor-pointer">
                    <img src="{{ asset('images/destinasi/pesona-alam.jpg') }}"
                        onerror="this.src='https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&q=80'"
                        alt="Pesona Alam" class="img-zoom w-full h-full object-cover absolute inset-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-7">
                        <span
                            class="inline-block px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-white text-xs font-medium mb-3">
                            🌿 Alam
                        </span>
                        <h3 class="font-display text-2xl font-bold text-white mb-2">Pesona Alam Galunggung</h3>
                        <p class="text-white/75 text-sm leading-relaxed">
                            Keajaiban alam pegunungan yang menakjubkan dengan panorama alam yang memukau.
                        </p>
                    </div>
                </div>

                {{-- List kanan --}}
                <div class="flex flex-col gap-4">
                    @php
                        $destinasi = [
                            [
                                'img' => 'images/destinasi/wisata-danau.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=200&q=80',
                                'title' => 'Wisata Danau dan Perbukitan',
                                'desc' =>
                                    'Nikmati momen terbaik bersama sambil menikmati keindahan alam khas Galunggung.',
                            ],
                            [
                                'img' => 'images/destinasi/spot-foto.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=200&q=80',
                                'title' => 'Spot Foto Instagramable',
                                'desc' =>
                                    'Abadikan momen terbaik di berbagai lokasi wisata dengan sudut foto yang indah.',
                            ],
                            [
                                'img' => 'images/destinasi/air-panas.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=200&q=80',
                                'title' => 'Kolam Air Panas Alami',
                                'desc' => 'Sensasi berendam di sumber air panas alami di kaki Gunung Galunggung.',
                            ],
                        ];
                    @endphp

                    @foreach ($destinasi as $d)
                        <div
                            class="group flex items-start gap-4 bg-white rounded-2xl p-4 border border-gray-100
                      hover:border-brand/40 hover:shadow-md transition-all duration-200 cursor-pointer">
                            <div class="w-[72px] h-[72px] rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{ asset($d['img']) }}" onerror="this.src='{{ $d['fb'] }}'"
                                    alt="{{ $d['title'] }}" class="img-zoom w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold mb-1.5 group-hover:text-brand transition-colors">
                                    {{ $d['title'] }}</h4>
                                <p class="text-xs text-gray-500 leading-relaxed">{{ $d['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="flex flex-wrap gap-3 mt-2">
                        <a href="{{ route('informasi') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand text-white text-sm font-semibold hover:bg-brand-dark transition-colors">
                            <i class="ti ti-compass"></i> Jelajahi Semua
                        </a>
                        <a href="{{ route('informasi') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-brand text-brand text-sm font-semibold hover:bg-brand-light transition-colors">
                            Info Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════
     PENGINAPAN
════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-semibold text-brand uppercase tracking-widest mb-2 block">Penginapan</span>
                    <h2 class="font-display text-3xl lg:text-4xl font-bold">Pilihan Penginapan Terbaik</h2>
                </div>
                <a href="{{ route('penginapan') }}"
                    class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl border border-brand
                text-brand text-sm font-semibold hover:bg-brand-light transition-colors flex-shrink-0">
                    Lihat Semua <i class="ti ti-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                    $penginapanData =
                        $penginapan ??
                        collect([
                            (object) [
                                'nama' => 'Villa Contoh',
                                'foto' => null,
                                'tersedia' => true,
                                'kapasitas' => 8,
                                'harga' => 475000,
                            ],
                            (object) [
                                'nama' => 'Camping Ground',
                                'foto' => null,
                                'tersedia' => true,
                                'kapasitas' => 20,
                                'harga' => 150000,
                            ],
                            (object) [
                                'nama' => 'Hotel Dummy',
                                'foto' => null,
                                'tersedia' => false,
                                'kapasitas' => 4,
                                'harga' => 250000,
                            ],
                            (object) [
                                'nama' => 'Resort Santai',
                                'foto' => null,
                                'tersedia' => true,
                                'kapasitas' => 10,
                                'harga' => 600000,
                            ],
                        ]);
                @endphp
                @forelse($penginapanData->take(4) as $item)
                    <div class="card-lift group bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        {{-- Foto --}}
                        <div class="h-48 overflow-hidden relative">
                            <img src="{{ asset($item->foto ?? 'images/placeholder.jpg') }}"
                                onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?w=500&q=80'"
                                alt="{{ $item->name ?? ($item->nama ?? '') }}" class="img-zoom w-full h-full object-cover"
                                loading="lazy">
                            {{-- Badge --}}
                            <div class="absolute top-2.5 right-2.5">
                                @if ($item->tersedia ?? true)
                                    <span
                                        class="px-2.5 py-1 rounded-full bg-brand-light text-brand-dark text-[10px] font-bold">✓
                                        Tersedia</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-red-50 text-red-700 text-[10px] font-bold">✗
                                        Penuh</span>
                                @endif
                            </div>
                            {{-- Tipe --}}
                            <div
                                class="absolute top-2.5 left-2.5 px-2.5 py-1 rounded-full bg-black/40 backdrop-blur-sm text-white text-[10px] font-medium">
                                {{ $item->type ?? ($item->tipe ?? 'Penginapan') }}
                            </div>
                        </div>
                        {{-- Body --}}
                        <div class="p-4">
                            <h3 class="font-semibold text-sm mb-1">{{ $item->name ?? $item->nama }}</h3>
                            <p class="text-xs text-gray-500 mb-3">
                                <i class="ti ti-users text-xs"></i> Kapasitas {{ $item->kapasitas ?? 0 }} orang
                            </p>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <div>
                                    <span class="text-brand font-bold text-sm">
                                        Rp {{ number_format($item->harga_per_malam ?? ($item->harga ?? 0), 0, ',', '.') }}
                                    </span>
                                    <span class="text-gray-400 text-xs">/malam</span>
                                </div>
                                @if ($item->tersedia ?? true)
                                    <a href="{{ route('reservasi', ['tipe' => 'penginapan', 'item' => $item->name ?? $item->nama]) }}"
                                        class="px-3 py-1.5 rounded-lg bg-brand text-white text-xs font-semibold hover:bg-brand-dark transition-colors">
                                        Pesan
                                    </a>
                                @else
                                    <button disabled
                                        class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-400 text-xs cursor-not-allowed">
                                        Penuh
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-400">
                        <i class="ti ti-home-off text-5xl block mb-3 opacity-30"></i>
                        <p>Data penginapan belum tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════
     CAMPING
════════════════════════════════ --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-semibold text-brand uppercase tracking-widest mb-2 block">Camping</span>
                    <h2 class="font-display text-3xl lg:text-4xl font-bold">Area Camping Pilihan</h2>
                </div>
                <a href="{{ route('camping') }}"
                    class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl border border-brand
                text-brand text-sm font-semibold hover:bg-brand-light transition-colors flex-shrink-0">
                    Lihat Semua <i class="ti ti-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $campingData =
                        $camping ??
                        collect([
                            (object) [
                                'nama' => 'Zona A',
                                'foto' => null,
                            ],
                            (object) [
                                'nama' => 'Zona B',
                                'foto' => null,
                            ],
                            (object) [
                                'nama' => 'Zona C',
                                'foto' => null,
                            ],
                        ]);
                @endphp
                @forelse($campingData->take(3) as $zona)
                    <div class="group relative rounded-3xl overflow-hidden h-60 cursor-pointer">
                        <img src="{{ asset($zona->foto ?? 'images/placeholder.jpg') }}"
                            onerror="this.src='https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=600&q=80'"
                            alt="{{ $zona->name ?? ($zona->nama ?? '') }}"
                            class="img-zoom w-full h-full object-cover absolute inset-0" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5">
                            <div class="flex gap-2 mb-2">
                                <span
                                    class="px-2.5 py-1 rounded-full bg-white/20 backdrop-blur-sm text-white text-[10px] font-medium">⛺
                                    Camping</span>
                                <span
                                    class="{{ $zona->tersedia ?? true ? 'bg-brand-light text-brand-dark' : 'bg-red-50 text-red-700' }} px-2.5 py-1 rounded-full text-[10px] font-bold">
                                    {{ $zona->tersedia ?? true ? 'Tersedia' : 'Penuh' }}
                                </span>
                            </div>
                            <h3 class="text-white font-bold text-base mb-1">{{ $zona->name ?? $zona->nama }}</h3>
                            <p class="text-white/70 text-xs mb-3">
                                {{ $zona->kapasitas_tenda ?? ($zona->kapasitas ?? 0) }} tenda
                                @if ($zona->fitur ?? ($zona->fasilitas ?? false))
                                    · {{ $zona->fitur ?? $zona->fasilitas }}
                                @endif
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-brand-mid font-semibold text-sm">
                                    Rp
                                    {{ number_format((int)($zona->harga_per_tenda ?? ($zona->harga ?? 0)), 0, ',', '.') }}/tenda
                                </span>
                                @if ($zona->tersedia ?? true)
                                    <a href="{{ route('reservasi', ['tipe' => 'camping', 'item' => $zona->name ?? $zona->nama]) }}"
                                        class="px-3 py-1.5 rounded-lg bg-white text-brand-dark text-xs font-bold hover:bg-brand-light transition-colors">
                                        Pesan
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-400">
                        <i class="ti ti-tent-off text-5xl block mb-3 opacity-30"></i>
                        <p>Data camping belum tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════
     FASILITAS
════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-10">
                <span class="text-xs font-semibold text-brand uppercase tracking-widest mb-2 block">Fasilitas</span>
                <h2 class="font-display text-3xl lg:text-4xl font-bold">Fasilitas yang Tersedia</h2>
            </div>

            @php
                $fasilitas = [
                    [
                        'img' => 'images/fasilitas/penginapan.jpg',
                        'fb' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80',
                        'icon' => 'ti-home',
                        'label' => 'Penginapan',
                        'route' => route('penginapan'),
                        'desc' =>
                            'Tempat beristirahat alam yang tenang sambil berfasilitas bersama keluarga dan teman.',
                    ],
                    [
                        'img' => 'images/fasilitas/camping.jpg',
                        'fb' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=600&q=80',
                        'icon' => 'ti-tent',
                        'label' => 'Area Camping',
                        'route' => route('camping'),
                        'desc' => 'Tersedia area camping terbaik yang cocok untuk pengalaman bertenda di alam terbuka.',
                    ],
                    [
                        'img' => 'images/fasilitas/peralatan.jpg',
                        'fb' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
                        'icon' => 'ti-backpack',
                        'label' => 'Penyewaan Alat Camping',
                        'route' => route('peralatan'),
                        'desc' => 'Tersedia berbagai tenda, matras, dan perlengkapan camping lainnya untuk disewa.',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($fasilitas as $f)
                    <div class="card-lift group bg-white rounded-2xl border border-gray-100 overflow-hidden">
                        <div class="h-52 overflow-hidden">
                            <img src="{{ asset($f['img']) }}" onerror="this.src='{{ $f['fb'] }}'"
                                alt="{{ $f['label'] }}" class="img-zoom w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="p-5">
                            <div class="w-10 h-10 rounded-xl bg-brand-light flex items-center justify-center mb-3">
                                <i class="ti {{ $f['icon'] }} text-brand text-lg"></i>
                            </div>
                            <h3 class="font-semibold text-sm mb-2">{{ $f['label'] }}</h3>
                            <p class="text-xs text-gray-500 leading-relaxed mb-4">{{ $f['desc'] }}</p>
                            <a href="{{ $f['route'] }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-brand text-white text-xs font-semibold hover:bg-brand-dark transition-colors">
                                {{ $f['label'] }} <i class="ti ti-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════
     REVIEW
════════════════════════════════ --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-xs font-semibold text-brand uppercase tracking-widest mb-2 block">Ulasan</span>
                <h2 class="font-display text-3xl lg:text-4xl font-bold">Review</h2>
            </div>

            @php
                $reviews = [
                    [
                        'teks' => '"Fasilitas lengkap ada toilet, mushola, singgah nyaman!"',
                        'nama' => 'Deni Fadilna wahida',
                        'foto' => 'images/avatar/1.jpg',
                        'tanggal' => '3 hari lalu',
                    ],
                    [
                        'teks' => '"Diantara teman-teman kami buat kelompok galunggung!"',
                        'nama' => 'Ryo Lil',
                        'foto' => 'images/avatar/2.jpg',
                        'tanggal' => '1 minggu lalu',
                    ],
                    [
                        'teks' => '"Tiket 7000 masuk bayar tapi bagus juga hetz!"',
                        'nama' => 'Anggi Perwira',
                        'foto' => 'images/avatar/3.jpg',
                        'tanggal' => '2 minggu lalu',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($reviews as $r)
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        {{-- Bintang --}}
                        <div class="flex gap-0.5 mb-4">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="ti ti-star-filled text-amber-400 text-sm"></i>
                            @endfor
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed italic mb-5">{{ $r['teks'] }}</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0 bg-brand-light">
                                <img src="{{ asset($r['foto']) }}"
                                    onerror="this.outerHTML='<div class=\'w-10 h-10 rounded-full bg-brand-light flex items-center justify-center text-brand-dark font-bold text-sm\'>{{ substr($r['nama'], 0, 1) }}</div>'"
                                    alt="{{ $r['nama'] }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <div class="text-sm font-semibold">{{ $r['nama'] }}</div>
                                <div class="text-xs text-gray-400">{{ $r['tanggal'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════
     CTA STRIP
════════════════════════════════ --}}
    <section class="py-14 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div
                class="relative bg-gradient-to-br from-brand-dark to-brand rounded-3xl px-8 sm:px-14 py-14
                flex flex-col sm:flex-row items-center justify-between gap-6 overflow-hidden">
                {{-- Dekorasi --}}
                <div class="absolute -right-12 -top-12 w-56 h-56 rounded-full bg-white/5 pointer-events-none"></div>
                <div class="absolute right-16 -bottom-16 w-40 h-40 rounded-full bg-white/5 pointer-events-none"></div>

                <div class="relative z-10 text-center sm:text-left">
                    <h2 class="font-display text-2xl sm:text-3xl font-bold text-white mb-2">
                        Siap merencanakan perjalananmu?
                    </h2>
                    <p class="text-white/75 text-sm sm:text-base">
                        Pesan penginapan atau area camping sekarang — mudah dan tanpa ribet.
                    </p>
                </div>

                <a href="{{ route('reservasi') }}"
                    class="relative z-10 flex-shrink-0 inline-flex items-center gap-2 px-7 py-3.5
                bg-white text-brand-dark font-bold text-sm rounded-xl
                hover:bg-brand-light transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="ti ti-calendar-plus"></i> Buat Reservasi
                </a>
            </div>
        </div>
    </section>

@endsection
