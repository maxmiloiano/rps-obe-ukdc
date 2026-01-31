@extends('layouts.app')

@section('content')

<nav class="breadcrumb mb-3">
    <span><i class="bi bi-journal-text me-1"></i> Kurikulum</span>
    <span class="mx-2">›</span>
    <strong>Penyusunan</strong>
</nav>

<div class="alert alert-info mb-4">
    Saat ini anda sedang mengelola kurikulum OBE
    <strong>{{ $kurikulum->prodi->nama_prodi }}</strong>,
    {{ $kurikulum->prodi->fakultas->nama_fakultas }},
    Tahun {{ $kurikulum->tahun }}
</div>

<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.penyusunan.index') }}">Penyusunan MK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.mk_prasyarat.index') }}">MK Prasyarat</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.mk_dosen.index') }}">Dosen Pengampu MK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active">Indikator MK</a>
    </li>
</ul>

{{-- TOOLBAR --}}
<div class="row mb-3">
    <div class="col-md-6">
        Show
        <select id="showEntries" class="form-select form-select-sm d-inline w-auto">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50" selected>50</option>
        </select>
        entries
    </div>

    <div class="col-md-6 text-end">
        <input type="text" id="searchIndikatorMk"
               class="form-control form-control-sm w-50 d-inline"
               placeholder="Search">
    </div>
</div>

<table class="table table-bordered">
<thead class="text-center">
<tr>
    <th width="25%">CPL</th>
    <th width="30%">Indikator CPL</th>
    <th>Mata Kuliah</th>
    <th width="120">Action</th>
</tr>
</thead>

<tbody id="indikatorTable">
@foreach($cpl as $cplItem)

@php $indikatorCount = $cplItem->indikator->count(); @endphp

@if($indikatorCount > 0)
<tr>
    <td rowspan="{{ $indikatorCount + 1 }}" class="table-secondary align-top">
        <strong>{{ $cplItem->kode_cpl }}</strong><br>
        {{ $cplItem->deskripsi }}
        <span class="badge bg-success d-block mt-2">
            Total Bobot: {{ $cplItem->indikator->sum('bobot') }}%
        </span>
    </td>
</tr>

@foreach($cplItem->indikator as $indikator)
<tr class="indikator-row">
    <td>
        <strong>{{ $indikator->kode_indikator }}</strong><br>
        {{ $indikator->deskripsi }}
        <span class="badge bg-info">Bobot {{ $indikator->bobot }}%</span>

        <button class="btn btn-success btn-sm mt-2"
            data-bs-toggle="modal"
            data-bs-target="#addMk{{ $indikator->id }}">
            <i class="bi bi-plus"></i>
        </button>
    </td>

    <td>
        @forelse($indikator->indikatorMk as $imk)
            {{ $imk->mataKuliah->kode_mk }} - {{ $imk->mataKuliah->nama_mk }}<br>
        @empty
            <em class="text-muted">Belum ada MK</em>
        @endforelse
    </td>

    <td class="text-center">
    <div class="d-flex flex-column gap-1 align-items-center">
        @foreach($indikator->indikatorMk as $imk)
            <button class="btn btn-danger btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#hapusMk{{ $imk->id }}">
                <i class="bi bi-trash"></i>
            </button>

        {{-- MODAL HAPUS --}}
        <div class="modal fade" id="hapusMk{{ $imk->id }}">
        <div class="modal-dialog">
        <form method="POST"
              action="{{ route('kurikulum.indikator_mk.destroy',$imk->id) }}">
            @csrf @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus
                    <strong>{{ $imk->mataKuliah->kode_mk }} - {{ $imk->mataKuliah->nama_mk }}</strong>
                    dari Indikator CPL
                    <strong>{{ $indikator->kode_indikator }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
        </div>
        </div>
        @endforeach
    </td>
</tr>

{{-- MODAL ADD MK --}}
<div class="modal fade" id="addMk{{ $indikator->id }}">
<div class="modal-dialog">
<form method="POST" action="{{ route('kurikulum.indikator_mk.store') }}">
@csrf
<input type="hidden" name="indikator_cpl_id" value="{{ $indikator->id }}">

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Pemenuhan Mata Kuliah</h5>
        <button type="button" class="btn-close"
            data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <label>Indikator CPL</label>
        <input class="form-control mb-2" readonly
            value="{{ $indikator->kode_indikator }} - {{ $indikator->deskripsi }}">

        <label>Mata Kuliah</label>
        <select name="mk_id" class="form-control">
            @foreach($allMk as $mk)
            <option value="{{ $mk->id }}">
                {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="modal-footer">
        <button class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Cancel</button>
    </div>
</div>
</form>
</div>
</div>

@endforeach
@endif
@endforeach
</tbody>
</table>

@endsection
@push('scripts')
<script>
$(document).ready(function () {

    let table = $('#indikatorMkTable').DataTable({
        pageLength: 50,
        lengthMenu: [10, 25, 50, 100],
        ordering: false,
        dom: 'lrtip', // length, processing, table, info, pagination
        language: {
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                previous: "Previous",
                next: "Next"
            }
        }
    });

    // custom search input
    $('#searchIndikatorMk').on('keyup', function () {
        table.search(this.value).draw();
    });

    // custom show entries
    $('#showEntries').on('change', function () {
        table.page.len(this.value).draw();
    });

});
</script>
@endpush
