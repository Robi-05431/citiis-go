@extends('layouts.app')
@section('title', 'Reservasi — Citiis\'Go')

@section('content')

    <h2 class="section-title">Buat Reservasi</h2>
    <p class="section-sub">Isi form di bawah untuk melakukan pemesanan. Konfirmasi akan dikirim setelah pengelola
        memverifikasi.</p>

    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert-success">
            <span style="font-size:18px;">✅</span>
            <div>
                <strong>Reservasi berhasil dikirim!</strong>
                <p style="font-size:13px; opacity:.8;">Pengelola wisata akan mengonfirmasi pemesanan Anda segera.</p>
            </div>
        </div>
    @endif

    <div class="grid-2col">

        {{-- FORM --}}
        <div class="card" style="padding:1.5rem;">
            <h3 style="font-size:16px; font-weight:500; margin-bottom:1rem;">Form Reservasi</h3>

            <form action="{{ route('reservasi.store') }}" method="POST">
                @csrf

                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Nama lengkap Anda" value="{{ old('nama') }}" required
                    style="margin-bottom:14px;">

                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Jenis Reservasi</label>
                <select name="tipe" style="margin-bottom:14px;">
                    <option value="penginapan" {{ request('tipe') === 'penginapan' ? 'selected' : '' }}>Penginapan</option>
                    <option value="camping" {{ request('tipe') === 'camping' ? 'selected' : '' }}>Area Camping</option>
                    <option value="peralatan" {{ request('tipe') === 'peralatan' ? 'selected' : '' }}>Sewa Peralatan
                    </option>
                </select>

                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Item</label>
                <input type="text" name="item" placeholder="Nama penginapan/zona/peralatan"
                    value="{{ old('item', request('item')) }}" style="margin-bottom:14px;">

                <div class="grid-2col" style="gap:10px; margin-bottom:14px;">
                    <div>
                        <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Tanggal
                            Masuk</label>
                        <input type="date" name="tanggal_masuk" required>
                    </div>
                    <div>
                        <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Tanggal
                            Keluar</label>
                        <input type="date" name="tanggal_keluar">
                    </div>
                </div>

                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Jumlah Tamu / Unit</label>
                <input type="number" name="jumlah" min="1" value="{{ old('jumlah', 1) }}"
                    style="margin-bottom:14px;">

                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Catatan (opsional)</label>
                <textarea name="catatan" rows="3" placeholder="Permintaan khusus..." style="margin-bottom:16px; resize:vertical;">{{ old('catatan') }}</textarea>

                <button type="submit" class="btn-primary"
                    style="width:100%; padding:11px 0; font-size:15px; font-weight:500;">
                    Kirim Reservasi
                </button>
            </form>
        </div>

        {{-- INFO PANEL --}}
        <div>
            {{-- Cara Reservasi --}}
            <div class="info-box">
                <h3 style="font-size:15px; font-weight:500; margin-bottom:.75rem;">Cara Reservasi</h3>
                @foreach (['Isi form dengan data lengkap', 'Kirim reservasi', 'Tunggu konfirmasi dari pengelola', 'Lakukan pembayaran saat check-in'] as $i => $step)
                    <div class="step-item">
                        <div class="step-num">{{ $i + 1 }}</div>
                        <span style="font-size:13px; color:#6b7280; padding-top:2px;">{{ $step }}</span>
                    </div>
                @endforeach
            </div>

            {{-- Info Penting --}}
            <div class="info-box-green">
                <strong style="color:var(--green-dark); display:block; margin-bottom:6px;">Info Penting</strong>
                <ul style="padding-left:16px; font-size:13px; color:var(--green-dark); line-height:1.8;">
                    <li>Pembayaran dilakukan langsung saat check-in</li>
                    <li>Konfirmasi reservasi maks. 1x24 jam</li>
                    <li>Bawa bukti reservasi saat kedatangan</li>
                    <li>Sistem tidak menyediakan payment gateway</li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div class="info-box">
                <strong style="font-size:15px; display:block; margin-bottom:8px;">Hubungi Kami</strong>
                @foreach ([['📍', 'Citiis, Galunggung, Tasikmalaya'], ['📞', '(0265) 123-4567'], ['✉️', 'info@citiisgo.id']] as [$icon, $text])
                    <div style="display:flex; gap:8px; margin-bottom:6px; font-size:13px; color:#6b7280;">
                        <span>{{ $icon }}</span><span>{{ $text }}</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
