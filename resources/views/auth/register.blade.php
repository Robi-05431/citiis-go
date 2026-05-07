@extends('layouts.app')
@section('title', 'Daftar — Citiis\'Go')

@section('content')
    <div style="max-width:380px; margin:3rem auto;">
        <div class="card" style="padding:2rem;">
            <h2 style="font-size:20px; font-weight:500; margin-bottom:1.5rem;">Buat Akun Baru</h2>

            @if ($errors->any())
                <div
                    style="background:#FCEBEB; border:1px solid #f5c6c6; border-radius:8px; padding:.75rem 1rem; color:#A32D2D; font-size:13px; margin-bottom:1rem;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap Anda"
                    style="margin-bottom:12px;">

                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email Anda"
                    style="margin-bottom:12px;">

                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Password</label>
                <input type="password" name="password" required placeholder="Password" style="margin-bottom:12px;">

                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required placeholder="Ulangi password"
                    style="margin-bottom:16px;">

                <button type="submit" class="btn-primary" style="width:100%; padding:10px 0; font-size:15px;">Daftar
                    Sekarang</button>
            </form>

            <p style="text-align:center; font-size:13px; color:#6b7280; margin-top:12px;">
                Sudah punya akun?
                <a href="{{ route('login') }}" style="color:var(--green-main);">Masuk</a>
            </p>
        </div>
    </div>
@endsection
