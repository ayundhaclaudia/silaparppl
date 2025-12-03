@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary-color: #A00000;
        --accent-color: #FFC300;
    }
    .text-primary { color: var(--primary-color); }
    /* Menambahkan class untuk aspek rasio horizontal pada gambar */
    .aspect-horizontal {
        /* Tailwind: aspect-h-3 aspect-w-4 (3:4) atau aspect-h-9 aspect-w-16 (16:9) */
        /* Kita pakai custom CSS untuk memastikan rasio 16:9 jika tidak ada plugin */
        position: relative;
        padding-top: 56.25%; /* 16:9 Aspect Ratio (9/16 * 100%) */
        height: 0;
    }
    .aspect-horizontal img, .aspect-horizontal div {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

<div class="mb-6">
    <a href="{{ route('menus.index') }}" class="text-gray-500 hover:text-primary font-medium transition duration-150">
        &larr; Kembali ke Hasil Rekomendasi
    </a>
</div>

<div class="bg-white rounded-xl card-shadow overflow-hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2">

        <div class="lg:h-auto">

            <div class="aspect-horizontal">
                @if($menu->image)
                    <img src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover">
                @else
                    <div class="flex items-center justify-center text-gray-400 bg-gray-50 p-6">


[Image of a plate and cutlery icon]

                        <span class="ml-3">Gambar Menu Tidak Tersedia</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="p-8 lg:p-10">

            <div class="text-sm font-semibold tracking-wider uppercase text-gray-500 mb-2">
                {{ $menu->category->name ?? 'Makanan Berat' }}
            </div>

            <h1 class="text-4xl font-extrabold text-primary mb-3">{{ $menu->name }}</h1>

            <div class="flex items-center gap-4 border-b border-gray-100 pb-4">
                <div class="text-3xl font-bold text-primary">
                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                </div>
                <div class="px-4 py-1 rounded-full bg-accent-color text-gray-900 text-sm font-semibold">
                    ⭐ Rekomendasi Budget
                </div>
            </div>

            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="flex items-center">
                    <span class="text-yellow-500 text-2xl mr-2 font-bold">{{ number_format($menu->rating ?? 4.5, 1) }}</span>
                    <span class="text-yellow-500">
                        {{-- Placeholder Bintang --}}
                        <svg class="w-5 h-5 fill-current inline" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.373l6.568-.955L10 1l2.945 5.418 6.568.955-4.758 4.172 1.123 6.545z"/></svg>
                    </span>
                    <span class="ml-2 text-sm text-gray-500">({{ $menu->reviews_count ?? 50 }} Ulasan)</span>
                </div>

                <div class="flex items-center text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span class="font-medium">{{ $menu->stall->name ?? 'Lapak A01' }}</span>
                    <span class="text-sm text-gray-500 ml-1">(SWK Ketintang)</span>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-3 border-b pb-2 text-gray-700">Deskripsi Menu</h3>
                <div class="text-gray-700 leading-relaxed text-base">
                    {!! nl2br(e($menu->description ?? 'Deskripsi detail makanan ini belum diisi oleh penjual.')) !!}
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="button" class="px-6 py-3 rounded-lg text-white font-semibold gradient-btn shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    Simpan Riwayat Pilihan
                </button>
            </div>

            <div class="mt-6 text-sm text-gray-500 pt-4 border-t">
                *Menu ini ditemukan berdasarkan kriteria harga dan rating terbaik.
            </div>
        </div>
    </div>
</div>
@endsection
