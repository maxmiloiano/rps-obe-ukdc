@extends('layouts.app')

@section('content')

<!-- BREADCRUMB -->
<nav class="breadcrumb mb-3">
    <span>Pengaturan</span> / <strong>Data Master</strong>
</nav>

<h5 class="mb-3">Data Master</h5>

<!-- TABS -->
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link {{ $tab=='fakultas' ? 'active' : '' }}"
           href="{{ route('data-master.index',['tab'=>'fakultas']) }}">
            Fakultas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $tab=='prodi' ? 'active' : '' }}"
           href="{{ route('data-master.index',['tab'=>'prodi']) }}">
            Prodi
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $tab=='dosen' ? 'active' : '' }}"
           href="{{ route('data-master.index',['tab'=>'dosen']) }}">
            Dosen
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $tab=='kaprodi'?'active':'' }}"
           href="{{ route('data-master.index',['tab'=>'kaprodi']) }}">
            Kaprodi
        </a>
    </li>
</ul>
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
<div class="card-body">

{{-- ================================================= --}}
{{-- =================== FAKULTAS ==================== --}}
{{-- ================================================= --}}
@if($tab=='fakultas')

<button class="btn btn-success mb-3"
        data-bs-toggle="modal"
        data-bs-target="#addFakultas">
    + Add Fakultas
</button>

<table id="fakultasTable" class="table table-bordered table-striped">
<thead>
<tr>
    <th>No</th>
    <th>Kode Fakultas</th>
    <th>Nama Fakultas</th>
    <th width="160">Action</th>
</tr>
</thead>
<tbody>
@foreach($fakultas as $f)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $f->kode_fakultas }}</td>
    <td>{{ $f->nama_fakultas }}</td>
    <td>
        <a href="{{ route('fakultas.edit',$f->id) }}"
           class="btn btn-warning btn-sm">
            Edit
        </a>

        <form action="{{ route('fakultas.destroy',$f->id) }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('Hapus data ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">
                Hapus
            </button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>

@endif

{{-- ================================================= --}}
{{-- ===================== PRODI ===================== --}}
{{-- ================================================= --}}
@if($tab=='prodi')

<button class="btn btn-success mb-3"
        data-bs-toggle="modal"
        data-bs-target="#addProdi">
    + Add Prodi
</button>

<table id="prodiTable" class="table table-bordered table-striped">
<thead>
<tr>
    <th>No</th>
    <th>Nama Prodi</th>
    <th>Fakultas</th>
    <th width="160">Action</th>
</tr>
</thead>
<tbody>
@foreach($prodi as $p)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $p->nama_prodi }}</td>
    <td>{{ $p->fakultas->nama_fakultas ?? '-' }}</td>
    <td>
        <a href="{{ route('prodi.edit',$p->id) }}"
           class="btn btn-warning btn-sm">
            Edit
        </a>

        <form action="{{ route('prodi.destroy',$p->id) }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('Hapus data ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">
                Hapus
            </button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>

@endif

</div>
</div>

{{-- ================================================= --}}
{{-- =============== MODAL ADD FAKULTAS ============== --}}
{{-- ================================================= --}}
<div class="modal fade" id="addFakultas" tabindex="-1">
<div class="modal-dialog">
<form method="POST"
      action="{{ route('fakultas.store') }}"
      class="modal-content">
@csrf
<div class="modal-header">
    <h5 class="modal-title">Tambah Fakultas</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="mb-2">
        <label>Kode Fakultas</label>
        <input name="kode_fakultas" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Nama Fakultas</label>
        <input name="nama_fakultas" class="form-control" required>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-primary">Simpan</button>
</div>
</form>
</div>
</div>

{{-- ================================================= --}}
{{-- ================= MODAL ADD PRODI ================ --}}
{{-- ================================================= --}}
<div class="modal fade" id="addProdi" tabindex="-1">
<div class="modal-dialog">
<form method="POST"
      action="{{ route('prodi.store') }}"
      class="modal-content">
@csrf
<div class="modal-header">
    <h5 class="modal-title">Tambah Prodi</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <div class="mb-2">
        <label>Nama Prodi</label>
        <input name="nama_prodi" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Fakultas</label>
        <select name="fakultas_id" class="form-select" required>
            <option value="">-- Pilih Fakultas --</option>
            @foreach($fakultas as $f)
                <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-primary">Simpan</button>
</div>
</form>
</div>
</div>

@if($tab=='dosen')

<button class="btn btn-success mb-3"
        data-bs-toggle="modal"
        data-bs-target="#addDosen">
    + Add Dosen
</button>

