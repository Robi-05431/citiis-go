{{--
    Component: card-camping
    Props:
        $zona = [
            'name', 'kapasitas', 'harga', 'status', 'fitur'
        ]
--}}
@props(['zona'])

<div class="camping-row">
    <div style="display:flex; align-items:center; gap:14px;">
        <div class="icon-box">⛺</div>
        <div>
            <strong style="font-size:15px;">{{ $zona['name'] }}</strong>
            <p style="font-size:12px; color:#6b7280; margin:2px 0;">{{ $zona['kapasitas'] }} · {{ $zona['fitur'] }}</p>
            <p style="font-weight:500; color:var(--green-main); font-size:13px; margin:2px 0;">{{ $zona['harga'] }}</p>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; align-items:flex-end; gap:8px;">
        <span class="badge {{ $zona['status'] === 'Tersedia' ? 'badge-available' : 'badge-full' }}">
            {{ $zona['status'] }}
        </span>

        @if ($zona['status'] === 'Tersedia')
            <a href="{{ route('reservasi', ['tipe' => 'camping', 'item' => $zona['name']]) }}" class="btn-primary"
                style="padding:6px 14px; font-size:12px;">
                Pesan
            </a>
        @else
            <button disabled
                style="background:#f3f4f6; color:#9ca3af; border:none; border-radius:7px; padding:6px 14px; font-size:12px;">
                Penuh
            </button>
        @endif
    </div>
</div>
