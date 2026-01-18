@extends('layouts.app')

@section('content')

<nav class="breadcrumb mb-3">
    <span>Kurikulum</span>
    <span class="mx-2">›</span>
    <strong>Edit CPL Prodi</strong>
</nav>

<div class="card">
<div class="card-body">

<form method="POST" action="{{ route('kurikulum.cpl.update', $cpl->id) }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Kode CPL</label>
    <input
        type="text"
        name="kode_cpl"
        class="form-control"
        value="{{ $cpl->kode_cpl }}"
        required
    >
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <textarea
        name="deskripsi"
        rows="4"
        class="form-control"
        required
    >{{ $cpl->deskripsi }}</textarea>
</div>

<button class="btn btn-primary">
    Simpan Perubahan
</button>

<a href="{{ route('kurikulum.cpl.index') }}" class="btn btn-secondary">
    Kembali
</a>

</form>

</div>
</div>

@endsection
