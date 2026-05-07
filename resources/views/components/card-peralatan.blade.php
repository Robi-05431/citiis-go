{{--
    Component: card-peralatan
    Props:
        $alat = [
            'name', 'stok', 'harga', 'icon'
        ]
--}}
@props(['alat'])

<div class="card" style="padding:1.25rem 1rem;">
    <div style="font-size:28px; margin-bottom:10px;">{{ $alat['icon'] }}</div>
    <strong style="font-size:14px; display:block; margin-bottom:4px;">{{ $alat['name'] }}</strong>
    <p style="font-size:12px; color:#6b7280; margin-bottom:2px;">
        Stok: <span style="color:{{ $alat['stok'] > 5 ? 'var(--green-dark)' : '#A32D2D' }}; font-weight:500;">
            {{ $alat['stok'] }} unit
        </span>
    </p>
    <p style="font-weight:500; color:var(--green-main); font-size:13px; margin-bottom:12px;">{{ $alat['harga'] }}</p>

    <a href="{{ route('reservasi', ['tipe' => 'peralatan', 'item' => $alat['name']]) }}"
        style="display:block; text-align:center; width:100%; background:var(--green-light); color:var(--green-dark);
              border:1px solid var(--green-mid); border-radius:7px; padding:7px 0; font-size:12px;">
        Sewa
    </a>
</div>
