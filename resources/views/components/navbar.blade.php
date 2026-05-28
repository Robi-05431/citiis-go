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
                        {{-- Show Reservasi link only if user is logged in --}}
                        @auth
                            <a href="{{ $url }}"
                                class="ml-2 px-4 py-2 rounded-lg bg-brand text-white text-sm font-semibold
                          hover:bg-brand-dark transition-colors duration-200">
                                {{ $label }}
                            </a>
                        @endauth
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
                    @auth
                        {{-- User sudah login --}}
                        <div class="flex items-center gap-3">
                            <span class="text-white text-sm font-medium">
                                <i class="ti ti-user-circle"></i> {{ Auth::user()->nama ?? 'User' }}
                            </span>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium border transition-all duration-300
                                     bg-white/15 border-white/40 text-white hover:bg-white/25">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- User belum login --}}
                        <a href="{{ route('login') }}"
                            class="btn-login px-4 py-2 rounded-lg text-sm font-medium border transition-all duration-300
                             bg-white/15 border-white/40 text-white">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 rounded-lg text-sm font-semibold bg-white text-brand
                             hover:bg-brand-light transition-colors duration-200">
                            Daftar
                        </a>
                    @endauth
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
                @if ($label === 'Reservasi')
                    {{-- Show Reservasi only if logged in --}}
                    @auth
                        <a href="{{ $url }}"
                            class="flex items-center px-5 py-3.5 text-sm font-medium text-gray-700
                          border-b border-gray-100 hover:bg-brand-light hover:text-brand-dark transition-colors">
                            {{ $label }}
                        </a>
                    @endauth
                @else
                    <a href="{{ $url }}"
                        class="flex items-center px-5 py-3.5 text-sm font-medium text-gray-700
                      border-b border-gray-100 last:border-0 hover:bg-brand-light hover:text-brand-dark transition-colors">
                        {{ $label }}
                    </a>
                @endif
            @endforeach
            <div class="flex gap-2 p-4 bg-gray-50">
                @auth
                    <div class="w-full">
                        <p class="text-sm font-medium text-gray-700 mb-2">
                            <i class="ti ti-user-circle"></i> {{ Auth::user()->nama ?? 'User' }}
                        </p>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-2.5 rounded-xl bg-brand text-white text-sm font-semibold hover:bg-brand-dark transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="flex-1 py-2.5 rounded-xl border border-brand text-brand text-sm font-semibold hover:bg-brand-light transition-colors text-center">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="flex-1 py-2.5 rounded-xl bg-brand text-white text-sm font-semibold hover:bg-brand-dark transition-colors text-center">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>

    </div>
</nav>

{{-- Auth Modal --}}
@include('components.auth-modal')
