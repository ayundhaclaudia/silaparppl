@extends('layouts.app')

@section('content')

<div style="margin:0; padding:0;">
    <div style="
        background-color:#f4a641;
        min-height:100vh;
        width:100%;
        display:flex;
        align-items:center;
        justify-content:center;
        position:relative;
        left:0;
        top:0;
    ">

        {{-- Logo di atas --}}
        <div style="text-align:center; position:absolute; top:40px; width:100%;">
            <img src="{{ asset('images/silapar-logo.png') }}" width="120" alt="Logo Silapar">
        </div>

        {{-- Card form --}}
        <div style="
            background-color:#8B0000;
            padding:40px;
            border-radius:25px;
            width:400px;
            margin-top:140px;
        ">

            <h2 style="color:white; font-weight:bold; text-align:center; font-size:26px;">
                Buat Akun Baru
            </h2>

            <p style="text-align:center; color:#ffecec; margin-bottom:20px;">
                Sudah punya akun?
                <a href="{{ route('login') }}" style="color:#ffdede; text-decoration:underline;">Masuk</a>
            </p>

            @if ($errors->any())
                <div style="color: #ffcdcd; background:#5f0000; border-radius:6px; padding:10px; margin-bottom:15px;">
                    <ul style="margin:0; padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label style="color:white;">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label style="color:white;">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label style="color:white;">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label style="color:white;">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button class="btn w-100 mt-2" style="background-color:#a00000; color:white; font-weight:bold;">
                    Register
                </button>
            </form>

            {{-- Sudah punya akun --}}
            <div style="
                margin-top:15px;
                font-size:12px;
                display:flex;
                justify-content:center;
                align-items:center;
                gap:10px;
                color:white;
            ">
                <span>Sudah punya akun?</span>
                <a href="{{ route('login') }}"
                   style="background:#400000; padding:6px 12px; border-radius:5px; color:white; text-decoration:none;">
                    Login
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
