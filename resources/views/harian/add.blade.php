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
                                <li class="breadcrumb-item"><a href="#!">Create Data</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Data Tugas Harian | {{ $server->nameServer }} | {{ $server->ketServer }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <strong>Semua Form Wajib diisi!!</strong> ketika melakukan pencatatan pertama.
                                </div>
                                <form method="POST" action="{{ route('harian.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $server->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="koneksi">Cek Koneksi </label>
                                                <i class="feather icon-info" data-toggle="tooltip" data-html="true"
                                                    title="Cara Mengecek Koneksi dengan melakukan ping pada alamat IP aplikasi"></i>
                                                <select class="form-control" id="koneksi" name="koneksi">
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Non Aktif">Non Aktif</option>
                                                </select>
                                                @error('koneksi')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="service">Cek Web Service</label>
                                                <i class="feather icon-info" data-toggle="tooltip" data-html="true"
                                                    title="Cara mengecek koneksi web service adalah <br>
                                                    1. Apache = service apache2 status <br>
                                                    2. Nginx = service nginx status
                                                    "></i>
                                                <select class="form-control" id="service" name="service">
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Non Aktif">Non Aktif</option>
                                                </select>
                                                @error('service')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="tampilan">Cek Tampilan</label>
                                                <i class="feather icon-info" data-toggle="tooltip" data-html="true"
                                                    title="Cara Mengecek tampilan dengan membuka aplikasi terkait, apakah aplikasi itu berjalan dengan semestinya"></i>
                                                <select class="form-control" id="tampilan" name="tampilan">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Tidak Normal">TIdak Normal</option>
                                                </select>
                                                @error('tampilan')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="ram">Cek Free Memory Ram
                                                    <span><code>(*)</code></span></label>
                                                <i class="feather icon-info" data-toggle="tooltip" data-html="true"
                                                    title="Cara mengecek free Memory Ram adalah dengan mengetik 'free' pada cli di server"></i>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" id="ram"
                                                            placeholder="Cek Free Ram.." name="ram"
                                                            value="{{ old('ram') }}" required>
                                                    </div> GB
                                                </div>
                                                @error('ram')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="hardisk">Cek Free Space Hardisk
                                                    <span><code>(*)</code></span>
                                                    <i class="feather icon-info" data-toggle="tooltip" data-html="true"
                                                        title="Cara mengecek free hardisk adalah dengan mengetik 'df -h' pada cli di server"></i>
                                                </label>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" id="hardisk"
                                                            placeholder="Cek free Hardisk.." name="hardisk"
                                                            value="{{ old('hardisk') }}" required>
                                                    </div> GB
                                                </div>
                                                @error('hardisk')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if ($server->nameServer != 'ERP')
                                            <div class="col-md-6">
                                                <div class="form-group fill">
                                                    <label class="form-label" for="pengunjung">Cek Pengunjung</label>
                                                    <i class="feather icon-info" data-toggle="tooltip" data-html="true"
                                                        title="Cara mengecek Pengunjung adalah dengan mengetik 'netstat -anp |grep tcp |grep ::ffff: |wc -l' pada cli di server"></i>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <input type="number" class="form-control" id="pengunjung"
                                                                placeholder="Cek Pengunjung.." name="pengunjung"
                                                                value="{{ old('pengunjung') }}" required>
                                                        </div> Orang
                                                    </div>
                                                    @error('pengunjung')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="pengunjung">Kondisi Backup Aplikasi</label>
                                                <select class="form-control" id="backup" name="backup">
                                                    @foreach ($dataBackup as $backup)
                                                        <option value="{{ $backup->id }}">{{ $backup->backup }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pengunjung')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group fill">
                                                <label class="form-label" for="service">Cek DB Service</label>
                                                <i class="feather icon-info" data-toggle="tooltip" data-html="true"
                                                    title="Cara mengecek service DB adalah dengan mengetik 'service mysql status' pada cli di server"></i>
                                                <select class="form-control" id="dbService" name="dbService">
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Non Aktif">Non Aktif</option>
                                                </select>
                                                @error('dbService')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <label for="image" class="form-label">Upload Gambar</label>
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
                            <a href="{{ route('harian.show', $server->id) }}" class="btn btn-primary">Kembali</a>
                            <button type="sumbit" class="btn btn-primary float-right mt-2">Tambah Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsTambahan')
    <script>
        $(document).ready(function() {
            $(".alert-dismissible").fadeIn().delay(5000).fadeOut();
        });
    </script>
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
