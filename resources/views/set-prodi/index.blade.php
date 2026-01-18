@extends('layouts.app')

@section('content')

<nav class="breadcrumb mb-3">
    <span>Pengaturan</span> / <strong>Set Prodi & Tahun Aktif</strong>
</nav>

<h5 class="mb-3">Set Prodi & Tahun Kurikulum Aktif</h5>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($active && $active->fakultas && $active->prodi)
<div class="alert alert-info">
    <strong>Aktif Saat Ini:</strong><br>
    Fakultas: {{ $active->fakultas->nama_fakultas }} <br>
    Prodi: {{ $active->prodi->nama_prodi }} <br>
    Tahun Kurikulum: {{ $active->tahun_kurikulum }}
</div>
@else
<div class="alert alert-danger">
    Belum ada Prodi & Tahun Kurikulum yang diset aktif
</div>
@endif


<div class="card">
<div class="card-body">

<form method="POST" action="{{ route('set-prodi.store') }}">
@csrf

<div class="row mb-3">
    <div class="col-md-6">
        <label>Fakultas</label>
        <select name="fakultas_id" class="form-select" required>
            <option value="">-- Pilih Fakultas --</option>
            @foreach($fakultas as $f)
                <option value="{{ $f->id }}">
                    {{ $f->nama_fakultas }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label>Program Studi</label>
        <select name="prodi_id" class="form-select" required>
            <option value="">-- Pilih Prodi --</option>
            @foreach($prodi as $p)
                <option value="{{ $p->id }}">
                    {{ $p->nama_prodi }} - {{ $p->fakultas->nama_fakultas }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-3">
    <label>Tahun Kurikulum</label>
    <select name="tahun_kurikulum" class="form-select" required>
        @for($y = date('Y'); $y >= date('Y')-10; $y--)
            <option value="{{ $y }}">{{ $y }}</option>
        @endfor
    </select>
</div>

<button class="btn btn-primary">
    <i class="bi bi-check-circle"></i> Set Prodi & Tahun yang akan dikelola
</button>

</form>

</div>
</div>

@endsection
