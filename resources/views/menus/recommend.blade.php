@extends('layouts.app')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<div style="background:#F7D794; padding:28px 0 60px;">
    <div style="max-width:1200px;margin:0 auto;padding:0 1.5rem;">
        <h2 style="font-weight:800;font-size:1.4rem;color:#7F1D1D;margin-bottom:10px;">
            Rekomendasi Menu
        </h2>
        <p style="color:#6B7280;margin-bottom:16px;">
            Cari menu berdasarkan nama (contoh: <b>bakso</b>, <b>nasi goreng</b>). Hasil diurutkan berdasarkan rating tertinggi.
        </p>

        <form method="GET" action="{{ route('menus.recommend') }}" style="display:flex;gap:10px;flex-wrap:wrap;">
            <input
                type="text"
                name="q"
                value="{{ $q }}"
                placeholder="Cari menu..."
                style="flex:1;min-width:220px;border:none;border-radius:999px;padding:12px 16px;outline:none;"
            >
            <button type="submit"
                style="border:none;border-radius:999px;padding:12px 22px;font-weight:700;background:#8B0000;color:#fff;cursor:pointer;">
                Cari
            </button>
        </form>

        @if($q !== '' && $menus->count() === 0)
            <div style="margin-top:18px;background:#FFF7D6;border-radius:16px;padding:18px;text-align:center;color:#92400E;">
                <b>Menu tidak ditemukan</b><br>
                Coba kata kunci lain ya 😊
            </div>
        @endif

        <div style="margin-top:18px;display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,280px));gap:24px;justify-content:center;">
            @foreach($menus as $menu)
                <div style="background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 10px 28px rgba(0,0,0,.14);display:flex;flex-direction:column;">
                    <div style="width:100%;aspect-ratio:4/3;overflow:hidden;">
                        <img
                            src="{{ $menu->image ? asset('images/menus/' . $menu->image) : asset('images/menus/default.jpg') }}"
                            alt="{{ $menu->name }}"
                            style="width:100%;height:100%;object-fit:cover;display:block;"
                        >
                    </div>

                    <div style="padding:14px 18px 16px;display:flex;flex-direction:column;flex:1;">
                        <div style="font-weight:800;margin-bottom:4px;">{{ $menu->name }}</div>

                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                            <div style="font-weight:700;color:#A00000;">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </div>
                            <div style="font-weight:700;color:#B45309;">
                                ⭐ {{ number_format($menu->rating ?? 0, 1) }}/5
                            </div>
                        </div>

                        <div style="font-size:.85rem;color:#6B7280;flex:1;margin-bottom:10px;">
                            {{ Str::limit($menu->description, 70) }}
                        </div>

                        <a href="{{ route('menus.show', $menu->id) }}"
                           style="text-align:center;border-radius:999px;padding:9px 0;font-weight:700;background:#111827;color:#fff;text-decoration:none;">
                           Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

@endsection