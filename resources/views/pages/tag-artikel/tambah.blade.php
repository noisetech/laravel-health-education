@extends('layouts.be')

@section('content')
<div class="main-content">
    <section class="section">
        <a href="{{ route('kategori-artikel') }}" class="btn btn-sm btn-primary mt-5 mb-2">
            Kembali
        </a>
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('tag-artikel.simpan') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="">Tag:</label>
                        <input type="text" name="tag" class="form-control @error('tag') is-invalid @enderror" placeholder="Masukan tag artikel">
                        @error('tag')
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
