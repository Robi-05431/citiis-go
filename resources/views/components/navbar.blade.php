@php
    $links = [
        'Beranda' => route('beranda'),
        'Tentang' => route('tentang'),
        'Penginapan' => route('penginapan'),
        'Camping' => route('camping'),
        'Sewa Alat' => route('peralatan'),
        'Reservasi' => route('reservasi'),
    ];
@endphp

<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 py-5">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('beranda') }}" class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl flex-shrink-0">
                    <img src="{{ asset('images/logoCitiisGo.jpeg') }}" alt="Logo Citiis Go"
                         class="w-full h-full rounded-xl object-contain logo-img transition-all duration-300">
                </div>
                <span class="logo-text text-white font-semibold text-lg transition-colors duration-300">
                    Citiis<span class="text-brand-mid">'Go</span>
                </span>
            </a>

            {{-- Desktop Nav Links --}}
            <div class="hidden md:flex items-center gap-1">
                @foreach ($links as $label => $url)
                    @if ($label === 'Reservasi')
                        <a href="{{ $url }}"
                            class="ml-2 px-4 py-2 rounded-lg bg-brand text-white text-sm font-semibold
                      hover:bg-brand-dark transition-colors duration-200">
                            {{ $label }}
                        </a>
                    @else
                        <a href="{{ $url }}"
                            class="nav-link px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200
                      hover:bg-white/15 text-white/80
                      {{ request()->url() === $url ? 'bg-white/20 !text-white' : '' }}">
                            {{ $label }}
                        </a>
                    @endif
                @endforeach
            </div>

            {{-- Auth Buttons + Mobile Hamburger --}}
            <div class="flex items-center gap-2">
                {{-- Auth - hanya tampil di desktop --}}
                <div class="hidden md:flex items-center gap-2">
                    <button onclick="document.getElementById('modal-auth').classList.remove('hidden')"
                        class="btn-login px-4 py-2 rounded-lg text-sm font-medium border transition-all duration-300
                         bg-white/15 border-white/40 text-white">
                        Masuk
                    </button>
                    <button onclick="document.getElementById('modal-auth').classList.remove('hidden')"
                        class="px-4 py-2 rounded-lg text-sm font-semibold bg-brand text-white
                         hover:bg-brand-dark transition-colors duration-200">
                        Daftar
                    </button>
                </div>

                {{-- Hamburger - hanya tampil di mobile --}}
                <button id="menu-btn"
                    class="md:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white/15 text-white">
                    <i class="ti ti-menu-2 text-xl"></i>
                </button>
            </div>

        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden mt-3 bg-white rounded-2xl shadow-xl overflow-hidden">
            @foreach ($links as $label => $url)
                <a href="{{ $url }}"
                    class="flex items-center px-5 py-3.5 text-sm font-medium text-gray-700
                  border-b border-gray-100 last:border-0 hover:bg-brand-light hover:text-brand-dark transition-colors">
                    {{ $label }}
                </a>
            @endforeach
            <div class="flex gap-2 p-4 bg-gray-50">
                <button onclick="document.getElementById('modal-auth').classList.remove('hidden')"
                    class="flex-1 py-2.5 rounded-xl border border-brand text-brand text-sm font-semibold hover:bg-brand-light transition-colors">
                    Masuk
                </button>
                <button onclick="document.getElementById('modal-auth').classList.remove('hidden')"
                    class="flex-1 py-2.5 rounded-xl bg-brand text-white text-sm font-semibold hover:bg-brand-dark transition-colors">
                    Daftar
                </button>
            </div>
        </div>

    </div>
</nav>

{{-- Auth Modal --}}
@include('components.auth-modal')
