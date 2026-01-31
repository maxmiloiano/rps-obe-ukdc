@extends('layouts.app')

@section('content')

{{-- BREADCRUMB --}}
<nav class="breadcrumb mb-3">
    <span><i class="bi bi-journal-text me-1"></i> Kurikulum</span>
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
        <a class="nav-link"
           href="{{ route('kurikulum.penyusunan.index') }}">
           Penyusunan MK
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"href="{{ route('kurikulum.mk_prasyarat.index') }}">
           MK Prasyarat
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active">Dosen Pengampu MK</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.indikator_mk.index') }}">Indikator MK</a></li>
</ul>

<div class="d-flex justify-content-end mb-3">
    <input type="text"
           id="searchMk"
           class="form-control w-25"
           placeholder="Search">
</div>

            @foreach($data as $semester => $items)

            <table class="table table-bordered mt-4">

                <thead>
                    <tr class="table-secondary">
                        <th colspan="2"><strong>Semester {{ $semester }}</strong></th>
                        <th class="text-center">
                            <button class="btn btn-sm btn-success"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDosen{{ $semester }}">
                                <i class="bi bi-plus"></i>
                            </button>
                        </th>
                    </tr>

                    <tr class="text-center">
                        <th>Mata Kuliah (MK)</th>
                        <th>Dosen Pengampu</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                        <tbody>
                            @foreach($items as $item)
                         <tr class="mk-row">
                        {{-- MATA KULIAH --}}
                        <td>
                            <strong class="mk-text">
                            {{ $item->mataKuliah->kode_mk }}
                            </strong><br>
                            <span class="mk-text">
                                {{ $item->mataKuliah->nama_mk }}
                            </span>
                        </td>

                        {{-- DOSEN PENGAMPU --}}
                        <td class="dosen-text">
                            @forelse($item->mataKuliah->mkDosen as $md)
                            {{ $md->dosen->nama_dosen }}<br>
                            @empty
                             -
                            @endforelse
                        </td>

                        {{-- ACTION --}}
                        <td class="text-center">
                            @foreach($item->mataKuliah->mkDosen as $md)
                            <button class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#hapusDosen{{ $md->id }}">
                                <i class="bi bi-trash"></i>
                            </button>

                        {{-- MODAL KONFIRMASI --}}
                        <div class="modal fade" id="hapusDosen{{ $md->id }}" tabindex="-1">
                            <div class="modal-dialog">
                            <form method="POST"
                          action="{{ route('kurikulum.mk_dosen.destroy',$md->id) }}">
                        @csrf
                        @method('DELETE')

                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">
                                    Konfirmasi Penghapusan Data
                                </h5>
                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus
                                <strong>{{ $md->dosen->nama_dosen }}</strong>
                                sebagai dosen pengampu mata kuliah
                                <strong>{{ $item->mataKuliah->nama_mk }}</strong>?
                            </div>

                            <div class="modal-footer">
                                    <button type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                        <button class="btn btn-danger">Hapus</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

{{-- MODAL TAMBAH DOSEN --}}
<div class="modal fade" id="modalDosen{{ $semester }}">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('kurikulum.mk_dosen.store') }}">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dosen Pengampu Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Mata Kuliah</label>
                        <select name="mk_id" class="form-control" required>
                            @foreach($items as $mk)
                                <option value="{{ $mk->mk_id }}">
                                    {{ $mk->mataKuliah->kode_mk }} -
                                    {{ $mk->mataKuliah->nama_mk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Dosen Pengampu</label>
                        <select name="dosen_id" class="form-control" required>
                            @foreach($allDosen as $d)
                                <option value="{{ $d->id }}">
                                    {{ $d->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                    </div>
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
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchMk');

    searchInput.addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();

        document.querySelectorAll('.mk-row').forEach(row => {
            const mkText = row.querySelector('.mk-text')?.innerText.toLowerCase() || '';
            const dosenText = row.querySelector('.dosen-text')?.innerText.toLowerCase() || '';

            if (mkText.includes(keyword) || dosenText.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>