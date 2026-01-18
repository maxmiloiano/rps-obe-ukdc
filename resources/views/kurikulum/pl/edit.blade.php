@extends('layouts.app')

@section('content')

<nav class="breadcrumb mb-3">
    <span>Kurikulum</span> <span class="mx-2">›</span> <strong>Edit Profil Lulusan</strong>
</nav>

<div class="card">
<div class="card-body">

<form method="POST" action="{{ route('kurikulum.pl.update',$pl->id) }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Kode PL</label>
    <input name="kode_pl" class="form-control"
           value="{{ $pl->kode_pl }}" required>
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="deskripsi" rows="4"
              class="form-control" required>{{ $pl->deskripsi }}</textarea>
</div>

<button class="btn btn-primary">Simpan Perubahan</button>
<a href="{{ route('kurikulum.pl.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

@endsection
