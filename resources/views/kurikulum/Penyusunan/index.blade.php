@extends('layouts.app')

@section('content')

{{-- BREADCRUMB --}}
<nav class="breadcrumb mb-3">
    <span>
        <i class="bi bi-journal-text me-1"></i> Kurikulum
    </span>
    <span class="mx-2">›</span>
    <strong>Penyusunan</strong>
</nav>

{{-- INFO --}}
<div class="alert alert-info">
    Saat ini anda sedang mengelola kurikulum OBE
    <strong>{{ $kurikulum->prodi->nama_prodi }}</strong>,
    {{ $kurikulum->prodi->fakultas->nama_fakultas }},
    Tahun {{ $kurikulum->tahun }}
</div>

{{-- TABS --}}
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link active">Penyusunan MK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.mk_prasyarat.index') }}">MK Prasyarat</a></li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.mk_dosen.index') }}">Dosen Pengampu MK</a></li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.indikator_mk.index') }}">Indikator MK</a></li>
</ul>

<form method="POST" action="{{ route('kurikulum.penyusunan.store') }}">
@csrf

{{-- TOOLBAR --}}
<div class="d-flex justify-content-between mb-3">
    <button class="btn btn-success">
        <i class="bi bi-save"></i> Simpan
    </button>

    <input type="search" id="search" class="form-control w-25" placeholder="Search">
</div>

<table id="mkTable" class="table table-bordered text-center">
<thead>
<tr>
    <th>No</th>
    <th>Mata Kuliah (MK)</th>
    <th>SKS</th>
    <th colspan="2">Kategori</th>
    <th colspan="8">Semester</th>
</tr>
<tr>
    <th></th><th></th><th></th>
    <th>Wajib</th><th>Pilihan</th>
    @for($i=1;$i<=8;$i++)
        <th>{{ $i }}</th>
    @endfor
</tr>
</thead>

<tbody>
@foreach($mk as $item)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td class="text-start">
        <strong>{{ $item->kode_mk }}</strong><br>
        {{ $item->nama_mk }}
    </td>

    {{-- SKS --}}
    <td>
        <input type="number" class="form-control"
            name="mk[{{ $item->id }}][sks]"
            value="{{ $item->sks }}">
    </td>

    {{-- KATEGORI --}}
    <td>
        <input type="radio"
            name="mk[{{ $item->id }}][kategori]"
            value="wajib"
            {{ $item->kategori === 'wajib' ? 'checked' : '' }}>
    </td>

    <td>
        <input type="radio"
            name="mk[{{ $item->id }}][kategori]"
            value="pilihan"
            {{ $item->kategori === 'pilihan' ? 'checked' : '' }}>
    </td>

    {{-- SEMESTER --}}
    @for($i=1;$i<=8;$i++)
    <td>
        <input type="radio"
            name="mk[{{ $item->id }}][semester]"
            value="{{ $i }}"
            {{ (int)$item->semester === $i ? 'checked' : '' }}>
    </td>
    @endfor
</tr>
@endforeach
</tbody>

</table>

</form>
@endsection

@push('scripts')
<script>
$(function(){
    let table = $('#mkTable').DataTable({
        paging:false,
        info:false,
        dom:'rt'
    });

    $('#search').keyup(function(){
        table.search(this.value).draw();
    });
});
</script>
@endpush
