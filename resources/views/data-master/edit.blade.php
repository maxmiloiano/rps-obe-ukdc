@extends('layouts.app')

@section('content')

<h5 class="mb-3">Edit Fakultas</h5>

<form action="{{ route('fakultas.update', $fakultas->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Kode Fakultas</label>
        <input type="text"
               name="kode_fakultas"
               class="form-control"
               value="{{ $fakultas->kode_fakultas }}"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Fakultas</label>
        <input type="text"
               name="nama_fakultas"
               class="form-control"
               value="{{ $fakultas->nama_fakultas }}"
               required>
    </div>

    <button class="btn btn-primary">
        Simpan Perubahan
    </button>

    <a href="{{ route('data-master.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</form>

@endsection
