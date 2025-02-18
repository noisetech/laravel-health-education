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

        <a href="{{ route('permissions') }}" class="btn btn-sm btn-primary mt-5 mb-2">
            Kembali
        </a>

        <div class="card shadow">

            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="">Nama:</label>
                            <input type="text" name="hak_akses" class="form-control" value="{{ $permission->name }}" placeholder="Masukan hak akses">
                        </div>

                        <button class="btn btn-sm btn-primary" type="submit">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
