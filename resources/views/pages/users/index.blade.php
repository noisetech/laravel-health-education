@extends('layouts.be')

@section('title', 'Hak Akses')

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
                <a href="{{ route('permissions.tambah') }}" class="badge bg-primary text-white">
                    Tambah Hak Akses
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%; border: 1;">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level Pengguna</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                            <tr>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    @if(!empty($u->getRoleNames()))
                                    @foreach($u->getRoleNames() as $role)
                                    <label class="badge badge-primary">{{ $role }}</label>
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    @can('akses edit user')
                                    <a href="" class="badge bg-warning text-white">
                                        Edit
                                    </a>
                                    @endcan


                                    @can('akses user hapus')
                                    <a href="" class="badge bg-danger text-white">
                                        Hapus
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
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
