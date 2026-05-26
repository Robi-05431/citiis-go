@extends('layouts.app')
@section('title', "Tentang — Citiis'Go")

@section('content')

    {{-- Spacer navbar --}}
    <div class="h-20"></div>

    {{-- ════════════════════════════
     SECTION 1: TENTANG HEADER
════════════════════════════ --}}
    <section class="py-14 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                {{-- Teks kiri --}}
                <div>
                    <h1 class="font-display text-3xl font-bold mb-4">Tentang Citiis Go</h1>
                    <p class="text-gray-500 text-sm leading-relaxed mb-3">
                        Citiis merupakan platform wisata digital yang membantu wisatawan menemukan berbagai destinasi
                        menarik di sekitar Citiis Galunggung. Website ini menyajikan informasi wisata, penginapan,
                        dan fasilitas wisata lainnya.
                    </p>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Citiis dibuat pada tahun 2026 oleh sekelompok mahasiswa Universitas Siliwangi Tasikmalaya
                        bersama KKN.
                    </p>
                </div>

                {{-- Logo kanan --}}
                <div class="flex justify-center lg:justify-end">
                    <div class="w-48 h-48 rounded-2xl overflow-hidden bg-brand-light flex items-center justify-center">
                        <img src="{{ asset('images/logo-citiis.png') }}"
                            onerror="this.parentElement.innerHTML='<span class=\'font-display text-4xl font-bold text-brand\'>Citiis<br>Go</span>'"
                            alt="Logo Citiis Go" class="w-full h-full object-contain p-4">
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ════════════════════════════
     SECTION 2: FOTO UTAMA + CAPTION
════════════════════════════ --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">

            <h2 class="font-display text-2xl lg:text-3xl font-bold text-center mb-8">
                Keindahan Alam Citiis Galunggung
            </h2>

            {{-- Foto utama besar --}}
            <div class="rounded-2xl overflow-hidden h-72 sm:h-96 mb-5">
                <img src="{{ asset('images/tentang/foto-utama.jpg') }}"
                    onerror="this.src='https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=1200&q=80'"
                    alt="Keindahan Citiis Galunggung" class="w-full h-full object-cover">
            </div>

            <p class="text-gray-500 text-sm leading-relaxed text-center max-w-2xl mx-auto">
                Citiis dikenal sebagai kawasan wisata alam dengan udara segar, pemandangan pegunungan, dan fasilitas
                yang nyaman. Tempat ini cocok untuk wisata keluarga, teman, maupun bersama orang lain.
            </p>

        </div>
    </section>

    {{-- ════════════════════════════
     SECTION 3: GALERI PRODUK / FOTO KECIL
════════════════════════════ --}}
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-5">
                @php
                    $galeri = [
                        [
                            'img' => 'images/tentang/galeri-1.jpg',
                            'fb' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=400&q=80',
                            'label' => 'Produk',
                            'desc' => 'Description of first product',
                            'harga' => '$11.00',
                        ],
                        [
                            'img' => 'images/tentang/galeri-2.jpg',
                            'fb' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=400&q=80',
                            'label' => 'Produk',
                            'desc' => 'Description of second product',
                            'harga' => '$9.00',
                        ],
                        [
                            'img' => 'images/tentang/galeri-3.jpg',
                            'fb' => 'https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=400&q=80',
                            'label' => 'Produk',
                            'desc' => 'Description of third product',
                            'harga' => '$15.00',
                        ],
                    ];
                @endphp

                @foreach ($galeri as $g)
                    <div>
                        <div class="rounded-xl overflow-hidden h-44 mb-3">
                            <img src="{{ asset($g['img']) }}" onerror="this.src='{{ $g['fb'] }}'"
                                alt="{{ $g['label'] }}" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-semibold text-sm mb-1">{{ $g['label'] }}</h4>
                        <p class="text-gray-400 text-xs mb-1">{{ $g['desc'] }}</p>
                        <p class="text-brand font-bold text-sm">{{ $g['harga'] }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ════════════════════════════
     SECTION 4: TENTANG + FOTO GRID
════════════════════════════ --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                {{-- Teks kiri --}}
                <div>
                    <h2 class="font-display text-2xl font-bold mb-4">Tentang Citiis Go</h2>
                    <p class="text-gray-500 text-sm leading-relaxed mb-3">
                        Citiis merupakan platform wisata digital yang membantu wisatawan menemukan berbagai tujuan
                        menarik di kawasan Citiis Galunggung. Website ini menyajikan informasi wisata, penginapan,
                        dan fasilitas wisata lainnya.
                    </p>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Citiis dibuat pada tahun 2026 oleh sekelompok mahasiswa Universitas Siliwangi Tasikmalaya
                        bersama KKN.
                    </p>
                </div>

                {{-- Foto grid kanan --}}
                <div class="grid grid-cols-2 gap-3">
                    @php
                        $fotoGrid = [
                            [
                                'img' => 'images/tentang/pemandian-air-panas.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1504701954957-2010ec3bcec1?w=400&q=80',
                                'label' => 'Pemandian Air Panas',
                            ],
                            [
                                'img' => 'images/tentang/camping.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?w=400&q=80',
                                'label' => 'Camping',
                            ],
                            [
                                'img' => 'images/tentang/keindahan-alam.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=400&q=80',
                                'label' => 'Keindahan Alam',
                            ],
                            [
                                'img' => 'images/tentang/hiking.jpg',
                                'fb' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=400&q=80',
                                'label' => 'Hiking',
                            ],
                        ];
                    @endphp

                    @foreach ($fotoGrid as $f)
                        <div>
                            <div class="rounded-xl overflow-hidden h-32 mb-2">
                                <img src="{{ asset($f['img']) }}" onerror="this.src='{{ $f['fb'] }}'"
                                    alt="{{ $f['label'] }}" class="w-full h-full object-cover">
                            </div>
                            <p class="text-xs font-medium text-gray-600">{{ $f['label'] }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{-- ════════════════════════════
     SECTION 5: CONTACT
════════════════════════════ --}}
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <h2 class="font-display text-2xl font-bold mb-8">Contact me</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-8">
                <div>
                    <p class="font-semibold text-sm mb-3">Citiis'Go</p>
                    <div class="flex flex-col gap-2 text-sm text-gray-500">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-map-pin text-brand text-base"></i>
                            Citiis, Galunggung, Tasikmalaya
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ti ti-phone text-brand text-base"></i>
                            (0265) 123-4567
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ti ti-mail text-brand text-base"></i>
                            info@citiisgo.id
                        </div>
                    </div>

                    {{-- Sosmed --}}
                    <div class="flex gap-3 mt-5">
                        <a href="#"
                            class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-brand hover:text-white flex items-center justify-center transition-colors">
                            <i class="ti ti-brand-instagram text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-brand hover:text-white flex items-center justify-center transition-colors">
                            <i class="ti ti-brand-facebook text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-brand hover:text-white flex items-center justify-center transition-colors">
                            <i class="ti ti-brand-tiktok text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
