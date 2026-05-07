@php
    $navLinks = [
        'Beranda' => route('beranda'),
        'Informasi Wisata' => route('informasi'),
        'Penginapan' => route('penginapan'),
        'Camping' => route('camping'),
        'Sewa Peralatan' => route('peralatan'),
        'Reservasi' => route('reservasi'),
    ];
    $current = request()->routeIs(str_replace(' ', '-', strtolower($label ?? '')) . '*');
@endphp

<nav style="background:#fff; border-bottom:0.5px solid #e5e7eb; position:sticky; top:0; z-index:100;">
    <div class="container" style="display:flex; align-items:center; justify-content:space-between; height:60px;">

        {{-- Logo --}}
        <a href="{{ route('beranda') }}" style="display:flex; align-items:center; gap:10px;">
            <div
                style="width:32px; height:32px; border-radius:8px; background:var(--green-main); display:flex; align-items:center; justify-content:center; font-size:16px;">
                ⛰️</div>
            <span style="font-weight:500; font-size:18px; color:var(--green-dark);">Citiis<span
                    style="color:var(--green-main);">'Go</span></span>
        </a>

        {{-- Nav Links --}}
        <div class="nav-links" style="display:flex; gap:4px;">
            @foreach ($navLinks as $label => $url)
                <a href="{{ $url }}"
                    style="background:{{ request()->url() === $url ? 'var(--green-light)' : 'transparent' }};
                          color:{{ request()->url() === $url ? 'var(--green-dark)' : '#6b7280' }};
                          border-radius:6px; padding:6px 10px; font-size:13px;
                          font-weight:{{ request()->url() === $url ? '500' : '400' }};">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Auth Buttons --}}
        <div style="display:flex; gap:8px;">
            <button onclick="openModal('login')" class="btn-outline">Masuk</button>
            <button onclick="openModal('register')" class="btn-primary"
                style="padding:6px 14px; font-size:13px;">Daftar</button>
        </div>

    </div>
</nav>
