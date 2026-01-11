@extends('layouts.app')

@section('content')

<!-- BREADCRUMB -->
<nav class="breadcrumb mb-3">
    <a href="{{ route('data-master.index',['tab'=>'dosen']) }}" class="text-decoration-none">
        Data Master
    </a>
    <span class="mx-1">/</span>
    <strong>Edit Dosen</strong>
</nav>

<h5 class="mb-4">Edit Data Dosen</h5>

<div class="card">
    <div class="card-body">

        <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- NIP / NIK -->
            <div class="mb-3">
                <label class="form-label">NIP / NIK</label>
                <input type="text"
                       name="nip_nik"
                       class="form-control"
                       value="{{ $dosen->nip_nik }}"
                       required>
            </div>

            <!-- Nama Dosen -->
            <div class="mb-3">
                <label class="form-label">Nama Dosen</label>
                <input type="text"
                       name="nama_dosen"
                       class="form-control"
                       value="{{ $dosen->nama_dosen }}"
                       required>
            </div>

            <!-- NIDN -->
            <div class="mb-3">
                <label class="form-label">NIDN</label>
                <input type="text"
                       name="nidn"
                       class="form-control"
                       value="{{ $dosen->nidn }}">
            </div>

            <!-- Email Pengguna -->
            <div class="mb-3">
                <label class="form-label">Email (Pengguna)</label>
                <select name="email" class="form-select" required>
                    <option value="">-- Pilih Email --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->email }}"
                            {{ $dosen->email == $u->email ? 'selected' : '' }}>
                            {{ $u->email }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fakultas -->
            <div class="mb-3">
                <label class="form-label">Fakultas</label>
                <select name="fakultas_id" class="form-select" required>
                    <option value="">-- Pilih Fakultas --</option>
                    @foreach($fakultas as $f)
                        <option value="{{ $f->id }}"
                            {{ $dosen->fakultas_id == $f->id ? 'selected' : '' }}>
                            {{ $f->nama_fakultas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Program Studi -->
            <div class="mb-4">
                <label class="form-label">Program Studi</label>
                <select name="prodi_id" class="form-select" required>
                    <option value="">-- Pilih Program Studi --</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->id }}"
                            {{ $dosen->prodi_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- BUTTON -->
            <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-primary">
                    💾 Save
                </button>
                <a href="{{ route('data-master.index',['tab'=>'dosen']) }}"
                   class="btn btn-warning">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
