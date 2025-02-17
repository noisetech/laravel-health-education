@extends('layouts.be')

@section('content')
<div class="main-content">
    <section class="section">
        <a href="{{ route('kategori-artikel') }}" class="btn btn-sm btn-primary mt-5 mb-2">
            Kembali
        </a>
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('kategori-artikel.update', $kategori_artikel->id) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="">Kategori:</label>
                        <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" placeholder="Masukan kategori artikel" value="{{ $kategori_artikel->kategori }}">
                        @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
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


@push('style')
<style>
    .table-bordered {
        border: 2px solid #dee2e6 !important;
    }

    .table-bordered th,
    .table-bordered td {
        border: 2px solid #dee2e6 !important;
    }
</style>
@endpush
