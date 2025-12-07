@extends('layouts.app')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<style>
    /* BAR BUDGET (KUNING) */
    .silapar-budget-bar{
        background-color:#F2C94C;
        padding: 14px 0;
    }
    .silapar-container{
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    .silapar-budget-inner{
        display:flex;
        flex-wrap:wrap;
        gap: 10px;
        align-items:center;
    }
    .silapar-budget-input{
        flex:1 1 260px;
        border:none;
        border-radius:999px;
        padding: 10px 16px;
        font-size: 0.95rem;
        outline:none;
    }
    .silapar-budget-input:focus{
        box-shadow:0 0 0 2px rgba(0,0,0,0.08);
    }
    .silapar-budget-btn{
        border:none;
        border-radius:999px;
        padding: 10px 24px;
        font-weight:600;
        font-size:0.9rem;
        background:#8B0000;
        color:#fff;
        cursor:pointer;
        transition: all .18s ease-in-out;
        white-space:nowrap;
    }
    .silapar-budget-btn:hover{
        filter:brightness(1.05);
        box-shadow:0 4px 12px rgba(0,0,0,0.18);
        transform:translateY(-1px);
    }
    .silapar-budget-select{
        border:none;
        border-radius:999px;
        padding:10px 16px;
        font-size:0.9rem;
        min-width:200px;
        cursor:pointer;
    }

    /* HERO MERAH */
    .silapar-hero{
        background-color:#8B0000;
        color:#fff;
        text-align:center;
        padding: 40px 16px 56px;
    }
    .silapar-hero-tag{
        display:inline-flex;
        align-items:center;
        gap:6px;
        font-size:0.75rem;
        letter-spacing:0.16em;
        text-transform:uppercase;
        color:#FDE68A;
        margin-bottom:10px;
    }
    .silapar-hero-title{
        font-size:2rem;
        font-weight:800;
        margin-bottom:6px;
    }
    .silapar-hero-sub{
        font-size:1.1rem;
        opacity:0.95;
    }

    /* SECTION LIST MENU */
    .silapar-menu-section{
        background-color:#F2C94C;
        padding: 50px 0 100px;
    }
    .silapar-section-header{
        margin-bottom:20px;
    }
    .silapar-section-title{
        font-size:1.2rem;
        font-weight:700;
        margin-bottom:4px;
    }
    .silapar-section-sub{
        font-size:0.9rem;
        color:#6B7280;
    }

    /* GRID MENU – max 4 kolom (karena lebar container 1200px & tiap kartu 260–280px) */
    .silapar-menu-grid{
        display:grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 280px));
        gap:24px;
        margin-top:12px;
        justify-content: center;   /* kalau belum penuh 4, tetap di tengah */
    }

    /* Di layar kecil: 1 kolom penuh */
    @media (max-width:640px){
        .silapar-menu-grid{
            grid-template-columns: 1fr;
        }
    }

    .silapar-menu-card{
        background:#fff;
        border-radius:18px;
        overflow:hidden;
        box-shadow:0 10px 28px rgba(0,0,0,0.14);
        display:flex;
        flex-direction:column;
        transition:all .18s ease-in-out;
    }
    .silapar-menu-card:hover{
        transform:translateY(-4px);
        box-shadow:0 16px 32px rgba(0,0,0,0.18);
    }
    .silapar-menu-img-wrapper{
        width:100%;
        aspect-ratio:4/3;
        overflow:hidden;
    }
    .silapar-menu-img-wrapper img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
    }
    .silapar-menu-body{
        padding:14px 18px 16px;
        display:flex;
        flex-direction:column;
        flex:1;
    }
    .silapar-menu-name{
        font-size:0.98rem;
        font-weight:700;
        margin-bottom:4px;
    }
    .silapar-menu-price{
        font-size:0.9rem;
        font-weight:600;
        color:#A00000;
        margin-bottom:6px;
    }

    /* RATING */
    .silapar-menu-rating{
        display:flex;
        align-items:center;
        gap:6px;
        margin-bottom:6px;
        font-size:0.8rem;
    }
    .silapar-stars span{
        font-size:0.9rem;
        color:#FBBF24; /* kuning bintang */
    }
    .silapar-stars span.silapar-star-empty{
        color:#E5E7EB; /* abu-abu untuk bintang kosong */
    }

    .silapar-menu-desc{
        font-size:0.85rem;
        color:#6B7280;
        flex:1;
        margin-bottom:10px;
    }
    .silapar-menu-btn{
        border:none;
        border-radius:999px;
        padding: 9px 0;
        font-size:0.85rem;
        font-weight:600;
        text-align:center;
        background:#8B0000;
        color:#fff;
        text-decoration:none;
        display:block;
    }
    .silapar-menu-btn:hover{
        filter:brightness(1.05);
        text-decoration:none;
    }

    .silapar-empty-box{
        background:#FFF7D6;
        border-radius:16px;
        padding:20px 22px;
        text-align:center;
        max-width:520px;
        margin:24px auto 0;
        font-size:0.95rem;
        color:#92400E;
        box-shadow:0 6px 16px rgba(0,0,0,0.08);
    }

    @media (max-width:640px){
        .silapar-budget-inner{
            flex-direction:column;
            align-items:stretch;
        }
        .silapar-budget-select{
            width:100%;
        }
        .silapar-hero-title{
            font-size:1.6rem;
        }
    }
