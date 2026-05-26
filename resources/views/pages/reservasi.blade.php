@extends('layouts.app')
@section('title', 'Reservasi — Citiis\'Go')

@section('content')

    {{-- Header Section --}}
    <div class="h-20"></div>

    <section class="py-16 bg-gradient-to-br from-brand-light via-white to-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand/10 border border-brand/20 text-brand text-sm font-semibold mb-4">
                <i class="ti ti-calendar"></i> Pesan Sekarang
            </span>
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                Buat Reservasi Impian Anda
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Proses booking mudah dalam beberapa langkah. Pesan sekarang dan nikmati liburan sempurna di Galunggung!
            </p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Form Column --}}
                <div class="lg:col-span-2">
                    {{-- Success Alert --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg">
                            <div class="flex gap-3">
                                <span class="text-2xl">✅</span>
                                <div>
                                    <strong class="text-green-700 block">Reservasi Berhasil!</strong>
                                    <p class="text-green-600 text-sm">Pengelola wisata akan mengonfirmasi pemesanan Anda dalam waktu 1x24 jam.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Reservation Form --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                        <h2 class="font-display text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <i class="ti ti-edit text-brand"></i> Form Reservasi
                        </h2>

                        <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-6">
                            @csrf

                            {{-- Row 1: Nama --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="ti ti-user"></i> Nama Lengkap
                                </label>
                                <input type="text" name="nama" placeholder="Masukkan nama lengkap Anda"
                                    value="{{ old('nama') }}" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand focus:border-transparent transition-all">
                                @error('nama')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Row 2: Tipe Reservasi --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="ti ti-list"></i> Jenis Reservasi
                                </label>
                                <select name="tipe" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand focus:border-transparent transition-all">
                                    <option value="penginapan" {{ request('tipe') === 'penginapan' ? 'selected' : '' }}>🏠 Penginapan</option>
                                    <option value="camping" {{ request('tipe') === 'camping' ? 'selected' : '' }}>⛺ Area Camping</option>
                                    <option value="peralatan" {{ request('tipe') === 'peralatan' ? 'selected' : '' }}>🎒 Sewa Peralatan</option>
                                </select>
                                @error('tipe')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Row 3: Item --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="ti ti-package"></i> Pilih Item
                                </label>
                                <input type="text" name="item" placeholder="Nama penginapan/zona/peralatan"
                                    value="{{ old('item', request('item')) }}" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand focus:border-transparent transition-all">
                                @error('item')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Row 4: Dates --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ti ti-calendar-event"></i> Tanggal Masuk
                                    </label>
                                    <input type="date" name="tanggal_masuk" required
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand focus:border-transparent transition-all">
                                    @error('tanggal_masuk')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ti ti-calendar-x"></i> Tanggal Keluar
                                    </label>
                                    <input type="date" name="tanggal_keluar"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand focus:border-transparent transition-all">
                                    @error('tanggal_keluar')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Row 5: Jumlah --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="ti ti-hash"></i> Jumlah Tamu / Unit
                                </label>
                                <input type="number" name="jumlah" min="1" value="{{ old('jumlah', 1) }}" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand focus:border-transparent transition-all">
                                @error('jumlah')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Row 6: Catatan --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="ti ti-note"></i> Catatan Khusus (Opsional)
                                </label>
                                <textarea name="catatan" rows="4" placeholder="Contoh: memiliki anak kecil, alergi makanan, dll..."
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand focus:border-transparent transition-all resize-none">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="w-full px-6 py-4 rounded-lg bg-gradient-to-r from-brand to-brand-dark text-white font-bold text-lg hover:shadow-lg hover:scale-105 transition-all duration-200">
                                <i class="ti ti-send"></i> Kirim Reservasi
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Info Column --}}
                <div class="space-y-6">
                    {{-- Steps Info --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-5 flex items-center gap-2">
                            <i class="ti ti-list-numbers text-brand"></i> Cara Reservasi
                        </h3>
                        <div class="space-y-4">
                            @foreach (['Isi form dengan data lengkap', 'Kirim reservasi', 'Tunggu konfirmasi dari pengelola', 'Lakukan pembayaran saat check-in'] as $i => $step)
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-brand text-white flex items-center justify-center font-bold text-sm">
                                        {{ $i + 1 }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-700 text-sm">{{ $step }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Info Penting --}}
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border-l-4 border-green-500 p-6">
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="ti ti-alert-circle text-green-600"></i> Informasi Penting
                        </h3>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <i class="ti ti-check text-green-600 flex-shrink-0 mt-0.5"></i>
                                <span>Pembayaran dilakukan langsung saat check-in</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="ti ti-check text-green-600 flex-shrink-0 mt-0.5"></i>
                                <span>Konfirmasi reservasi maks. 1x24 jam</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="ti ti-check text-green-600 flex-shrink-0 mt-0.5"></i>
                                <span>Bawa bukti reservasi saat kedatangan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="ti ti-check text-green-600 flex-shrink-0 mt-0.5"></i>
                                <span>Hubungi kami untuk kode booking Anda</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Contact Info --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="ti ti-phone text-brand"></i> Hubungi Kami
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <i class="ti ti-map-pin text-brand text-lg flex-shrink-0 mt-0.5"></i>
                                <div class="text-sm text-gray-600">Citiis, Galunggung, Tasikmalaya</div>
                            </div>
                            <div class="flex items-start gap-3">
                                <i class="ti ti-phone text-brand text-lg flex-shrink-0 mt-0.5"></i>
                                <a href="tel:+62265123456" class="text-sm text-brand hover:underline">(0265) 123-4567</a>
                            </div>
                            <div class="flex items-start gap-3">
                                <i class="ti ti-mail text-brand text-lg flex-shrink-0 mt-0.5"></i>
                                <a href="mailto:info@citiisgo.id" class="text-sm text-brand hover:underline">info@citiisgo.id</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
