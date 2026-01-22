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
<div class="alert alert-info">
    Kurikulum OBE
    <strong>{{ $kurikulum->prodi->nama_prodi }}</strong>,
    {{ $kurikulum->prodi->fakultas->nama_fakultas }}
</div>

{{-- TABS --}}
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.pemetaan.cpl_pl') }}">CPL & PL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.pemetaan.cpl_bk') }}">CPL & BK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active">BK & MK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link">CPL & MK</a>
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
    <th>Mata Kuliah</th>
    @foreach($bk as $b)
        <th>{{ $b->kode_bahan_kajian }}</th>
    @endforeach
    <th>Jumlah BK</th>
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

    @foreach($bk as $b)
    <td>
        <input type="checkbox"
            class="bk-check"
            data-mk="{{ $item->id }}"
            data-bk="{{ $b->id }}"
            {{ $item->bahanKajian->contains($b->id) ? 'checked' : '' }}>
    </td>
    @endforeach

    <td>
        <span class="badge bg-primary">
            {{ $item->bahanKajian->count() }}
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

    $('.bk-check').change(function(){

        let cb = $(this);
        let mk = cb.data('mk');
        let bk = cb.data('bk');

        let badge = cb.closest('tr').find('.badge');
        let count = parseInt(badge.text());

        let url = cb.is(':checked')
            ? "{{ route('kurikulum.pemetaan.bkmk.store') }}"
            : "{{ route('kurikulum.pemetaan.bkmk.delete') }}";

        $.post(url,{
            _token: "{{ csrf_token() }}",
            mk_id: mk,
            bk_id: bk
        })
        .done(function(res){
            if(res.status === 'saved'){
                badge.text(count + 1);
                toast(res.message,'success');
            }
            if(res.status === 'deleted'){
                badge.text(count - 1);
                toast(res.message,'warning');
            }
        })
        .fail(function(){
            alert('Gagal menyimpan!');
            cb.prop('checked', !cb.is(':checked'));
        });

    });

});

function toast(msg,type){
    let color = type === 'success' ? 'bg-success' : 'bg-warning';
    let t = $(`
        <div class="toast ${color} text-white position-fixed top-0 end-0 m-3">
            <div class="toast-body">${msg}</div>
        </div>
    `);
    $('body').append(t);
    new bootstrap.Toast(t[0]).show();
    setTimeout(()=>t.remove(),3000);
}
</script>
@endpush
