@extends('layouts.app')

@section('content')

<h5>Edit Prodi</h5>

<form action="{{ route('prodi.update',$prodi->id) }}" method="POST">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Nama Prodi</label>
    <input name="nama_prodi" class="form-control"
           value="{{ $prodi->nama_prodi }}" required>
</div>

<div class="mb-3">
    <label>Fakultas</label>
    <select name="fakultas_id" class="form-select">
        @foreach($fakultas as $f)
            <option value="{{ $f->id }}"
                {{ $prodi->fakultas_id == $f->id ? 'selected' : '' }}>
                {{ $f->nama_fakultas }}
            </option>
        @endforeach
    </select>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="{{ route('data-master.index') }}" class="btn btn-secondary">Kembali</a>

</form>
@endsection
