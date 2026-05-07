{{--
    Component: card-penginapan
    Props:
        $penginapan = [
            'name', 'type', 'kapasitas', 'harga', 'status', 'img'
        ]
--}}
@props(['penginapan'])

<div class="card">
    <div class="card-img">{{ $penginapan['img'] }}</div>
    <div class="card-body">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:6px;">
            <strong style="font-size:14px;">{{ $penginapan['name'] }}</strong>
            <span class="badge {{ $penginapan['status'] === 'Tersedia' ? 'badge-available' : 'badge-full' }}">
                {{ $penginapan['status'] }}
            </span>
        </div>
        <p style="font-size:12px; color:#6b7280; margin-bottom:4px;">
            {{ $penginapan['type'] }} · Kapasitas {{ $penginapan['kapasitas'] }} orang
        </p>
        <p style="font-weight:500; color:var(--green-main); font-size:14px; margin-bottom:12px;">
            {{ $penginapan['harga'] }}
        </p>

        @if ($penginapan['status'] === 'Tersedia')
            <a href="{{ route('reservasi', ['tipe' => 'penginapan', 'item' => $penginapan['name']]) }}"
                class="btn-primary" style="display:block; text-align:center; width:100%; padding:8px 0; font-size:13px;">
                Pesan Sekarang
            </a>
        @else
            <button disabled
                style="width:100%; background:#f3f4f6; color:#9ca3af; border:none; border-radius:8px; padding:8px 0; font-size:13px;">
                Tidak Tersedia
            </button>
        @endif
    </div>
</div>
