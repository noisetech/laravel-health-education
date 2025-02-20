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
                                <th>No</th>
                                <th>Hak Akses</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $permissions as $p )
                            <tr>
                            <td>{{ ($permissions->currentPage() - 1) * $permissions->perPage() + $loop->iteration }}</td>
                                <td>{{ $p->name  }} </td>
                                <td>
                                    <a href="{{ route('permissions.edit', $p->id) }}" class="badge bg-warning text-white">Edit</a>
                                    <a href="{{ route('permissions.hapus', $p->id) }}" class="badge bg-danger text-white">Hapus</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">Data Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{  $permissions->links() }}
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
