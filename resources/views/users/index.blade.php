@extends('layouts.app')

@section('content')

<!-- BREADCRUMB -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="bi bi-gear"></i> Pengaturan
        </li>
        <li class="breadcrumb-item active">
            Pengguna
        </li>
    </ol>
</nav>

<!-- JUDUL -->
<h5 class="mb-3">Daftar Registrasi Pengguna</h5>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">

        <table id="usersTable" class="table table-bordered table-striped w-100">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Hak Akses</th>
                    <th>Status</th>
                    <th width="120">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nama_lengkap }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <span class="badge {{ $user->status == 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $user->status }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('users.edit', $user->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#usersTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            language: {
                lengthMenu: "Show _MENU_ entries",
                search: "Search:",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                },
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                zeroRecords: "No data available in table"
            }
        });
    });
</script>
@endpush
