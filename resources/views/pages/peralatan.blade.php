@extends('layouts.app')
@section('title', 'Sewa Peralatan — Citiis\'Go')

@section('content')

    {{-- Header Section --}}
    <div class="h-20"></div>

    <section class="py-16 bg-gradient-to-br from-brand-light via-white to-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand/10 border border-brand/20 text-brand text-sm font-semibold mb-4">
                    <i class="ti ti-backpack"></i> Perlengkapan Berkualitas
                </span>
                <h1 class="font-display text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Perlengkapan Camping Lengkap
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Lengkapi petualangan Anda dengan peralatan camping berkualitas tinggi. Semua perlengkapan terawat dan siap digunakan.
                </p>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                    <div class="text-3xl font-bold text-brand mb-2">{{ $peralatan->count() }}</div>
                    <p class="text-gray-600">Jenis Peralatan</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                    <div class="text-3xl font-bold text-brand-mid mb-2">{{ $peralatan->sum('stok') }}</div>
                    <p class="text-gray-600">Total Unit Tersedia</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                    <div class="text-3xl font-bold text-amber-500 mb-2">⭐ 4.8</div>
                    <p class="text-gray-600">Kepuasan Pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Peralatan Grid Section --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($peralatan as $alat)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                        {{-- Equipment Icon/Header --}}
                        <div class="h-40 bg-gradient-to-br from-brand-light to-brand/20 flex items-center justify-center text-7xl group-hover:scale-110 transition-transform duration-300">
                            {{ $alat->icon }}
                        </div>

                        {{-- Equipment Details --}}
                        <div class="p-6">
                            <h3 class="font-bold text-lg text-gray-900 mb-3 group-hover:text-brand transition-colors">
                                {{ $alat->name }}
                            </h3>

                            {{-- Stock Status --}}
                            <div class="mb-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-600">Stok Tersedia</span>
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $alat->stok > 5 ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $alat->stok }} unit
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-brand to-brand-dark h-2 rounded-full" style="width: {{ min($alat->stok * 10, 100) }}%"></div>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="border-t border-gray-200 pt-4 mb-4">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-3xl font-bold text-brand">{{ $alat->harga }}</span>
                                </div>
                            </div>

                            {{-- CTA Button --}}
                            @if ($alat->stok > 0)
                                <a href="{{ route('reservasi', ['tipe' => 'peralatan', 'item' => $alat->name]) }}"
                                    class="w-full block text-center px-4 py-3 rounded-xl bg-gradient-to-r from-brand to-brand-dark text-white font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200">
                                    <i class="ti ti-shopping-cart"></i> Sewa Sekarang
                                </a>
                            @else
                                <button disabled class="w-full px-4 py-3 rounded-xl bg-gray-100 text-gray-400 font-semibold cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <i class="ti ti-package-off text-6xl text-gray-300 mb-4 block"></i>
                        <p class="text-gray-500 text-lg">Data peralatan belum tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="font-display text-3xl font-bold text-gray-900 mb-8 text-center">Keuntungan Menyewa Bersama Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 border border-gray-200 rounded-2xl hover:border-brand hover:shadow-lg transition-all">
                    <div class="text-4xl mb-3">🛡️</div>
                    <h3 class="font-bold text-gray-900 mb-2">Garansi Kualitas</h3>
                    <p class="text-gray-600 text-sm">Semua peralatan dalam kondisi prima dan terawat</p>
                </div>
                <div class="p-6 border border-gray-200 rounded-2xl hover:border-brand hover:shadow-lg transition-all">
                    <div class="text-4xl mb-3">💰</div>
                    <h3 class="font-bold text-gray-900 mb-2">Harga Kompetitif</h3>
                    <p class="text-gray-600 text-sm">Tarif paling terjangkau di kawasan Galunggung</p>
                </div>
                <div class="p-6 border border-gray-200 rounded-2xl hover:border-brand hover:shadow-lg transition-all">
                    <div class="text-4xl mb-3">⚡</div>
                    <h3 class="font-bold text-gray-900 mb-2">Proses Cepat</h3>
                    <p class="text-gray-600 text-sm">Booking dan pengambilan peralatan sangat mudah</p>
                </div>
                <div class="p-6 border border-gray-200 rounded-2xl hover:border-brand hover:shadow-lg transition-all">
                    <div class="text-4xl mb-3">🤝</div>
                    <h3 class="font-bold text-gray-900 mb-2">Customer Support</h3>
                    <p class="text-gray-600 text-sm">Tim siap membantu Anda 24/7</p>
                </div>
            </div>
        </div>
    </section>

@endsection
