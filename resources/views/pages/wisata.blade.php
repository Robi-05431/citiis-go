@extends('layouts.app')
@section('title', "Wisata — Citiis'Go")

@section('content')

    {{-- Spacer navbar --}}
    <div class="h-20"></div>

    {{-- ════════════════════════════
     SECTION 1: HEADER + FOTO GRID
════════════════════════════ --}}
    <section class="py-14 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

                {{-- Teks kiri --}}
                <div>
                    <h1 class="font-display text-3xl font-bold mb-2">Citiis Galunggung</h1>
                    <p class="text-gray-400 text-sm mb-5">
                        Citiis Galunggung terletak di kaki Gunung Galunggung, Tasikmalaya, Jawa Barat.
                    </p>
                    <p class="text-gray-500 text-sm leading-relaxed mb-3">
                        Tempat wisata alam terbaik di Tasikmalaya dengan berbagai fasilitas lengkap. Mulai dari
                        penginapan nyaman, area camping yang asri, hingga pemandian air panas alami yang menyegarkan.
                        Cocok untuk wisata keluarga, rombongan, maupun solo traveler yang ingin menikmati keindahan
                        alam Jawa Barat.
                    </p>
                    <p class="text-gray-500 text-sm leading-relaxed mb-3">
                        Udara sejuk pegunungan, hamparan hijau, dan suara gemericik air menjadi daya tarik utama
                        kawasan ini. Informasi mencakup berbagai aktivitas seru mulai dari hiking, camping, berendam
                        air panas, hingga foto di spot-spot instagramable. Fasilitas toilet, mushola, dan parkir
                        tersedia di area wisata. Pulvinar facilisis mauris Blandit volutpat dictum.
                    </p>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Posuere elementum neque ultrices tellus amet dictum. Etiam enim Blandit tempus
                        consectetur condimentum Blandit amet lorem. Sit vitae tempus aliquam elementum at aliquam
                        classe. Et dictum tincidunt sit Blandit Blandit id consequat. Vel sit omnis at faucibus
                        consequat.
                    </p>
                </div>

                {{-- Foto grid kanan --}}
                <div class="grid grid-cols-2 gap-3">
                    @php
                        $fotoHero = [
                            [
                                'img' => 'images/wisata/foto-1.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=500&q=80',
                            ],
                            [
                                'img' => 'images/wisata/foto-2.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=500&q=80',
                            ],
                            [
                                'img' => 'images/wisata/foto-3.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=500&q=80',
                            ],
                            [
                                'img' => 'images/wisata/foto-4.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=500&q=80',
                            ],
                        ];
                    @endphp
                    @foreach ($fotoHero as $f)
                        <div class="rounded-xl overflow-hidden h-40">
                            <img src="{{ asset($f['img']) }}" onerror="this.src='{{ $f['fb'] }}'" alt="Foto wisata"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{-- ════════════════════════════
     SECTION 2: DESTINASI POPULER
════════════════════════════ --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

                {{-- List destinasi kiri --}}
                <div>
                    <h2 class="font-display text-2xl font-bold mb-6">Destinasi Populer</h2>

                    @php
                        $destinasi = [
                            [
                                'title' => 'Pesona Alam Galunggung',
                                'desc' =>
                                    'Keajaiban alam pegunungan yang menakjubkan dengan panorama alam yang memukau.',
                            ],
                            [
                                'title' => 'Wisata Danau dan Perbukitan',
                                'desc' =>
                                    'Nikmati momen terbaik bersama sambil menikmati keindahan alam khas Galunggung yang asri dan menyegarkan.',
                            ],
                            [
                                'title' => 'Spot Foto Instagramable',
                                'desc' =>
                                    'Abadikan momen terbaik di berbagai lokasi wisata di berbagai sudut foto yang indah dan estetik.',
                            ],
                        ];
                    @endphp

                    <div class="flex flex-col gap-5 mb-8">
                        @foreach ($destinasi as $d)
                            <div class="border-l-2 border-brand pl-4">
                                <h4 class="font-semibold text-sm mb-1">{{ $d['title'] }}</h4>
                                <p class="text-gray-500 text-xs leading-relaxed">{{ $d['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('reservasi') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand text-white text-sm font-semibold hover:bg-brand-dark transition-colors">
                            Mulai Jelajah
                        </a>
                        <a href="{{ route('tentang') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-300 text-gray-600 text-sm hover:border-brand hover:text-brand transition-colors">
                            Secondary button
                        </a>
                    </div>
                </div>

                {{-- Foto kanan --}}
                <div class="rounded-2xl overflow-hidden h-72 lg:h-80">
                    <img src="{{ asset('images/wisata/destinasi-populer.jpg') }}"
                        onerror="this.src='https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=700&q=80'"
                        alt="Destinasi Populer" class="w-full h-full object-cover">
                </div>

            </div>
        </div>
    </section>

    {{-- ════════════════════════════
     SECTION 3: HARGA TIKET
════════════════════════════ --}}
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="font-display text-2xl font-bold mb-6">Harga Tiket Masuk</h2>
            <div class="max-w-md rounded-2xl overflow-hidden border border-gray-100">
                @php
                    $tiket = [
                        ['tipe' => 'Dewasa (Weekday)', 'harga' => 'Rp 25.000'],
                        ['tipe' => 'Dewasa (Weekend)', 'harga' => 'Rp 35.000'],
                        ['tipe' => 'Anak-anak', 'harga' => 'Rp 15.000'],
                        ['tipe' => 'Parkir Motor', 'harga' => 'Rp 5.000'],
                        ['tipe' => 'Parkir Mobil', 'harga' => 'Rp 10.000'],
                    ];
                @endphp
                @foreach ($tiket as $i => $t)
                    <div
                        class="flex justify-between items-center px-5 py-3.5 text-sm
                            {{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}
                            {{ $i < count($tiket) - 1 ? 'border-b border-gray-100' : '' }}">
                        <span class="text-gray-600">{{ $t['tipe'] }}</span>
                        <span class="font-semibold text-brand-dark">{{ $t['harga'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ════════════════════════════
     SECTION 4: RELATED ARTICLES
════════════════════════════ --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">

            <h2 class="font-display text-2xl font-bold mb-8">Related articles or posts</h2>

            @php
                $articles = [
                    [
                        'img' => 'images/wisata/artikel-1.jpg',
                        'fb' => 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?w=500&q=80',
                        'judul' => 'Tips Camping di Galunggung',
                        'desc' =>
                            'Sed lobortis elit adipiscing, morbi varius enim blandit tempus ex risus ut platea eu platea ex. Convallis volutpat tristique massa blandit.',
                    ],
                    [
                        'img' => 'images/wisata/artikel-2.jpg',
                        'fb' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=500&q=80',
                        'judul' => 'Panduan Hiking Galunggung',
                        'desc' =>
                            'Convallis volutpat tristique massa blandit. Congue nulla tellus adipiscing adipiscing quality of life sed condimentum euismod eros blandit amet.',
                    ],
                    [
                        'img' => 'images/wisata/artikel-3.jpg',
                        'fb' => 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=500&q=80',
                        'judul' => 'Wisata Air Panas Citiis',
                        'desc' =>
                            'Congue nulla tellus adipiscing adipiscing quality of life sed condimentum euismod eros. Ut sit amet nonummy blandit accumsan element.',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($articles as $a)
                    <div class="group cursor-pointer">
                        <div class="rounded-xl overflow-hidden h-44 mb-4">
                            <img src="{{ asset($a['img']) }}" onerror="this.src='{{ $a['fb'] }}'"
                                alt="{{ $a['judul'] }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h4 class="font-semibold text-sm mb-2 group-hover:text-brand transition-colors">{{ $a['judul'] }}
                        </h4>
                        <p class="text-gray-400 text-xs leading-relaxed">{{ $a['desc'] }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ════════════════════════════
     SECTION 5: SUBHEADING GRID
════════════════════════════ --}}
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <h2 class="font-display text-2xl font-bold mb-8">Section heading</h2>

            @php
                $subs = [
                    [
                        'icon' => 'ti-droplet',
                        'title' => 'Pemandian Air Panas',
                        'desc' =>
                            'Nikmati sensasi berendam di kolam air panas alami dengan suhu yang pas dan pemandangan hijau sekitar.',
                    ],
                    [
                        'icon' => 'ti-tent',
                        'title' => 'Area Camping',
                        'desc' =>
                            'Tersedia berbagai zona camping dengan kapasitas berbeda, cocok untuk keluarga maupun rombongan.',
                    ],
                    [
                        'icon' => 'ti-walk',
                        'title' => 'Jalur Hiking',
                        'desc' =>
                            'Jalur hiking dengan berbagai tingkat kesulitan tersedia untuk semua kalangan wisatawan.',
                    ],
                    [
                        'icon' => 'ti-camera',
                        'title' => 'Spot Foto',
                        'desc' =>
                            'Banyak titik foto instagramable dengan latar alam yang indah dan autentik di kawasan Galunggung.',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach ($subs as $s)
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-brand-light flex items-center justify-center flex-shrink-0">
                            <i class="ti {{ $s['icon'] }} text-brand text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm mb-1.5">{{ $s['title'] }}</h4>
                            <p class="text-gray-400 text-xs leading-relaxed">{{ $s['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endsection
