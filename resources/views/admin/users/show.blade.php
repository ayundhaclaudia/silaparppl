@extends('layouts.app')

@section('content')
<div style="max-width:900px;margin:24px auto;padding:0 1.5rem;">
    <a href="{{ route('admin.users.index') }}"
       style="display:inline-block;background:#111827;color:#fff;font-weight:700;
              padding:10px 14px;border-radius:999px;text-decoration:none;font-size:13px;">
        ← Kembali
    </a>

    <div style="margin-top:14px;background:#fff;border-radius:18px;box-shadow:0 10px 28px rgba(0,0,0,0.10);padding:18px 20px;">
        <h2 style="margin:0 0 10px;font-size:20px;font-weight:800;">Detail User</h2>

        <div style="display:grid;gap:10px;">
            <div><strong>Nama:</strong> {{ $user->name }}</div>
            <div><strong>Email:</strong> {{ $user->email }}</div>
            <div><strong>Role:</strong> {{ ($user->is_admin ?? 0) ? 'Admin' : 'User' }}</div>
            <div><strong>Terdaftar:</strong> {{ $user->created_at?->format('d M Y H:i') }}</div>
        </div>
    </div>
</div>
@endsection
