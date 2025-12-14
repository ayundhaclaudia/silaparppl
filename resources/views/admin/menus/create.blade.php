@extends('layouts.app')

@section('content')
<div style="max-width:900px;margin:28px auto;padding:0 1.5rem;">
    <h2 style="font-size:24px;font-weight:800;margin-bottom:14px;">Tambah Menu</h2>

    @if($errors->any())
        <div style="background:#FEE2E2;color:#991B1B;padding:10px 12px;border-radius:10px;margin-bottom:14px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data"
          style="background:#fff;border-radius:16px;padding:16px;box-shadow:0 10px 24px rgba(0,0,0,.10);">
        @csrf

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div>
                <label>Nama</label>
                <input name="name" value="{{ old('name') }}" style="width:100%;padding:10px;border:1px solid #E5E7EB;border-radius:10px;">
            </div>
            <div>
                <label>Harga</label>
                <input type="number" name="price" value="{{ old('price') }}" style="width:100%;padding:10px;border:1px solid #E5E7EB;border-radius:10px;">
            </div>
            <div>
                <label>Rating (0-5)</label>
                <input type="number" step="0.1" name="rating" value="{{ old('rating', 4.0) }}" style="width:100%;padding:10px;border:1px solid #E5E7EB;border-radius:10px;">
            </div>
            <div>
                <label>Jumlah Review</label>
                <input type="number" name="reviews_count" value="{{ old('reviews_count', 0) }}" style="width:100%;padding:10px;border:1px solid #E5E7EB;border-radius:10px;">
            </div>
        </div>

        <div style="margin-top:12px;">
            <label>Deskripsi</label>
            <textarea name="description" rows="4" style="width:100%;padding:10px;border:1px solid #E5E7EB;border-radius:10px;">{{ old('description') }}</textarea>
        </div>

        <div style="margin-top:12px;">
            <label>Gambar (jpg/png/webp)</label>
            <input type="file" name="image">
        </div>

        <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit" style="border:none;background:#8B0000;color:#fff;padding:10px 16px;border-radius:999px;font-weight:800;cursor:pointer;">
                Simpan
            </button>
            <a href="{{ route('admin.menus.index') }}" style="text-decoration:none;background:#111827;color:#fff;padding:10px 16px;border-radius:999px;font-weight:800;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
