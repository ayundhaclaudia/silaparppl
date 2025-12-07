@extends('layouts.app')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<style>
    .cart-wrapper{
        max-width: 1100px;
        margin: 0 auto;
        padding: 24px 1.5rem 40px;
    }
    .cart-title{
        font-size:1.4rem;
        font-weight:700;
        margin-bottom:4px;
    }
    .cart-sub{
        font-size:0.9rem;
        color:#6B7280;
        margin-bottom:20px;
    }
    .cart-grid{
        display:grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 280px));
        gap:20px;
        justify-content:center;
    }
    .cart-card{
        background:#fff;
        border-radius:18px;
        overflow:hidden;
        box-shadow:0 8px 24px rgba(0,0,0,0.14);
        display:flex;
        flex-direction:column;
    }
    .cart-img-wrap{
        width:100%;
        aspect-ratio:4/3;
        overflow:hidden;
    }
    .cart-img-wrap img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
    }
    .cart-body{
        padding:14px 18px 16px;
        display:flex;
        flex-direction:column;
        gap:6px;
        flex:1;
    }
    .cart-name{
        font-size:0.98rem;
        font-weight:700;
    }
    .cart-price{
        font-size:0.9rem;
        font-weight:600;
        color:#A00000;
    }
    .cart-qty{
        font-size:0.8rem;
        color:#6B7280;
    }
    .cart-actions{
        margin-top:auto;
        display:flex;
        justify-content:space-between;
        gap:8px;
    }
    .btn-detail,
    .btn-delete{
        flex:1;
        border-radius:999px;
        border:none;
        padding:8px 0;
        font-size:0.8rem;
        font-weight:600;
        text-align:center;
        text-decoration:none;
        cursor:pointer;
    }
    .btn-detail{
        background:#8B0000;
        color:#fff;
    }
    .btn-delete{
        background:#F3F4F6;
        color:#111827;
    }
    .cart-empty{
        background:#FFF7D6;
        padding:22px;
        border-radius:16px;
        text-align:center;
        margin-top:18px;
        color:#92400E;
    }
</style>

<div class="cart-wrapper">
    <h1 class="cart-title">Keranjang Pilihanmu</h1>
    <p class="cart-sub">
        Menu-menu yang kamu simpan akan muncul di sini sebagai riwayat pilihan.
    </p>

    @if (session('success'))
        <div class="cart-empty" style="margin-top:0; margin-bottom:16px; background:#ECFDF5; color:#166534;">
            {{ session('success') }}
        </div>
    @endif

    @if ($items->count() === 0)
        <div class="cart-empty">
            Belum ada menu yang kamu simpan.
            Silakan kembali ke halaman rekomendasi dan klik <strong>"Simpan Riwayat Pilihan"</strong> pada menu yang kamu suka.
        </div>
    @else
        <div class="cart-grid">
            @foreach ($items as $item)
                @php
                    $menu = $item->menu;
                @endphp
                <div class="cart-card">
                    <div class="cart-img-wrap">
                        <img
                            src="{{ $menu->image ? asset('images/menus/' . $menu->image) : asset('images/menus/default.jpg') }}"
                            alt="{{ $menu->name }}"
                        >
                    </div>
                    <div class="cart-body">
                        <div class="cart-name">{{ $menu->name }}</div>
                        <div class="cart-price">
                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                        </div>
                        <div class="cart-qty">
                            Disimpan sebanyak {{ $item->quantity }}x
                        </div>

                        <div class="cart-actions">
                            <a href="{{ route('menus.show', $menu->id) }}" class="btn-detail">
                                Detail
                            </a>

                            <form method="POST" action="{{ route('cart.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
