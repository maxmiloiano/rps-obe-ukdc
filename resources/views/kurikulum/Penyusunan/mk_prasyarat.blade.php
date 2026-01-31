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
        <a class="nav-link" href="{{ route('kurikulum.penyusunan.index') }}">
            Penyusunan MK
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active">MK Prasyarat</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.mk_dosen.index') }}">
            Dosen Pengampu MK
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kurikulum.indikator_mk.index') }}">Indikator MK</a></li>
</ul>

<div class="d-flex justify-content-end mb-3">
    <input type="text"
           id="search"
           class="form-control w-25"
           placeholder="Search">
</div>

@foreach($data as $semester => $items)

<table class="table table-bordered mt-4">

    <thead>
        <tr class="table-secondary">
            <th colspan="5"><strong>Semester {{ $semester }}</strong></th>
            <th class="text-center">
                <button class="btn btn-sm btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#modalPrasyarat{{ $semester }}">
                    <i class="bi bi-plus"></i>
                </button>
            </th>
        </tr>

        <tr class="text-center">
            <th>Mata Kuliah (MK)</th>
            <th>SKS</th>
            <th>Kategori</th>
            <th>MK Prasyarat</th>
            <th>Semester</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    @foreach($items as $item)
        <tr>
            <td>
                <strong>{{ $item->mataKuliah->kode_mk }}</strong><br>
                {{ $item->mataKuliah->nama_mk }}
            </td>

            <td class="text-center">{{ $item->SKS }}</td>
            <td class="text-center">{{ $item->Kategori }}</td>

            {{-- MK PRASYARAT --}}
            <td>
                @forelse($item->mataKuliah->prasyarat as $p)
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-dark">
                                {{ $p->prasyarat->kode_mk }} - {{ $p->prasyarat->nama_mk }}
                            </span>
                @empty
                -
                @endforelse
            </td>

            {{-- SEMESTER PRASYARAT --}}
            <td class="text-center">
                @forelse($item->mataKuliah->prasyarat as $p)
                {{ $p->prasyarat->penyusunan->semester ?? '-' }}
                @empty
                -
                @endforelse
            </td>

            {{-- ACTION --}}
            <td class="text-center">
                @foreach($item->mataKuliah->prasyarat as $p)
                    <button class="btn btn-sm btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#hapusPrasyarat{{ $p->id }}">
                        <i class="bi bi-trash"></i>
                    </button>

                    {{-- MODAL KONFIRMASI --}}
                    <div class="modal fade" id="hapusPrasyarat{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST"
                                  action="{{ route('kurikulum.mk_prasyarat.destroy', $p->id) }}">
                              @csrf
                              @method('DELETE')

                              <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Konfirmasi Penghapusan Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus
                                    <strong>{{ $p->prasyarat->nama_mk }}</strong>
                                    sebagai prasyarat mata kuliah
                                    <strong>{{ $item->mataKuliah->nama_mk }}</strong>?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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



{{-- MODAL PER SEMESTER --}}
<div class="modal fade" id="modalPrasyarat{{ $semester }}" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('kurikulum.mk_prasyarat.store') }}">
      @csrf
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Tambah Mata Kuliah Prasyarat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          {{-- MK SEMESTER INI --}}
          <div class="mb-3">
            <label>Mata Kuliah</label>
            <select name="mk_id" class="form-control" required>
              @foreach($items as $mk)
                <option value="{{ $mk->mk_id }}">
                    {{ $mk->mataKuliah->kode_mk }} - {{ $mk->mataKuliah->nama_mk }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- SEMUA MK SEBAGAI PRASYARAT --}}
          <div class="mb-3">
            <label>Prasyarat</label>
            <select name="prasyarat_id" class="form-control" required>
              @foreach($allMk as $mk)
                <option value="{{ $mk->mk_id }}">
                    {{ $mk->mataKuliah->kode_mk }} - {{ $mk->mataKuliah->nama_mk }}
                </option>
              @endforeach
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancel
        </button>

        </div>

      </div>
    </form>
  </div>
</div>

@endforeach
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('search');
    // ✅ JAGA-JAGA kalau elemen belum ada
    if (!searchInput) return;

    searchInput.addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();

        // 🔍 semua baris di SEMUA tabel semester
        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();

            if (text.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

});
</script>


