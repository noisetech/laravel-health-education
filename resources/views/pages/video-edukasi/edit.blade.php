@extends('layouts.be')

@section('title', 'Video Edukasi')

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

        <a href="{{ route('video_edukasi') }}" class="btn btn-sm btn-primary mt-5 mb-2">
            Kembali
        </a>

        <div class="card shadow">

            <div class="card-body">
                <form action="{{ route('video_edukasi.update', $video_edukasi->id) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="">Link Url</label>
                        <input type="text" value="{{ $video_edukasi->url }} " name="url" class="form-control @error('url') is-invalid @enderror" placeholder="Masukan link url">
                        @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Status:</label>
                        <select name="status" class="form-control  @error('status') is-invalid @enderror">
                            <option value="publish" @if ($video_edukasi->status == 'publish')
                                selected
                                @endif>Publish</option>
                            <option value="Non Publish" @if ($video_edukasi->status == 'Non Publish')
                                selected
                                @endif>Non Publish</option>
                        </select>
                        @error('status')
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
