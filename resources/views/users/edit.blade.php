@extends('layouts.app')

@section('content')
<h4>Edit Pengguna</h4>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Email</label>
        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
    </div>

    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control"
               value="{{ $user->nama_lengkap }}" required>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-select">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="kaprodi" {{ $user->role == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
            <option value="dosen" {{ $user->role == 'dosen' ? 'selected' : '' }}>Dosen</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option value="Aktif" {{ $user->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Nonaktif" {{ $user->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>

    <button class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
