@extends('layouts.app')

@section('content')
<div class="space-y-6">

  <!-- Hero / Title -->
  <div class="bg-white rounded-lg card-shadow p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
      <div>
        <h1 class="text-3xl font-bold" style="color:var(--accent-dark)">Rekomendasi Menu</h1>
        <p class="text-gray-600 mt-1">Masukkan budget — sistem akan menampilkan menu dengan harga yang tepat sesuai yang kamu masukkan.</p>
      </div>

      <div class="w-full md:w-1/3">
        <form method="GET" action="{{ route('menus.index') }}" class="flex gap-2">
          <input type="number" name="budget" id="budget" value="{{ old('budget', $budget) }}"
                 class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-300"
                 placeholder="Masukkan budget (contoh: 10000)" required>
          <button type="submit"
                  class="px-4 py-2 rounded-md text-white"
                  style="background: linear-gradient(180deg,var(--accent-dark) 0%, var(--accent-dark-2) 100%);">
            Cari
          </button>
        </form>
        @error('budget') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
      </div>
    </div>
  </div>

  <!-- Result header -->
  <div class="flex items-center justify-between">
    @if($budget === null || $budget === '')
      <div class="text-gray-600">Silakan masukkan budget untuk melihat rekomendasi.</div>
    @else
      <h2 class="text-xl font-semibold">Hasil untuk budget: <span class="text-yellow-600">Rp {{ number_format(intval($budget), 0, ',', '.') }}</span></h2>
      <div class="text-sm text-gray-500">{{ $menus->count() }} hasil</div>
    @endif
  </div>

  <!-- Cards grid -->
  <div>
    @if($budget && $menus->isEmpty())
      <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded">Tidak ditemukan menu dengan harga Rp {{ number_format(intval($budget), 0, ',', '.') }}.</div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($menus as $menu)
          <article class="bg-white rounded-lg overflow-hidden card-shadow hover:scale-[1.01] transition-transform">
            <a href="{{ route('menus.show', $menu->id) }}" class="block">
              <div class="relative h-44 sm:h-48 lg:h-40 bg-gray-100">
                @if($menu->image)
                  <img src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full">
                @else
                  <div class="flex items-center justify-center h-full text-gray-400">No image</div>
                @endif
                <!-- ribbon price top-right -->
                <div class="absolute top-3 right-3 bg-white/90 px-3 py-1 rounded-full text-sm font-medium" style="border:1px solid rgba(0,0,0,0.06);">
                  Rp {{ number_format($menu->price,0,',','.') }}
                </div>
              </div>

              <div class="p-4">
                <h3 class="font-semibold text-lg" style="color:var(--accent-dark)">{{ $menu->name }}</h3>
                <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $menu->description }}</p>

                <div class="mt-4 flex items-center justify-between">
                  <div class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-800">Harga Pas</div>
                  <div>
                    <span class="text-sm text-gray-500 mr-2">Lihat detail</span>
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> --}}
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  </div>
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
