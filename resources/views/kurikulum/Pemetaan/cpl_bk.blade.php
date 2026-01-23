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
        <a class="nav-link" href="{{ route('kurikulum.pemetaan.cpl_pl') }}">CPL & PL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active">CPL & BK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.pemetaan.bk_mk') }}">BK & MK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.pemetaan.cpl_mk') }}">CPL & MK</a>
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
        <input type="search" id="mapSearch"
               class="form-control form-control-sm w-25 d-inline">
    </div>
</div>

{{-- TABLE --}}
<table id="mapTable" class="table table-bordered text-center">
    <thead>
        <tr>
            <th>No</th>
            <th>Bahan Kajian</th>
            @foreach($cpl as $c)
                <th>{{ $c->kode_cpl }}</th>
            @endforeach
            <th>Jumlah CPL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bk as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-start">
                <strong>{{ $item->kode_bahan_kajian }}</strong><br>
                {{ $item->nama_bahan_kajian }}
            </td>

            @foreach($cpl as $c)
            <td>
                <input type="checkbox"
                    class="cpl-check"
                    data-bk="{{ $item->id }}"
                    data-cpl="{{ $c->id }}"
                    {{ $item->cpls->contains($c->id) ? 'checked' : '' }}>
            </td>
            @endforeach

            <td>
                <span class="badge bg-primary">
                    {{ $item->cpls->count() }}
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

    $('.cpl-check').change(function(){

        let cb = $(this);
        let bk  = cb.data('bk');
        let cpl = cb.data('cpl');

        let badge = cb.closest('tr').find('.badge');
        let count = parseInt(badge.text());

        let url = cb.is(':checked')
            ? "{{ route('kurikulum.pemetaan.cplbk.store') }}"
            : "{{ route('kurikulum.pemetaan.cplbk.delete') }}";

        $.post(url,{
            _token: "{{ csrf_token() }}",
            bk_id: bk,
            cpl_id: cpl
        }).done(function(res){

            if(res.status === 'saved'){
                badge.text(count + 1);
                toast(res.message,'success');
            }

            if(res.status === 'deleted'){
                badge.text(count - 1);
                toast(res.message,'warning');
            }

        }).fail(function(){
            alert('Terjadi kesalahan');
            cb.prop('checked', !cb.is(':checked'));
        });

    });

});

function toast(msg,type){
    let color = type === 'success' ? 'bg-success' : 'bg-warning';

    let t = $(`
        <div class="toast text-white ${color} position-fixed top-0 end-0 m-3">
            <div class="toast-body">${msg}</div>
        </div>
    `);

    $('body').append(t);
    new bootstrap.Toast(t[0]).show();
    setTimeout(()=>t.remove(),3000);
}
</script>
@endpush