<table id="dosenTable" class="table table-bordered table-striped">
<thead>
<tr>
    <th>No</th>
    <th>NIP/NIK</th>
    <th>Nama Dosen</th>
    <th>NIDN</th>
    <th>Email</th>
    <th>Prodi</th>
    <th>Fakultas</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach($dosen as $d)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->nip_nik }}</td>
    <td>{{ $d->nama_dosen }}</td>
    <td>{{ $d->nidn }}</td>
    <td>{{ $d->email }}</td>
    <td>{{ $d->prodi->nama_prodi ?? '-' }}</td>
    <td>{{ $d->fakultas->nama_fakultas ?? '-' }}</td>
    <td>
        <a href="{{ route('dosen.edit', $d->id) }}"
        class="btn btn-warning btn-sm">
        Edit
        </a>

        <form action="{{ route('dosen.destroy',$d->id) }}"
              method="POST"
              onsubmit="return confirm('Hapus data dosen?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
{{-- ================================================= --}}
{{-- ================= MODAL ADD DOSEN ================ --}}
{{-- ================================================= --}}

@endif

<div class="modal fade" id="addDosen" tabindex="-1">
<div class="modal-dialog modal-lg">
<form method="POST"
      action="{{ route('dosen.store') }}"
      class="modal-content">
@csrf

<div class="modal-header">
    <h5 class="modal-title">Tambah Data Dosen</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-2">
        <label>NIP / NIK</label>
        <input name="nip_nik" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Nama Dosen</label>
        <input name="nama_dosen" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>NIDN</label>
        <input name="nidn" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Email (Pengguna)</label>
        <select name="email" class="form-select" required>
            <option value="">-- Pilih Email --</option>
            @foreach($users as $u)
                <option value="{{ $u->email }}">{{ $u->email }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-2">
        <label>Fakultas</label>
        <select name="fakultas_id" class="form-select" required>
            <option value="">-- Pilih Fakultas --</option>
            @foreach($fakultas as $f)
                <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-2">
        <label>Program Studi</label>
        <select name="prodi_id" class="form-select" required>
            <option value="">-- Pilih Prodi --</option>
            @foreach($prodi as $p)
                <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-primary">Simpan</button>
    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
</div>

</form>
</div>
</div>

{{-- ================================================= --}}
{{-- ================= MODAL KAPRODI ================ --}}
{{-- ================================================= --}}
@if($tab=='kaprodi')

<button class="btn btn-success mb-3"
        data-bs-toggle="modal"
        data-bs-target="#addKaprodi">
    + Add Kaprodi
</button>

<table id="kaprodiTable" class="table table-bordered table-striped">
<thead>
<tr>
    <th>No</th>
    <th>Fakultas</th>
    <th>Prodi</th>
    <th>Tahun</th>
    <th>Nama Kaprodi</th>
    <th>NIP</th>
    <th width="140">Action</th>
</tr>
</thead>
<tbody>
@foreach($kaprodi as $k)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $k->fakultas->nama_fakultas }}</td>
    <td>{{ $k->prodi->nama_prodi }}</td>
    <td>{{ $k->tahun }}</td>
    <td>{{ $k->nama_kaprodi }}</td>
    <td>{{ $k->nip }}</td>
    <td>
        <a href="{{ route('kaprodi.edit',$k->id) }}"
              class="btn btn-warning btn-sm">
                Edit
        </a>

        <form action="{{ route('kaprodi.destroy',$k->id) }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('Hapus data ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">
                Hapus
            </button>
        </form>
    </td>       
</tr>
@endforeach
</tbody>
</table>
@endif



<div class="modal fade" id="addKaprodi">
<div class="modal-dialog">
<form method="POST" action="{{ route('kaprodi.store') }}" class="modal-content">
@csrf

<div class="modal-header">
    <h5>Tambah Kaprodi</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <label>Prodi</label>
    <select name="prodi_id" class="form-select mb-2" required>
        @foreach($prodi as $p)
            <option value="{{ $p->id }}">
                {{ $p->nama_prodi }} - {{ $p->fakultas->nama_fakultas }}
            </option>
        @endforeach
    </select>

    <label>Tahun</label>
    <select name="tahun" class="form-select mb-2" required>
        @foreach($tahunList as $t)
            <option value="{{ $t }}">{{ $t }}</option>
        @endforeach
    </select>

    <label>Nama Ketua Prodi</label>
    <select name="nip" class="form-select" required>
        @foreach($dosen as $d)
            <option value="{{ $d->nip_nik }}">
                {{ $d->nama_dosen }} ({{ $d->nip_nik }})
            </option>
        @endforeach
    </select>
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        Batal
    </button>
</div>

</form>
</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
    $('#fakultasTable').DataTable({
        pageLength: 10
    });

    $('#prodiTable').DataTable({
        pageLength: 10
    });
});
</script>
@endpush
@push('scripts')
<script>
$(function () {
    $('#dosenTable').DataTable({
        pageLength: 10
    });
});
</script>
@endpush

@push('scripts')
<script>
$(function () {
    $('#kaprodiTable').DataTable({
        pageLength: 10,
        lengthMenu: [5,10,25,50],
        language: {
            lengthMenu: "Show _MENU_ entries",
            search: "Search:",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                previous: "Previous",
                next: "Next"
            }
        }
    });
});
</script>
@endpush