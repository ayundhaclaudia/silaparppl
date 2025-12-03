@extends('layouts.app')

@section('content')

@php

    $currentCategory = request('category');
    $currentRating = request('rating');
@endphp

<div class="space-y-10">

    <div class="bg-white rounded-xl card-shadow p-8 lg:p-10 max-w-2xl mx-auto text-center">
        <h1 class="text-4xl font-extrabold text-primary">
            Cari Menu Sesuai Budget Anda 💰
        </h1>
        <p class="text-gray-600 mt-3 mb-6">
            Sistem SILAPAR akan menampilkan rekomendasi menu dengan harga yang tepat dan rating terbaik.
        </p>

        <form method="GET" action="{{ route('menus.index') }}" class="flex gap-3 justify-center">

            <input type="number" name="budget" id="budget" value="{{ old('budget', $budget ?? '') }}"
                   class="w-full max-w-xs px-5 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-color transition duration-150"
                   placeholder="Maksimal budget (Rp)" required>

            <button type="submit"
                    class="px-6 py-3 rounded-xl text-white font-semibold gradient-btn shadow-lg">
                Cari
            </button>

            @if($currentCategory)
                <input type="hidden" name="category" value="{{ $currentCategory }}">
            @endif
            @if($currentRating)
                <input type="hidden" name="rating" value="{{ $currentRating }}">
            @endif

        </form>
        @error('budget')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($budget)
            <form method="GET" action="{{ route('menus.index') }}" id="filter-form">

                <input type="hidden" name="budget" value="{{ $budget }}">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 py-4 border-b border-gray-200">

                    <h2 class="text-2xl font-semibold">
                        Hasil Rekomendasi
                        <span class="text-gray-500 font-normal text-lg">untuk Budget Maksimal: </span>
                        <span class="text-primary font-bold" style="color: var(--primary-color);">Rp {{ number_format(intval($budget), 0, ',', '.') }}</span>
                    </h2>

                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600 hidden sm:block">Filter:</span>

                        <select name="category" onchange="document.getElementById('filter-form').submit()"
                                class="p-2 border border-gray-300 rounded-lg text-sm">
                            <option value="">Semua Kategori</option>
                            <option value="1" {{ $currentCategory == '1' ? 'selected' : '' }}>Makanan Berat</option>
                            <option value="2" {{ $currentCategory == '2' ? 'selected' : '' }}>Makanan Ringan</option>
                            <option value="3" {{ $currentCategory == '3' ? 'selected' : '' }}>Minuman</option>
                        </select>

                        <select name="rating" onchange="document.getElementById('filter-form').submit()"
                                class="p-2 border border-gray-300 rounded-lg text-sm">
                            <option value="">Rating (Semua)</option>
                            <option value="4.5" {{ $currentRating == '4.5' ? 'selected' : '' }}>Rating 4.5+</option>
                            <option value="4.0" {{ $currentRating == '4.0' ? 'selected' : '' }}>Rating 4.0+</option>
                            <option value="3.0" {{ $currentRating == '3.0' ? 'selected' : '' }}>Rating 3.0+</option>
                        </select>

                        <a href="{{ route('menus.index', ['budget' => $budget]) }}"
                           class="text-sm text-gray-500 hover:text-primary transition duration-150" style="color: var(--primary-color);">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        @else
            <div class="bg-primary-light border border-gray-200 text-gray-700 p-4 rounded-lg text-center" style="background-color: rgba(160, 0, 0, 0.05);">
                Silakan masukkan budget di atas untuk mulai melihat rekomendasi menu terbaik di SWK Ketintang.
            </div>
        @endif
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($budget && $menus->isEmpty())
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-6 rounded-lg text-center font-medium">
                Maaf, tidak ditemukan menu dengan budget maksimal Rp {{ number_format(intval($budget), 0, ',', '.') }}. Coba naikkan budget Anda!
            </div>
        @elseif($budget)
            <div class="text-sm text-gray-500 mb-4">{{ $menus->count() }} hasil ditemukan</div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($menus as $menu)
                    <article class="bg-white rounded-xl overflow-hidden card-shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 ease-in-out">
                        <a href="{{ route('menus.show', $menu->id) }}" class="block">
                            <div class="relative h-36 bg-gray-100">
                                @if($menu->image)
                                    <img src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full">
                                @else
                                    <div class="flex flex-col items-center justify-center h-full text-gray-400">


[Image of a plate and cutlery icon]

                                        <span class="mt-2 text-xs">No Image Available</span>
                                    </div>
                                @endif

                                <div class="absolute top-3 right-3 bg-white px-3 py-1 rounded-full text-sm font-bold text-primary shadow-sm" style="color: var(--primary-color);">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </div>
                                <div class="absolute bottom-0 left-0 bg-primary-light text-primary px-3 py-1 rounded-tr-lg text-xs font-semibold" style="background-color: rgba(160, 0, 0, 0.05); color: var(--primary-color);">
                                    {{ $menu->category->name ?? 'Kategori' }}
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="font-bold text-xl mb-1 text-primary line-clamp-1" style="color: var(--primary-color);">{{ $menu->name }}</h3>

                                <div class="flex items-center text-sm text-gray-500 mb-3">


[Image of a vendor stall icon]

                                    <span class="ml-1 line-clamp-1">{{ $menu->stall->name ?? 'Nama Penjual' }} (Lapak {{ $menu->stall->location ?? 'A01' }})</span>
                                </div>

                                <div class="flex items-center text-yellow-500 text-sm">
                                    {{-- Asumsi $menu->rating tersedia --}}
                                    @for ($i = 0; $i < floor($menu->rating ?? 4.5); $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.373l6.568-.955L10 1l2.945 5.418 6.568.955-4.758 4.172 1.123 6.545z"/></svg>
                                    @endfor
                                    <span class="ml-2 text-gray-600 font-semibold">{{ number_format($menu->rating ?? 4.5, 1) }}</span>
                                    <span class="text-xs text-gray-400 ml-1">({{ $menu->reviews_count ?? 50 }} Ulasan)</span>
                                </div>

                                <p class="text-sm text-gray-600 mt-3 line-clamp-2">{{ $menu->description ?? 'Deskripsi makanan ini belum tersedia.' }}</p>

                                <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                                    <span class="text-sm text-primary font-semibold hover:underline" style="color: var(--primary-color);">Lihat Detail &rarr;</span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
