@extends('layouts.app')

@section('content')

{{-- BREADCRUMB --}}
<nav class="breadcrumb mb-3">
    <span>
        <i class="bi bi-journal-text me-1"></i> Kurikulum
    </span>
    <span class="mx-2">›</span>
    <strong>Data</strong>
</nav>


{{-- INFO KURIKULUM --}}
<div class="alert alert-info mb-4">
    Saat ini anda sedang mengelola kurikulum OBE
    <strong>{{ $kurikulum->prodi->nama_prodi }}</strong>,
    {{ $kurikulum->prodi->fakultas->nama_fakultas }},
    Tahun {{ $kurikulum->tahun }}
</div>

{{-- TABS KURIKULUM --}}
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link active"
        href="{{ route('kurikulum.pl.index') }}">Profil Lulusan (PL)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
        href="{{ route('kurikulum.cpl.index') }}">CPL Prodi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.indikator.index') }}">Indikator CPL</a>
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
            <select id="plLength" class="form-select form-select-sm w-auto">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50" selected>50</option>
            </select>
            entries
        </label>
    </div>

    {{-- BUTTON --}}
    <div class="col-md-6 text-center">
        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addPL">
            <i class="bi bi-plus-circle"></i> Add
        </button>

        <button class="btn btn-info"
            data-bs-toggle="modal"
            data-bs-target="#importPL">
            <i class="bi bi-upload"></i> Import
        </button>

    </div>

    {{-- SEARCH --}}
    <div class="col-md-3 text-end">
        <label class="d-flex justify-content-end align-items-center gap-2 mb-0">
            Search:
            <input type="search" id="plSearch"
                   class="form-control form-control-sm w-75">
        </label>
    </div>
</div>

{{-- TABLE --}}
<table id="plTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode PL</th>
            <th>Deskripsi</th>
            <th>Prodi</th>
            <th width="120">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pl as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->kode_pl }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td>
                {{ $kurikulum->prodi->nama_prodi }}
                - {{ $kurikulum->prodi->fakultas->nama_fakultas }}
            </td>
            <td class="text-center">
                <button class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editPL{{ $item->id }}">
                    <i class="bi bi-pencil"></i>
                </button>


                <button class="btn btn-danger btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#deletePL{{ $item->id }}">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- MODAL EDIT --}}
@foreach($pl as $item)
<div class="modal fade" id="editPL{{ $item->id }}" tabindex="-1">
<div class="modal-dialog">
<form method="POST"
      action="{{ route('kurikulum.pl.update', $item->id) }}"
      class="modal-content">
@csrf
@method('PUT')

<div class="modal-header">
    <h5 class="modal-title">Edit Profil Lulusan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-2">
        <label>Kode PL</label>
        <input name="kode_pl"
               value="{{ $item->kode_pl }}"
               class="form-control"
               required>
    </div>

    <div class="mb-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi"
                  class="form-control"
                  rows="4"
                  required>{{ $item->deskripsi }}</textarea>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-primary">Simpan Perubahan</button>
    <button type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
        Batal
    </button>
</div>

</form>
</div>
</div>
@endforeach


@foreach($pl as $item)
<div class="modal fade" id="deletePL{{ $item->id }}" tabindex="-1">
<div class="modal-dialog">
<form method="POST"
      action="{{ route('kurikulum.pl.destroy',$item->id) }}"
      class="modal-content">

@csrf
@method('DELETE')

{{-- HEADER --}}
<div class="modal-header bg-danger text-white">
    <h5 class="modal-title">Konfirmasi Penghapusan Data</h5>

    {{-- ❗ WAJIB type="button" --}}
    <button type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
</div>

{{-- BODY --}}
<div class="modal-body">
    Apakah anda yakin ingin menghapus
    <strong>{{ $item->deskripsi }}</strong> ?
</div>

{{-- FOOTER --}}
<div class="modal-footer">

    {{-- ❗ BATAL TIDAK BOLEH SUBMIT --}}
    <button type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
        Batal
    </button>

    {{-- ✅ HANYA INI YANG SUBMIT --}}
    <button type="submit"
            class="btn btn-danger">
        Hapus
    </button>

</div>

</form>
</div>
</div>
@endforeach



{{-- MODAL ADD --}}
<div class="modal fade" id="addPL">
<div class="modal-dialog">
<form method="POST" action="{{ route('kurikulum.pl.store') }}" class="modal-content">
@csrf

<div class="modal-header">
    <h5 class="modal-title">Tambah Profil Lulusan</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-2">
        <label>Kode PL</label>
        <input name="kode_pl" class="form-control" required>
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

{{-- MODAL IMPORT --}}
<div class="modal fade" id="importPL">
<div class="modal-dialog">
<form method="POST"
      action="{{ route('kurikulum.pl.import') }}"
      enctype="multipart/form-data"
      class="modal-content">
@csrf

<div class="modal-header">
    <h5 class="modal-title">Import Profil Lulusan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-3">
        <label class="form-label">Upload File (Excel)</label>
        <input type="file" name="file" class="form-control" required>
    </div>
</div>

<div class="modal-footer">
    <a href="{{ route('kurikulum.pl.template') }}"
       class="btn btn-success">
        Download Template
    </a>

    <button class="btn btn-primary">Upload</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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

    let table = $('#plTable').DataTable({
        pageLength: 50,
        lengthMenu: [10, 25, 50, 100],

        // ❗ HILANGKAN length & search bawaan
        dom: 'rtip',

        language: {
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                previous: "Previous",
                next: "Next"
            }
        }
    });

    // 🔽 CONNECT SHOW ENTRIES CUSTOM
    $('#plLength').on('change', function () {
        table.page.len($(this).val()).draw();
    });

    // 🔍 CONNECT SEARCH CUSTOM
    $('#plSearch').on('keyup', function () {
        table.search(this.value).draw();
    });

});
</script>
@endpush

