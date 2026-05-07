@extends('layouts.app')
@section('title', 'Masuk — Citiis\'Go')

@section('content')
    <div style="max-width:380px; margin:3rem auto;">
        <div class="card" style="padding:2rem;">
            <h2 style="font-size:20px; font-weight:500; margin-bottom:1.5rem;">Masuk ke Akun</h2>

            @if ($errors->any())
                <div class="alert-success"
                    style="background:#FCEBEB; border-color:#f5c6c6; color:#A32D2D; margin-bottom:1rem;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email Anda"
                    style="margin-bottom:12px;">

                <label style="font-size:13px; color:#6b7280; display:block; margin-bottom:4px;">Password</label>
                <input type="password" name="password" required placeholder="Password" style="margin-bottom:16px;">

                <button type="submit" class="btn-primary"
                    style="width:100%; padding:10px 0; font-size:15px;">Masuk</button>
            </form>

            <p style="text-align:center; font-size:13px; color:#6b7280; margin-top:12px;">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color:var(--green-main);">Daftar</a>
            </p>
        </div>
    </div>
@endsection
