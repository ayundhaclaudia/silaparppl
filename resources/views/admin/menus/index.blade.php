@extends('layouts.app')

@section('content')
<div style="max-width:1200px;margin:28px auto;padding:0 1.5rem;">
    <h2 style="font-size:28px;font-weight:800;margin-bottom:6px;">Kelola Menu</h2>
    <p style="color:#6B7280;margin-bottom:14px;">
        Tambah, ubah, atau hapus menu yang nantinya akan muncul di halaman user.
    </p>

    @if(session('success'))
        <div style="background:#D1FAE5;color:#065F46;padding:10px 12px;border-radius:10px;margin-bottom:14px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.menus.create') }}"
       style="display:inline-block;background:#10B981;color:#fff;padding:10px 16px;border-radius:999px;text-decoration:none;font-weight:700;margin-bottom:14px;">
        + Tambah Menu
    </a>

    <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 10px 24px rgba(0,0,0,.10);">
        <table style="width:100%;border-collapse:collapse;">
            <thead style="background:#111827;color:#fff;">
                <tr>
                    <th style="padding:12px;text-align:left;">#</th>
                    <th style="padding:12px;text-align:left;">Nama Menu</th>
                    <th style="padding:12px;text-align:left;">Harga</th>
                    <th style="padding:12px;text-align:left;">Rating</th>
                    <th style="padding:12px;text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($menus as $i => $menu)
                <tr style="border-bottom:1px solid #E5E7EB;">
                    <td style="padding:12px;">{{ $i+1 }}</td>
                    <td style="padding:12px;font-weight:600;">{{ $menu->name }}</td>
                    <td style="padding:12px;color:#A00000;font-weight:700;">
                        Rp {{ number_format($menu->price,0,',','.') }}
                    </td>
                    <td style="padding:12px;">{{ number_format($menu->rating,1) }}</td>
                    <td style="padding:12px;text-align:right;">
                        <a href="{{ route('admin.menus.edit', $menu) }}"
                           style="display:inline-block;background:#F59E0B;color:#111827;padding:8px 14px;border-radius:999px;text-decoration:none;font-weight:700;">
                            Edit
                        </a>

                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Yakin hapus menu ini?')"
                                style="border:none;background:#B91C1C;color:#fff;padding:8px 14px;border-radius:999px;font-weight:700;cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
