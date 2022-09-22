@extends('layouts.admin')
@section('cssTambahan')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/trix.css') }}">
    <script type="text/javascript" src="{{ asset('assets/js/trix.js') }}"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Ubah Catatan Kerja</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('pencatatan.index') }}">Pencatatan</a></li>
                                <li class="breadcrumb-item"><a href="#!">Ubah</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Ubah Data Catatan {{ $pencatatan->judul }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{ route('pencatatan.update', $pencatatan->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="oldImage" value="{{ $pencatatan->gambar }}">
                                    <input type="hidden" name="image" value="{{ $pencatatan->gambar }}">
                                    <div class="form-group fill">
                                        <label class="form-label" for="judul">Judul Kegiatan</label>
                                        <input type="text" class="form-control" id="judul"
                                            placeholder="Judul Kegiatan" name="judul"
                                            value="{{ old('judul', $pencatatan->judul) }}" required>
                                        @error('judul')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group fill">
                                        <label class="form-label" for="tanggal">Tanggal Kegiatan</label>
                                        <input type="date" class="form-control" id="tanggal"
                                            placeholder="tanggal Kegiatan" name="tanggal"
                                            value="{{ old('tanggal', $pencatatan->tanggal) }}">
                                        @error('tanggal')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Upload Gambar</label>
                                            @if ($pencatatan->gambar)
                                                <img src="{{ asset('storage/' . $pencatatan->gambar) }}" alt=""
                                                    class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                            @else
                                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                            @endif
                                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                                id="image" name="image" onchange="previewImage()">
                                        </div>
                                        @error('image')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group fill">
                                        <label class="form-label" for="inputAddress2">Isi kegiatan</label>
                                        <input id="x" type="hidden" name="isi"
                                            value="{{ old('isi', $pencatatan->catatan) }}" required>
                                        <trix-editor input="x">
                                        </trix-editor>
                                        @error('isi')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn  btn-primary" style="float: right">Edit
                                        Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsTambahan')
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
