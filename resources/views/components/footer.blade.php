<footer class="bg-[#0d1f1a] pt-14 pb-7">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Grid utama --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

            {{-- Brand --}}
            <div class="lg:col-span-1">
                <a href="{{ route('beranda') }}" class="flex items-center gap-2.5 mb-3">
                    <div class="w-8 h-8 rounded-xl bg-brand flex items-center justify-center flex-shrink-0">
                        <i class="ti ti-mountain text-white text-base"></i>
                    </div>
                    <span class="text-white font-semibold text-lg">
                        Citiis<span class="text-brand-mid">'Go</span>
                    </span>
                </a>
                <p class="text-white/40 text-sm leading-relaxed max-w-[240px]">
                    Platform informasi wisata Citiis Galunggung, Tasikmalaya. Temukan penginapan, camping, dan aktivitas
                    terbaik.
                </p>
                {{-- Sosmed --}}
                <div class="flex gap-2 mt-5">
                    @foreach ([['ti-brand-instagram', '#'], ['ti-brand-facebook', '#'], ['ti-brand-tiktok', '#'], ['ti-brand-whatsapp', '#']] as [$icon, $href])
                        <a href="{{ $href }}"
                            class="w-9 h-9 rounded-xl bg-white/8 hover:bg-brand flex items-center justify-center transition-colors duration-200 group">
                            <i
                                class="ti {{ $icon }} text-white/50 group-hover:text-white text-base transition-colors"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Wisata --}}
            <div>
                <p class="text-white/80 text-xs font-semibold uppercase tracking-wider mb-4">Wisata</p>
                <div class="flex flex-col gap-2.5">
                    <a href="{{ route('penginapan') }}"
                        class="text-white/40 hover:text-brand-mid text-sm transition-colors">Penginapan</a>
                    <a href="{{ route('camping') }}"
                        class="text-white/40 hover:text-brand-mid text-sm transition-colors">Area Camping</a>
                    <a href="{{ route('peralatan') }}"
                        class="text-white/40 hover:text-brand-mid text-sm transition-colors">Sewa Peralatan</a>
                    <a href="{{ route('reservasi') }}"
                        class="text-white/40 hover:text-brand-mid text-sm transition-colors">Reservasi</a>
                </div>
            </div>

            {{-- Informasi --}}
            <div>
                <p class="text-white/80 text-xs font-semibold uppercase tracking-wider mb-4">Informasi</p>
                <div class="flex flex-col gap-2.5">
                    <a href="{{ route('informasi') }}"
                        class="text-white/40 hover:text-brand-mid text-sm transition-colors">Tentang Citiis</a>
                    <a href="{{ route('informasi') }}"
                        class="text-white/40 hover:text-brand-mid text-sm transition-colors">Harga Tiket</a>
                    <a href="{{ route('informasi') }}"
                        class="text-white/40 hover:text-brand-mid text-sm transition-colors">Fasilitas</a>
                    <a href="#" class="text-white/40 hover:text-brand-mid text-sm transition-colors">Peta
                        Lokasi</a>
                </div>
            </div>

            {{-- Kontak --}}
            <div>
                <p class="text-white/80 text-xs font-semibold uppercase tracking-wider mb-4">Kontak</p>
                <div class="flex flex-col gap-3">
                    <a href="tel:+62265123456"
                        class="flex items-center gap-2.5 text-white/40 hover:text-brand-mid text-sm transition-colors">
                        <i class="ti ti-phone text-brand-mid text-base flex-shrink-0"></i>
                        (0265) 123-4567
                    </a>
                    <a href="mailto:info@citiisgo.id"
                        class="flex items-center gap-2.5 text-white/40 hover:text-brand-mid text-sm transition-colors">
                        <i class="ti ti-mail text-brand-mid text-base flex-shrink-0"></i>
                        info@citiisgo.id
                    </a>
                    <div class="flex items-start gap-2.5 text-white/40 text-sm">
                        <i class="ti ti-map-pin text-brand-mid text-base flex-shrink-0 mt-0.5"></i>
                        Citiis, Galunggung, Tasikmalaya
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-white/8 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3">
            <p class="text-white/25 text-xs">© {{ date('Y') }} Wisata Citiis Galunggung. All rights reserved.</p>
            <div class="flex gap-5">
                <a href="#" class="text-white/25 hover:text-white/50 text-xs transition-colors">Kebijakan
                    Privasi</a>
                <a href="#" class="text-white/25 hover:text-white/50 text-xs transition-colors">Syarat &
                    Ketentuan</a>
            </div>
        </div>

    </div>
</footer>
