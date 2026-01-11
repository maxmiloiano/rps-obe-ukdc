@extends('layouts.app')

@section('content')

<!-- BREADCRUMB -->
<nav class="breadcrumb mb-3">
    <a href="{{ route('data-master.index',['tab'=>'kaprodi']) }}">Data Master</a>
    <span class="mx-1">/</span>
    <strong>Edit Kaprodi</strong>
</nav>

<h5 class="mb-3">Edit Data Kaprodi</h5>

<div class="card">
<div class="card-body">

<form method="POST"
      action="{{ route('kaprodi.update', $kaprodi->id) }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Program Studi</label>
    <select name="prodi_id" class="form-select" required>
        @foreach($prodi as $p)
            <option value="{{ $p->id }}"
                {{ $kaprodi->prodi_id == $p->id ? 'selected' : '' }}>
                {{ $p->nama_prodi }} - {{ $p->fakultas->nama_fakultas }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tahun</label>
    <select name="tahun" class="form-select" required>
        @foreach($tahunList as $t)
            <option value="{{ $t }}"
                {{ $kaprodi->tahun == $t ? 'selected' : '' }}>
                {{ $t }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Nama Ketua Prodi</label>
    <select name="nip" class="form-select" required>
        @foreach($dosen as $d)
            <option value="{{ $d->nip_nik }}"
                {{ $kaprodi->nip == $d->nip_nik ? 'selected' : '' }}>
                {{ $d->nama_dosen }} ({{ $d->nip_nik }})
            </option>
        @endforeach
    </select>
</div>

<div class="mt-4">
    <button class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('data-master.index',['tab'=>'kaprodi']) }}"
       class="btn btn-secondary">
        Kembali
    </a>
</div>

</form>

</div>
</div>

@endsection
