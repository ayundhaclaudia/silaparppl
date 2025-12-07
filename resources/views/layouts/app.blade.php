<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'SILAPAR') }} | SWK Ketintang</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #A00000;   /* merah silapar */
            --accent-color: #FFC300;    /* kuning silapar */
            --nav-bg: #020617;          /* biru gelap */
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F3F4F6;
            color: #111827;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        main { flex: 1; }

        .main-navbar{
            background: var(--nav-bg);
            border-bottom: 1px solid #111827;
            color: #E5E7EB;
        }
        .main-navbar-inner{
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-left{
            display: flex;
            align-items: center;
            gap: 0.9rem;
        }
        .nav-logo{
            display: flex;
            align-items: center;
        }
        .nav-logo img{
            height: 52px;
            width: auto;
            display: block;
        }
        .nav-brand-text{
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }
        .nav-brand-title{
            font-size: 1rem;
            font-weight: 600;
            color: #F9FAFB;
        }
        .nav-brand-subtitle{
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #6EE7B7;
        }
        .nav-tab{
            margin-left: 2rem;
            padding: 0.5rem 0;
            font-size: 0.9rem;
            font-weight: 500;
            color: #9CA3AF;
            border-bottom: 2px solid transparent;
            text-decoration: none;
        }
        .nav-tab.is-active{
            color: #F9FAFB;
            border-bottom-color: var(--accent-color);
        }
        .nav-right{
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.85rem;
        }
        .nav-username{
            font-weight: 600;
            color: #F9FAFB;
        }
        .nav-logout-btn{
            border: none;
            border-radius: 999px;
            padding: 0.45rem 1.1rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: #F9FAFB;
            background: linear-gradient(90deg, var(--primary-color) 0%, #7F0000 100%);
            cursor: pointer;
        }
        .nav-logout-btn:hover{ opacity: 0.9; }

        main.with-navbar{
            padding-top: 0rem;
        }

        @media (max-width: 640px){
            .main-navbar-inner{ padding-inline: 1rem; }
            .nav-tab{ display: none; }
            .nav-brand-subtitle{ display: none; }
        }
    </style>
</head>

<body class="antialiased">
@php
    $user = auth()->user();
@endphp

    {{-- NAVBAR hanya muncul jika user sudah login --}}
    @auth
        <header class="main-navbar">
            <div class="main-navbar-inner">
                <div class="nav-left">
                    <div class="nav-logo">
                        <img src="{{ asset('images/silapar-logo.png') }}" alt="Logo Silapar">
                    </div>

                    <div class="nav-brand-text">
                        <span class="nav-brand-title">SILAPAR</span>
                        <span class="nav-brand-subtitle">SWK KETINTANG</span>
                    </div>

                    {{-- TAB DASHBOARD / MENU (semua user) --}}
                    <a href="{{ route('menus.index') }}"
                       class="nav-tab {{ request()->routeIs('menus.*') ? 'is-active' : '' }}">
                        Dashboard
                    </a>



                    {{-- TAB KELOLA MENU – hanya ADMIN --}}
                    @if($user && !$user->is_admin)
                        <a href="{{ route('admin.menus.index') }}"
                           class="nav-tab {{ request()->routeIs('admin.menus.*') ? 'is-active' : '' }}">
                            Kelola Menu
                        </a>
                    @endif
                </div>

                <div class="nav-right">
                    <span>Masuk sebagai</span>
                    <span class="nav-username">{{ $user->name }}</span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-logout-btn">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>
    @endauth

    <main class="@auth with-navbar @endauth">
        @yield('content')
    </main>

    <footer style="
        background:#000;
        color:#fff;
        padding:12px 0;
        text-align:center;
        font-size:14px;
    ">
        © 2025 SILAPAR — Sentra Layanan Parongpong SWK Ketintang. Semua hak dilindungi.
    </footer>

</body>
</html>
