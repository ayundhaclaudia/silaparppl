@extends('layouts.app')

@section('content')
<div style="max-width:1200px;margin:24px auto;padding:0 1.5rem;">

    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:14px;">
        <div>
            <h2 style="margin:0;font-size:20px;font-weight:800;color:#111827;">Daftar User Terdaftar</h2>
            <p style="margin:6px 0 0;color:#6B7280;font-size:14px;">Berikut daftar akun yang sudah register.</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#ECFDF5;border:1px solid #A7F3D0;color:#065F46;padding:10px 12px;border-radius:12px;margin-bottom:12px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#FEF2F2;border:1px solid #FECACA;color:#991B1B;padding:10px 12px;border-radius:12px;margin-bottom:12px;">
            {{ session('error') }}
        </div>
    @endif

    <div style="background:#fff;border-radius:16px;box-shadow:0 10px 28px rgba(0,0,0,0.10);overflow:hidden;">
        <div style="overflow:auto;">
            <table style="width:100%;border-collapse:collapse;min-width:760px;">
                <thead style="background:#111827;color:#F9FAFB;">
                    <tr>
                        <th style="text-align:left;padding:12px 14px;font-size:13px;">Nama</th>
                        <th style="text-align:left;padding:12px 14px;font-size:13px;">Email</th>
                        <th style="text-align:left;padding:12px 14px;font-size:13px;">Role</th>
                        <th style="text-align:left;padding:12px 14px;font-size:13px;">Terdaftar</th>
                        <th style="text-align:right;padding:12px 14px;font-size:13px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="border-bottom:1px solid #E5E7EB;">
                            <td style="padding:12px 14px;font-weight:600;color:#111827;">
                                {{ $user->name }}
                            </td>
                            <td style="padding:12px 14px;color:#374151;">
                                {{ $user->email }}
                            </td>
                            <td style="padding:12px 14px;color:#374151;">
                                {{ ($user->is_admin ?? 0) ? 'Admin' : 'User' }}
                            </td>
                            <td style="padding:12px 14px;color:#6B7280;font-size:13px;">
                                {{ $user->created_at?->format('d M Y H:i') }}
                            </td>
                            <td style="padding:12px 14px;text-align:right;white-space:nowrap;">
                                <a href="{{ route('admin.users.show', $user->id) }}"
                                   style="display:inline-block;background:#FFC300;color:#111827;font-weight:700;
                                          padding:8px 12px;border-radius:999px;text-decoration:none;font-size:12px;">
                                    Detail
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Yakin hapus user ini?')"
                                            style="background:#A00000;color:#fff;font-weight:700;
                                                   padding:8px 12px;border-radius:999px;border:none;
                                                   font-size:12px;cursor:pointer;margin-left:6px;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:16px 14px;color:#6B7280;text-align:center;">
                                Belum ada user terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="padding:12px 14px;">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
