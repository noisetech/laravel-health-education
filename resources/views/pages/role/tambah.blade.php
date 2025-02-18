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

            <div class="card-body">
                <form action="{{ route('role.simpan') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="">Level Pengguna:</label>
                        <input type="text" name="level_pengguna" class="form-control @error('level_pengguna') is-invalid @enderror" placeholder="Masukan level pengguna">
                        @error('level_pengguna')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Hak Akses:</label>
                        <div class="checkbox-group @error('hak_akses') is-invalid @enderror">
                            @foreach ($permissions as $permission)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="hak_akses[]" value="{{ $permission->name }}" id="check-{{ $permission->id }}">
                                <label class="form-check-label" for="check-{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('hak_akses')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-sm btn-primary" type="submit">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
