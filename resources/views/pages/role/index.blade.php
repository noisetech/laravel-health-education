@extends('layouts.be')

@section('title', 'Level Pengguna')

@section('content')
<div class="main-content">
    <section class="section">

        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ session('status') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card shadow">
            <div class="card-header">
                <a href="{{ route('role.tambah') }}" class="badge bg-primary text-white">
                    Tambah Level Pengguna
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col" style="width: 15%">Level Pengguna</th>
                                <th scope="col">Hak Akses</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $no => $role)
                            <tr>
                                <th scope="row" style="text-align: center">{{ ++$no + ($roles->currentPage()-1) * $roles->perPage() }}</th>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach($role->getPermissionNames() as $permission)
                                    <span class="badge bg-primary text-white mb-1 mt-1 mr-1">{{ $permission }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">

                                    @if ($role->name == 'admin' || $role->name == 'ADMIN' || $role->name == 'super admin' || $role->name == 'Super admin' || $role->name == 'SUPER ADMIN')
                                    -
                                    @else
                                    <a href="{{ route('role.edit', $role->id) }}" class="badge bg-warning text-white">
                                        Edit
                                    </a>

                                    <a href="{{ route('role.hapus', $role->id) }}" class="badge bg-danger text-white">
                                        Hapus
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


@push('style')
<style>
    .table-bordered {
        border: 2px solid #dee2e6 !important;
    }

    .table-bordered th,
    .table-bordered td {
        border: 2px solid #dee2e6 !important;
    }

    .alert-success {
        background-color: #497D74 !important;
    }
</style>
@endpush
