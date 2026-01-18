@extends('layouts.app')

@section('content')

{{-- BREADCRUMB --}}
<nav class="breadcrumb mb-3">
    <span>
        <i class="bi bi-journal-text me-1"></i> Kurikulum
    </span>
    <span class="mx-2">›</span>
    <strong>Mata Kuliah</strong>
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
        <a class="nav-link" href="{{ route('kurikulum.indikator.index') }}">Indikator CPL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.bk.index') }}">Bahan Kajian (BK)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active">Mata Kuliah (MK)</a>
    </li>
</ul>

{{-- TOOLBAR --}}
<div class="row align-items-center mb-3">

    {{-- SHOW --}}
    <div class="col-md-3">
        <label class="d-flex align-items-center gap-2 mb-0">
            Show
            <select id="mkLength" class="form-select form-select-sm w-auto">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50" selected>50</option>
            </select>
            entries
        </label>
    </div>

    {{-- BUTTON --}}
    <div class="col-md-6 text-center">
        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addMK">
            <i class="bi bi-plus-circle"></i> Add
        </button>

        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importMK">
            <i class="bi bi-upload"></i> Import
        </button>
    </div>

    {{-- SEARCH --}}
    <div class="col-md-3 text-end">
        <label class="d-flex justify-content-end align-items-center gap-2 mb-0">
            Search:
            <input type="search" id="mkSearch" class="form-control form-control-sm w-75">
        </label>
    </div>
</div>

{{-- TABLE --}}
<table id="mkTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode MK</th>
            <th>Nama Mata Kuliah</th>
            <th>Deskripsi</th>
            <th width="120">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mk as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->kode_mk }}</td>
            <td>{{ $item->nama_mk }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td class="text-center">

                {{-- EDIT --}}
                <button class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editMK{{ $item->id }}">
                    <i class="bi bi-pencil"></i>
                </button>

                {{-- DELETE --}}
                <button class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteMK{{ $item->id }}">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- ================= MODAL ADD MK ================= --}}
<div class="modal fade" id="addMK">
<div class="modal-dialog">
<form method="POST" action="{{ route('kurikulum.mk.store') }}" class="modal-content">
@csrf

<div class="modal-header">
    <h5 class="modal-title">Tambah Mata Kuliah</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-2">
        <label>Kode Mata Kuliah</label>
        <input name="kode_mk" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Nama Mata Kuliah</label>
        <input name="nama_mk" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-primary">Simpan</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
</div>

</form>
</div>
</div>

{{-- ================= MODAL EDIT & DELETE ================= --}}
@foreach($mk as $item)

{{-- EDIT --}}
<div class="modal fade" id="editMK{{ $item->id }}">
<div class="modal-dialog">
<form method="POST" action="{{ route('kurikulum.mk.update',$item->id) }}" class="modal-content">
@csrf @method('PUT')

<div class="modal-header">
    <h5 class="modal-title">Edit Mata Kuliah</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-2">
        <label>Kode Mata Kuliah</label>
        <input name="kode_mk" value="{{ $item->kode_mk }}" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Nama Mata Kuliah</label>
        <input name="nama_mk" value="{{ $item->nama_mk }}" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4" required>{{ $item->deskripsi }}</textarea>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-primary">Simpan Perubahan</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
</div>

</form>
</div>
</div>

{{-- DELETE --}}
<div class="modal fade" id="deleteMK{{ $item->id }}">
<div class="modal-dialog">
<form method="POST" action="{{ route('kurikulum.mk.destroy',$item->id) }}" class="modal-content">
@csrf @method('DELETE')

<div class="modal-header bg-danger text-white">
    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    Apakah anda yakin ingin menghapus
    <strong>{{ $item->nama_mk }}</strong> ?
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button class="btn btn-danger">Hapus</button>
</div>

</form>
</div>
</div>

@endforeach

{{-- ================= MODAL IMPORT ================= --}}
<div class="modal fade" id="importMK">
<div class="modal-dialog">
<form method="POST" action="{{ route('kurikulum.mk.import') }}"
      enctype="multipart/form-data"
      class="modal-content">
@csrf

<div class="modal-header">
    <h5 class="modal-title">Import Mata Kuliah</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <input type="file" name="file" class="form-control" required>
</div>

<div class="modal-footer">
    <a href="{{ route('kurikulum.mk.template') }}" class="btn btn-success">
        Download Template
    </a>
    <button class="btn btn-primary">Upload</button>
    <button type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
        Cancel
    </button>
</div>

</form>
</div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    let table = $('#mkTable').DataTable({
        pageLength: 50,
        lengthMenu: [10, 25, 50, 100],
        dom: 'rtip'
    });

    $('#mkLength').on('change', function () {
        table.page.len($(this).val()).draw();
    });

    $('#mkSearch').on('keyup', function () {
        table.search(this.value).draw();
    });

});
</script>
@endpush
