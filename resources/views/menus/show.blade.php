@extends('layouts.app')

@section('content')

<style>
    .silapar-detail-wrap{
        max-width:1000px;
        margin:32px auto 40px;
        padding:0 1.5rem;
    }
    .silapar-detail-card{
        background:#fff;
        border-radius:20px;
        box-shadow:0 14px 32px rgba(0,0,0,0.16);
        overflow:hidden;
        display:grid;
        grid-template-columns: minmax(0, 1.2fr) minmax(0, 1.4fr);
    }
    .silapar-detail-img{
        width:100%;
        height:100%;
        max-height:420px;
        object-fit:cover;
        display:block;
    }
    .silapar-detail-body{
        padding:22px 24px 24px;
        display:flex;
        flex-direction:column;
        background:#FEF3C7;
    }
    .silapar-detail-badge{
        font-size:0.75rem;
        text-transform:uppercase;
        letter-spacing:.18em;
        color:#B45309;
        margin-bottom:6px;
    }
    .silapar-detail-title{
        font-size:1.6rem;
        font-weight:800;
        color:#7F1D1D;
        margin-bottom:8px;
    }
    .silapar-detail-price{
        font-size:1.3rem;
        font-weight:700;
        color:#A00000;
        margin-bottom:14px;
    }
    .silapar-detail-desc{
        font-size:0.95rem;
        color:#4B5563;
        line-height:1.6;
        white-space:pre-line;
        flex:1;
    }
    .silapar-detail-footer{
        margin-top:18px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:12px;
        flex-wrap:wrap;
    }
    .silapar-detail-note{
        font-size:0.8rem;
        color:#6B7280;
        max-width: 360px;
    }
    .silapar-detail-actions{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
        justify-content:flex-end;
    }
    .silapar-detail-btn{
        padding:8px 18px;
        border-radius:999px;
        border:none;
        font-size:0.85rem;
        font-weight:600;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:6px;
        cursor:pointer;
    }
    .silapar-detail-btn-back{
        background:#111827;
        color:#fff;
    }
    .silapar-detail-btn-save{
        background:#8B0000;
        color:#fff;
    }
    .silapar-detail-btn:hover{
        filter:brightness(1.05);
        text-decoration:none;
    }

    @media (max-width:768px){
        .silapar-detail-card{
            grid-template-columns:1fr;
        }
        .silapar-detail-img{
            max-height:260px;
        }
        .silapar-detail-footer{
            flex-direction:column;
            align-items:flex-start;
        }
        .silapar-detail-actions{
            width:100%;
            justify-content:flex-start;
        }
    }
</style>

<div class="silapar-detail-wrap">
    {{-- Tombol kembali kecil di atas --}}
    <div class="mb-3">
        <a href="{{ route('menus.index') }}" class="silapar-detail-btn silapar-detail-btn-back">
            ← Kembali ke daftar menu
        </a>
    </div>

    <div class="silapar-detail-card">
        <div>
            <img
                src="{{ $menu->image ? asset('images/menus/' . $menu->image) : asset('images/menus/default.jpg') }}"
                alt="{{ $menu->name }}"
                class="silapar-detail-img"
            >
        </div>

        <div class="silapar-detail-body">
            <div class="silapar-detail-badge">Menu pilihan</div>

            <h1 class="silapar-detail-title">{{ $menu->name }}</h1>

            <div class="silapar-detail-price">
                Rp {{ number_format($menu->price, 0, ',', '.') }}
            </div>

            <div class="silapar-detail-desc">
                {{ $menu->description ?: 'Deskripsi detail makanan ini belum diisi.' }}
            </div>

            <div class="silapar-detail-footer">
                <div class="silapar-detail-note">
                    *Menu ini berasal dari rekomendasi berdasarkan kisaran harga yang kamu pilih di halaman sebelumnya.
                    Kamu juga bisa menyimpan menu ini ke keranjang untuk dilihat lagi nanti.
                </div>

                <div class="silapar-detail-actions">
                    {{-- Tombol simpan ke keranjang / riwayat pilihan --}}
                    <form method="POST" action="{{ route('cart.store', $menu->id) }}">
                        @csrf
                        <button type="submit" class="silapar-detail-btn silapar-detail-btn-save">
                            ⭐ Simpan ke Keranjang
                        </button>
                    </form>

                    {{-- Tombol kembali --}}
                    <a href="{{ route('menus.index') }}" class="silapar-detail-btn silapar-detail-btn-back">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
