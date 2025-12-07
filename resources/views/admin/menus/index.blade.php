@extends('layouts.app')

@section('content')
    <style>
        .admin-wrap {
            max-width: 1100px;
            margin: 24px auto 40px;
            padding: 0 1.5rem;
        }
        .admin-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .admin-sub {
            font-size: .9rem;
            color: #6B7280;
            margin-bottom: 18px;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(0,0,0,0.12);
        }
        .admin-table th,
        .admin-table td {
            padding: 10px 12px;
            font-size: .9rem;
            border-bottom: 1px solid #E5E7EB;
        }
        .admin-table th {
            background: #111827;
            color: #F9FAFB;
            text-align: left;
        }
        .admin-table tr:last-child td {
            border-bottom: none;
        }
        .admin-badge-price {
            font-weight: 600;
            color: #A00000;
        }
        .admin-actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }
        .admin-btn {
            border-radius: 999px;
            border: none;
            padding: 5px 10px;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .admin-btn-add {
            background: #10B981;
            color: #fff;
            margin-bottom: 10px;
        }
        .admin-btn-edit {
            background: #F59E0B;
            color: #111827;
        }
        .admin-btn-delete {
            background: #B91C1C;
            color: #fff;
        }
        .admin-btn:hover {
            filter: brightness(1.05);
            text-decoration: none;
        }
    </style>

    <div class="admin-wrap">
        <div class="mb-2">
            <div class="admin-title">Kelola Menu</div>
            <div class="admin-sub">
                Tambah, ubah, atau hapus menu yang nantinya akan muncul di halaman user.
            </div>
        </div>

        @if (session('success'))
            <div style="background:#DCFCE7;color:#166534;padding:8px 12px;border-radius:8px;margin-bottom:10px;font-size:.85rem;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tombol tambah menu (nanti arahkan ke route create admin) --}}
        <a href="{{ route('admin.menus.create') }}" class="admin-btn admin-btn-add">
            + Tambah Menu
        </a>

        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Nama Menu</th>
                    <th style="width:120px;">Harga</th>
                    <th style="width:80px;">Rating</th>
                    <th style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $index => $menu)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $menu->name }}</td>
                        <td class="admin-badge-price">
                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                        </td>
                        <td>
                            {{ $menu->rating ?? '-' }}
                        </td>
                        <td>
                            <div class="admin-actions">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                   class="admin-btn admin-btn-edit">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.menus.destroy', $menu->id) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn admin-btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:18px;">
                            Belum ada menu. Tambahkan menu baru menggunakan tombol "Tambah Menu".
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
