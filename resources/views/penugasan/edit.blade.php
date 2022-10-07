@extends('layouts.admin')
@section('cssTambahan')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/trix.css') }}">
    <script type="text/javascript" src="{{ asset('assets/js/trix.js') }}"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/plugins/select2.min.css">
@endsection
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Ubah Penugasan</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('penugasan.index') }}">Penugasan</a></li>
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
                            <h5>Ubah Data Penugasan</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{ route('penugasan.update', $penugasan->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="oldImage" value="{{ $penugasan->gambar }}">
                                    <input type="hidden" name="image" value="{{ $penugasan->gambar }}">

                                    <div class="form-group fill">
                                        <label class="form-label" for="judul">Judul Penugasan</label>
                                        <input type="text" class="form-control" id="judul"
                                            placeholder="Judul Kegiatan" name="judul"
                                            value="{{ old('judul', $penugasan->judul) }}" required>
                                        @error('judul')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="tanggal_awal">Pilih Tanggal</label>
                                            <input type="text" name="daterange" class="form-control"
                                                value="{{ $penugasan->daterange }}" />
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="level">Level Urgency</label>
                                                <select class="form-control" id="level" name="level">
                                                    <option value="{{ $penugasan->id_levels }}">
                                                        {{ $penugasan->Level->level }}</option>
                                                    @foreach ($level as $lvl)
                                                        <option value="{{ $lvl->id }}">{{ $lvl->level }}</option>
                                                    @endforeach
                                                </select>
                                                @error('level')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="{{ $penugasan->id_statuses }}">
                                                        {{ $penugasan->Status->status }}</option>
                                                    @foreach ($status as $sts)
                                                        <option value="{{ $sts->id }}">{{ $sts->status }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group fill">
                                        <label class="form-label" for="judul">Tujuan Penugasan</label>
                                        <select class="form-control js-example-basic-hide-search" multiple="multiple"
                                            name="tujuan[]">
                                            @foreach ($dataUser as $usr1)
                                                <option value="{{ $usr1->id_users1 }}" selected>{{ $usr1->name }}
                                                </option>
                                            @endforeach
                                            @foreach ($user as $usr)
                                                <optgroup label="{{ $usr->Job->job }}">
                                                    <option value="{{ $usr->id }}">{{ $usr->name }}</option>
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        @error('tujuan')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Upload Gambar</label>
                                            @if ($penugasan->gambar)
                                                <img src="{{ asset('storage/' . $penugasan->gambar) }}" alt=""
                                                    class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                            @else
                                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                            @endif
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                type="file" id="image" name="image" onchange="previewImage()">
                                        </div>
                                        @error('image')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group fill">
                                        <label class="form-label" for="isi">Catatan Penugasan</label>
                                        <input id="x" type="hidden" name="isi"
                                            value="{{ old('isi', $penugasan->penugasan) }}" required>
                                        <trix-editor input="x">
                                        </trix-editor>
                                        @error('isi')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn  btn-primary" style="float: right">Ubah
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
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- select2 Js -->
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/select2.full.min.js"></script>
    <!-- form-select-custom Js -->
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pages/form-select-custom.js"></script>
@endsection
