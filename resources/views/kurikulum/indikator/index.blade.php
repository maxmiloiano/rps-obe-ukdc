@extends('layouts.app')

@section('content')

{{-- BREADCRUMB --}}
<nav class="breadcrumb mb-3">
    <span><i class="bi bi-journal-text me-1"></i> Kurikulum</span>
    <span class="mx-2">›</span>
    <strong>Data</strong>
</nav>

{{-- INFO --}}
<div class="alert alert-info mb-4">
    Saat ini anda sedang mengelola kurikulum OBE
    <strong>{{ $kurikulum->prodi->nama_prodi }}</strong>,
    {{ $kurikulum->prodi->fakultas->nama_fakultas }},
    Tahun {{ $kurikulum->tahun }}
</div>

{{-- TABS --}}
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.pl.index') }}">Profil Lulusan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.cpl.index') }}">CPL Prodi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active">Indikator CPL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.bk.index') }}">Bahan Kajian (BK)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.mk.index') }}">Mata Kuliah (MK)</a>
    </li>
</ul>
{{-- TOOLBAR --}}
<div class="row align-items-center mb-3">

    {{-- SHOW --}}
    <div class="col-md-3">
        <label class="d-flex align-items-center gap-2 mb-0">
            Show
            <select id="indikatorLength" class="form-select form-select-sm w-auto">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50" selected>50</option>
            </select>
            entries
        </label>
    </div>

    {{-- IMPORT --}}
    <div class="col-md-6 text-center">
        <button class="btn btn-info">
            <i class="bi bi-upload"></i> Import
        </button>
    </div>

    {{-- SEARCH --}}
    <div class="col-md-3 text-end">
        <label class="d-flex justify-content-end align-items-center gap-2 mb-0">
            Search:
            <input type="search"
                   id="indikatorSearch"
                   class="form-control form-control-sm w-75">
        </label>
    </div>

</div>


{{-- TABLE --}}
<table class="table table-bordered">
<thead>
<tr>
    <th width="35%">CPL</th>
    <th>Indikator</th>
    <th width="120">Bobot (%)</th>
    <th width="120">Action</th>
</tr>
</thead>

<tbody>
@foreach($cpl as $item)

@php
    $totalBobot = $item->indikator->sum('bobot');
    $indikatorCount = $item->indikator->count();
@endphp

@if($indikatorCount > 0)
<tr>
    <td rowspan="{{ $indikatorCount + 1 }}" class="table-secondary align-top">
        <strong>{{ $item->kode_cpl }}</strong> – {{ $item->deskripsi }} <br>

        <span class="badge bg-success mt-2">
            Total Bobot: {{ $totalBobot }}%
        </span><br>

        <button class="btn btn-success btn-sm mt-2"
            data-bs-toggle="modal"
            data-bs-target="#addIndikator{{ $item->id }}"
            {{ $totalBobot >= 100 ? 'disabled' : '' }}>
            <i class="bi bi-plus"></i>
        </button>
    </td>
</tr>

@foreach($item->indikator as $indikator)
<tr>
    <td>
        <strong>{{ $indikator->kode_indikator }}</strong><br>
        {{ $indikator->deskripsi }}
    </td>
    <td class="text-center">{{ $indikator->bobot }}</td>
    <td class="text-center">

        {{-- EDIT --}}
        <button class="btn btn-warning btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#editIndikator{{ $indikator->id }}">
            <i class="bi bi-pencil"></i>
        </button>

        {{-- DELETE --}}
        <button class="btn btn-danger btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#deleteIndikator{{ $indikator->id }}">
            <i class="bi bi-trash"></i>
        </button>

    </td>
</tr>
@endforeach

@else
<tr>
    <td class="table-secondary">
        <strong>{{ $item->kode_cpl }}</strong> – {{ $item->deskripsi }} <br>
        <span class="badge bg-success mt-2">Total Bobot: 0%</span><br>

        <button class="btn btn-success btn-sm mt-2"
            data-bs-toggle="modal"
            data-bs-target="#addIndikator{{ $item->id }}">
            <i class="bi bi-plus"></i>
        </button>
    </td>
    <td colspan="3" class="fst-italic text-muted">Belum ada indikator</td>
</tr>
@endif

@endforeach
</tbody>
</table>

{{-- ================= MODAL ADD ================= --}}
@foreach($cpl as $item)
<div class="modal fade" id="addIndikator{{ $item->id }}" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<form method="POST" action="{{ route('kurikulum.indikator.store') }}" class="modal-content">
@csrf
<input type="hidden" name="cpl_id" value="{{ $item->id }}">

<div class="modal-header">
    <h5 class="modal-title">Tambah Data Indikator</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-3">
        <label class="form-label">CPL</label>
        <input class="form-control" readonly
               value="{{ $item->kode_cpl }} - {{ $item->deskripsi }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Kode Indikator CPL</label>
        <input name="kode_indikator" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Bobot (%)</label>
        <input type="number" name="bobot" class="form-control" min="1" max="100" required>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-primary">Simpan</button>
    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
</div>
</form>
</div>
</div>
@endforeach

{{-- ================= MODAL EDIT ================= --}}
@foreach($cpl as $item)
@foreach($item->indikator as $indikator)
<div class="modal fade" id="editIndikator{{ $indikator->id }}" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<form method="POST"
      action="{{ route('kurikulum.indikator.update',$indikator->id) }}"
      class="modal-content">
@csrf @method('PUT')

<div class="modal-header">
    <h5 class="modal-title">Edit Data Indikator</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-3">
        <label>Kode Indikator</label>
        <input name="kode_indikator" class="form-control"
               value="{{ $indikator->kode_indikator }}" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required>
{{ $indikator->deskripsi }}</textarea>
    </div>

    <div class="mb-3">
        <label>Bobot (%)</label>
        <input type="number" name="bobot" class="form-control"
               value="{{ $indikator->bobot }}" min="1" max="100" required>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-primary">Save</button>
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
</div>

</form>
</div>
</div>
@endforeach
@endforeach

{{-- ================= MODAL DELETE ================= --}}
@foreach($cpl as $item)
@foreach($item->indikator as $indikator)
<div class="modal fade" id="deleteIndikator{{ $indikator->id }}" tabindex="-1">
<div class="modal-dialog">
<form method="POST"
      action="{{ route('kurikulum.indikator.destroy',$indikator->id) }}"
      class="modal-content">
@csrf @method('DELETE')

<div class="modal-header bg-danger text-white">
    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
    {{-- ❌ CLOSE (X) → HARUS type="button" --}}
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    Apakah anda yakin ingin menghapus
    <strong>{{ $indikator->kode_indikator }}</strong>
    dari CPL <strong>{{ $item->kode_cpl }}</strong> ?
</div>

<div class="modal-footer">
    <button type="button"
    class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" 
    class="btn btn-danger">Hapus</button>
</div>

</form>
</div>
</div>
@endforeach
@endforeach

@endsection
@push('scripts')
<script>
$(document).ready(function () {

    let table = $('#indikatorTable').DataTable({
        pageLength: 50,
        lengthMenu: [10, 25, 50, 100],
        ordering: false,
        dom: 'rtip',
        language: {
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                previous: "Previous",
                next: "Next"
            }
        }
    });

    $('#indikatorLength').on('change', function () {
        table.page.len($(this).val()).draw();
    });

    $('#indikatorSearch').on('keyup', function () {
        table.search(this.value).draw();
    });

});
</script>
@endpush
