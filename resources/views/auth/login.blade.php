@extends('layouts.app')

@section('content')

<div style="background-color:#f4a641; min-height:100vh; display:flex; align-items:center; justify-content:center;">

    <div style="text-align:center; margin-bottom:20px; position:absolute; top:40px;">
        <img src="{{ asset('images/silapar-logo.png') }}"  width="120" alt="">
    </div>

    <div style="background-color:#8B0000; padding:40px; border-radius:25px; width:400px; margin-top:100px;">

        <h2 style="color:white; font-weight:bold; text-align:center; font-size:26px;">Masuk Akun</h2>

        <p style="text-align:center; color:#ffecec; margin-bottom:20px;">
            Belum punya akun?
            <a href="{{ route('register') }}" style="color: #ffdede; text-decoration:underline;">Daftar</a>
        </p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label" style="color:white;">Email</label>
                <input type="email" name="email" class="form-control" style="background:white;" required>
            </div>

            <div class="mb-3">
                <label class="form-label" style="color:white;">Kata Sandi</label>
                <input type="password" name="password" class="form-control" style="background:white;" required>
            </div>

            <button class="btn w-100 mt-2" style="background-color:#a00000; color:white; font-weight:bold;">
                Login
            </button>
        </form>
    </div>
</div>

@endsection
