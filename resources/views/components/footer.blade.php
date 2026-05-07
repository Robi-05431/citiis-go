<footer style="border-top:0.5px solid #e5e7eb; background:#fff; padding:1.5rem 1.5rem 1rem;">
    <div class="container"
        style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">

        <div style="display:flex; align-items:center; gap:8px;">
            <div
                style="width:28px; height:28px; border-radius:6px; background:var(--green-main); display:flex; align-items:center; justify-content:center; font-size:14px;">
                ⛰️</div>
            <span style="font-weight:500; color:var(--green-dark);">Citiis'Go</span>
        </div>

        <p style="font-size:13px; color:#6b7280;">© {{ date('Y') }} Wisata Citiis Galunggung, Tasikmalaya</p>

        <div style="display:flex; gap:16px;">
            @foreach (['Beranda' => 'beranda', 'Penginapan' => 'penginapan', 'Camping' => 'camping', 'Reservasi' => 'reservasi'] as $label => $routeName)
                <a href="{{ route($routeName) }}" style="font-size:13px; color:#6b7280;">{{ $label }}</a>
            @endforeach
        </div>

    </div>
</footer>