</style>

{{-- BAR INPUT BUDGET (KUNING) --}}
<div class="silapar-budget-bar">
    <div class="silapar-container">
        <form class="silapar-budget-inner" method="GET" action="{{ route('menus.index') }}">
            {{-- Input bebas --}}
            <input
                type="number"
                name="budget"
                min="0"
                class="silapar-budget-input"
                placeholder="Masukkan budget kamu..."
                value="{{ $budget }}"
            >

            <button class="silapar-budget-btn" type="submit">
                Cari
            </button>

            {{-- Quick select range --}}
            <select
                class="silapar-budget-select"
                onchange="window.location.href='{{ route('menus.index') }}?budget=' + this.value;">
                <option value="">Pilih rentang budget ▼</option>
                <option value="0"      {{ $budget === '0' ? 'selected' : '' }}>0 - 9.000</option>
                <option value="10000"  {{ $budget === '10000' ? 'selected' : '' }}>10.000 - 19.000</option>
                <option value="20000"  {{ $budget === '20000' ? 'selected' : '' }}>20.000 - 29.000</option>
                <option value="30000"  {{ $budget === '30000' ? 'selected' : '' }}>30.000 - 39.000</option>
            </select>
        </form>
    </div>
</div>

{{-- HERO MERAH --}}
<section class="silapar-hero">
    <div class="silapar-container">
        <div class="silapar-hero-tag">
            <span>🍽</span>
            <span>REKOMENDASI MENU</span>
        </div>
        <h1 class="silapar-hero-title">Selamat Datang di</h1>
        <p class="silapar-hero-sub">Silapar SWK Telkom</p>
    </div>
</section>

{{-- SECTION HASIL REKOMENDASI --}}
<section class="silapar-menu-section">
    <div class="silapar-container">

        <div class="silapar-section-header">
            <h4 class="silapar-section-title">
                Mulai dengan memilih budget kamu
            </h4>
            <p class="silapar-section-sub">
                Pilih kisaran harga, lalu telusuri menu makanan yang cocok dengan kantongmu.
                @if ($budget)
                    &nbsp;Saat ini kamu memilih budget
                    <strong>Rp {{ number_format($budget, 0, ',', '.') }}</strong>.
                    Rekomendasi di bawah ini sudah diurutkan dari
                    <strong>rating bintang tertinggi</strong>.
                @endif
            </p>
        </div>

        @if ($budget !== null && $menus->count() === 0)
            {{-- Tidak ada menu di kisaran budget --}}
            <div class="silapar-empty-box">
                <strong>Menu masih belum tersedia</strong><br>
                Belum ada menu di kisaran harga ini. Coba pilih rentang budget yang lain, ya 😊
            </div>
        @elseif ($menus->count() === 0)
            {{-- Belum pilih budget sama sekali --}}
            <div class="silapar-empty-box">
                Masukkan budget atau pilih rentang harga di atas untuk melihat rekomendasi menu.
            </div>
        @else
            {{-- GRID MENU --}}
            <div class="silapar-menu-grid">
                @foreach ($menus as $menu)
                    @php
                        // pastikan selalu ada nilai rating 0–5
                        $rating = (int) ($menu->rating ?? 0);
                        if ($rating < 0) $rating = 0;
                        if ($rating > 5) $rating = 5;
                    @endphp

                    <div class="silapar-menu-card">
                        <div class="silapar-menu-img-wrapper">
                            <img
                                src="{{ $menu->image ? asset('images/menus/' . $menu->image) : asset('images/menus/default.jpg') }}"
                                alt="{{ $menu->name }}"
                            >
                        </div>
                        <div class="silapar-menu-body">
                            <div class="silapar-menu-name">{{ $menu->name }}</div>
                            <div class="silapar-menu-price">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </div>

                            {{-- RATING BINTANG --}}
                            <div class="silapar-menu-rating">
                                <div class="silapar-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <span>★</span>
                                        @else
                                            <span class="silapar-star-empty">★</span>
                                        @endif
                                    @endfor
                                </div>
                                <span>({{ $rating }}/5)</span>
                            </div>

                            <div class="silapar-menu-desc">
                                {{ Str::limit($menu->description, 70) }}
                            </div>
                            <a href="{{ route('menus.show', $menu->id) }}" class="silapar-menu-btn">
                                Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

@endsection
