@extends('layouts.app')

@section('content')

{{-- BREADCRUMB --}}
<nav class="breadcrumb mb-3">
    <span>
        <i class="bi bi-journal-text me-1"></i> Kurikulum
    </span>
    <span class="mx-2">›</span>
    <strong>Pemetaan</strong>
</nav>

{{-- INFO --}}
<div class="alert alert-info mb-3">
    Saat ini anda sedang mengelola kurikulum OBE
    <strong>{{ $kurikulum->prodi->nama_prodi }}</strong>,
    {{ $kurikulum->prodi->fakultas->nama_fakultas }},
    Tahun {{ $kurikulum->tahun }}
</div>

{{-- TABS --}}
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link active">CPL & PL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.pemetaan.cpl_bk') }}">CPL & BK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.pemetaan.bk_mk') }}">BK & MK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link ">CPL & MK</a>
    </li>
</ul>

{{-- TOOLBAR --}}
<div class="row mb-3">
    <div class="col-md-6">
        Show
        <select id="mapLength" class="form-select form-select-sm w-auto d-inline">
            <option>10</option>
            <option>25</option>
            <option selected>50</option>
        </select>
        entries
    </div>
    <div class="col-md-6 text-end">
        Search:
        <input type="search" id="mapSearch" class="form-control form-control-sm w-25 d-inline">
    </div>
</div>

{{-- TABLE --}}
<table id="mapTable" class="table table-bordered text-center">
    <thead>
        <tr>
            <th>No</th>
            <th width="35%">CPL</th>
            @foreach($pl as $p)
                <th>{{ $p->kode_pl }}</th>
            @endforeach
            <th>Jumlah PL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cpl as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-start">
                <strong>{{ $item->kode_cpl }}</strong><br>
                {{ $item->deskripsi }}
            </td>

            @foreach($pl as $p)
            <td>
                <input type="checkbox"
                    class="pl-check"
                    data-cpl="{{ $item->id }}"
                    data-pl="{{ $p->id }}"
                    {{ $item->pls->contains($p->id) ? 'checked' : '' }}>
            </td>
            @endforeach

            <td>
                <span class="badge bg-primary">
                    {{ $item->pls->count() }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('scripts')
<script>
$(function(){

    let table = $('#mapTable').DataTable({
        pageLength: 50,
        dom: 'rtip'
    });

    $('#mapLength').change(function(){
        table.page.len(this.value).draw();
    });

    $('#mapSearch').keyup(function(){
        table.search(this.value).draw();
    });

    $('.pl-check').change(function(){

        let checkbox = $(this);
        let cpl = checkbox.data('cpl');
        let pl  = checkbox.data('pl');

        let badge = checkbox.closest('tr').find('.badge');
        let count = parseInt(badge.text());

        let url = checkbox.is(':checked')
            ? "{{ route('kurikulum.pemetaan.cplpl.store') }}"
            : "{{ route('kurikulum.pemetaan.cplpl.delete') }}";

        $.post(url, {
            _token: "{{ csrf_token() }}",
            cpl_id: cpl,
            pl_id: pl
        })
        .done(function(res){

            if (res.status === 'saved') {
                badge.text(count + 1);
                showToast(res.message, 'success');
            }

            if (res.status === 'deleted') {
                badge.text(count - 1);
                showToast(res.message, 'warning');
            }

        })
        .fail(function(){
            alert('Terjadi kesalahan!');
            checkbox.prop('checked', !checkbox.is(':checked'));
        });

    });

});

/* Toast sederhana */
function showToast(message, type){
    let color = type === 'success' ? 'bg-success' : 'bg-warning';

    let toast = $(`
        <div class="toast align-items-center text-white ${color} border-0 position-fixed top-0 end-0 m-3" role="alert">
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `);

    $('body').append(toast);
    let bsToast = new bootstrap.Toast(toast[0]);
    bsToast.show();

    setTimeout(() => toast.remove(), 3000);
}
</script>
@endpush

