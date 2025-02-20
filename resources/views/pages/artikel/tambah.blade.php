@extends('layouts.be')

@section('title', 'Artikel')

@section('content')
<div class="main-content">
    <section class="section">


        <a href="{{ route('artikel') }}" class="btn btn-sm btn-primary mt-5 mb-2">
            Kembali
        </a>

        <div class="card shadow">

            <div class="card-body">
                <form action="" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Kategori Artikel:</label>
                                <select name="kategori_artikel" class="form-control" id="">
                                    @foreach ($kategori_artikel as $k )
                                    <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tag Artikel:</label>
                                <select name="kategori_artikel" class="form-control" id="">
                                    @foreach ($tag_artikel as $t )
                                    <option value="{{ $t->id }}">{{ $t->tag }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Thumbnail:</label>
                        <input type="file" name="thumbnail" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>KONTEN</label>
                        <textarea class="form-control content @error('content') is-invalid @enderror" name="content" placeholder="Masukkan Konten / Isi Berita" rows="10">{!! old('content') !!}</textarea>
                        @error('content')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
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

    .alert-success {
        background-color: #497D74 !important;
    }
</style>
@endpush

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<script>
    var editor_config = {
        selector: "textarea.content",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern imagetools"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_picker_types: 'image',
        images_upload_url: '{{ route("artikel.upload") }}',
        images_upload_handler: function(blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("artikel.upload") }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
        height: 400
    };

    tinymce.init(editor_config);
</script>
@endpush
