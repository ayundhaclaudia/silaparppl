@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg card-shadow overflow-hidden">
  <div class="grid grid-cols-1 lg:grid-cols-2">
    <div class="h-80 lg:h-auto">
      @if($menu->image)
        <img src="{{ asset('images/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full">
      @else
        <div class="flex items-center justify-center h-full text-gray-400 p-6">No image</div>
      @endif
    </div>

    <div class="p-6">
      <a href="{{ route('menus.index') }}" class="text-sm text-gray-500 underline">&larr; Kembali</a>

      <h1 class="mt-3 text-2xl font-bold" style="color:var(--accent-dark)">{{ $menu->name }}</h1>
      <div class="mt-2 flex items-center gap-4">
        <div class="text-2xl font-semibold" style="color:var(--accent-dark-2)">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
        <div class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-sm">Harga Pas</div>
      </div>

      <div class="mt-4 text-gray-700 leading-relaxed">
        {!! nl2br(e($menu->description)) !!}
      </div>

      <div class="mt-6 flex items-center gap-3">
        <button class="px-4 py-2 rounded-md text-white" style="background: linear-gradient(180deg,var(--accent-dark) 0%, var(--accent-dark-2) 100%);">Simpan</button>
        <a href="{{ route('menus.index') }}" class="px-4 py-2 border rounded-md text-gray-700">Kembali</a>
      </div>
    </div>
  </div>
</div>
@endsection
