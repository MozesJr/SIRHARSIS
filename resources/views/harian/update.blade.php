@extends('layouts.admin')
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tugas Harian</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('harian.index') }}">Tugas Harian</a></li>
                                <li class="breadcrumb-item"><a href="#!">Update Data</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  justify-content-center">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Image</h4>
                        </div>
                        <div class="card-body">
                            @if ($gambar != null)
                                @foreach ($gambar as $gbr)
                                    <img class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                        src="{{ asset('storage/' . $gbr->original_filename) }}" alt="Gambar">
                                @endforeach
                            @else
                                <center>
                                    <img class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                        src="{{ asset('assets/images/work.jpg') }}" alt="Gambar">
                                </center>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Data Tugas Harian</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                <form method="POST" action="{{ route('harian.update', $server->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="oldImage" value="{{ $server->gambar }}">
                                    <input type="hidden" name="image" value="{{ $server->gambar }}">
                                    <input type="hidden" name="id" value="{{ $server->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="koneksi">Cek
                                                    Koneksi</label>
                                                <select class="form-control" id="koneksi" name="koneksi">
                                                    <option value="Aktif">
                                                        Aktif
                                                    </option>
                                                    <option value="Non Aktif">
                                                        Non Aktif
                                                    </option>
                                                </select>
                                                @error('koneksi')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="service">Cek
                                                    Web
                                                    Service</label>
                                                <select class="form-control" id="service" name="service">
                                                    <option value="Aktif">
                                                        Aktif
                                                    </option>
                                                    <option value="Non Aktif">
                                                        Non Aktif
                                                    </option>
                                                </select>
                                                @error('service')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="tampilan">Cek
                                                    Tampilan</label>
                                                <select class="form-control" id="tampilan" name="tampilan">
                                                    <option value="Normal">
                                                        Normal
                                                    </option>
                                                    <option value="TIdak Normal">
                                                        TIdak Normal
                                                    </option>
                                                </select>
                                                @error('tampilan')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="ram">Cek
                                                    Free Ram</label>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="ram"
                                                            placeholder="Cek Free Ram.." name="ram"
                                                            value="{{ old('ram', $server->ram) }}" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        GB
                                                    </div>
                                                </div>
                                                @error('ram')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="hardisk">Cek
                                                    Used
                                                    Hardisk</label>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="hardisk"
                                                            placeholder="Cek Used Hardisk.." name="hardisk"
                                                            value="{{ old('hardisk', $server->hardisk) }}" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        %
                                                    </div>
                                                </div>
                                                @error('hardisk')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="pengunjung">Cek
                                                    Pengunjung</label>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="pengunjung"
                                                            placeholder="Cek Pengunjung.." name="pengunjung"
                                                            value="{{ old('pengunjung', $server->pengunjung) }}" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        Orang
                                                    </div>
                                                </div>
                                                @error('pengunjung')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <center>
                                                <label for="image" class="form-label">Upload
                                                    Gambar</label>
                                            </center>
                                            <div class="form-group fill" id="dynamic1">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <input class="form-control @error('image') is-invalid @enderror"
                                                            type="file" id="image" name="image[]">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" id="tambah1"
                                                            class="btn btn-success">Add</button>
                                                    </div>
                                                </div>
                                                @error('image')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('harian.show', $server->id_server) }}" class="btn btn-primary">Kembali</a>
                            <button type="sumbit" class="btn btn-primary float-right mt-2">Ubah Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsTambahan')
    {{-- Add Data --}}
    <script>
        $(document).ready(function() {
            var no = 1;
            var ni = 1;
            $('#tambah1').click(function() {
                no++;
                ni++;
                $('#dynamic1').append(
                    '<div class="row mt-2" id="row' + no +
                    '"><div class="col-md-10"><input class="form-control @error('image') is-invalid @enderror"type="file" id="image" name="image[]"></div><div class="col-md-2"><button type="button" id="' +
                    no +
                    '" class="btn btn-danger btn_remove">Hapus</button></div></div>'
                );
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
    </script>
@endsection
