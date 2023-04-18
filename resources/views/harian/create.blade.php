@extends('layouts.admin')
@section('cssTambahan')
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/plugins/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
@endsection
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
                                <li class="breadcrumb-item"><a href="#!">{{ $server->nameServer }} |
                                        {{ $server->ketServer }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->id_role == 5)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 text-start">
                                <h4>Data Tugas Harian {{ $server->nameServer }} |
                                    {{ $server->ketServer }}</h4>
                            </div>
                            <div class="col-md-2 align-content-left">
                                <a href="{{ route('exportPdfHarian', $server->id) }}" class="btn btn-danger mr-2"
                                    target="_blank"><i class="fas fa-file-pdf"></i></a>
                                <a href="{{ route('exportHarianId', $server->id) }}" class="btn btn-success mr-2"
                                    target="_blank"><i class="fas fa-file-excel"></i></a>
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#tanggal">
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row justify-content-center">
                @if (Auth::user()->id_role == 5)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Grafik Free Memory Ram
                                </h5>
                            </div>
                            <div class="card-body">
                                <canvas id="getGrafik"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Grafik Free Space Hardisk
                                </h5>
                            </div>
                            <div class="card-body">
                                <canvas id="getGrafik1"></canvas>
                            </div>
                        </div>
                    </div>
                    @if ($server->nameServer != 'ERP')
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Grafik Statistik Pengunjung
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="getGrafik2"></canvas>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if (Auth::user()->id_role < 5)
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4>Pencatatan | {{ $server->nameServer }} | {{ $server->ketServer }}
                                        </h4>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('harian.add', $server->id) }}" class="btn btn-primary mr-2"
                                            style="float: right"><i class="feather icon-plus"></i>
                                            Tambah Data</a>
                                        <a href="{{ route('exportHarianId', $server->id) }}" class="btn btn-success mr-2"
                                            style="float: right" target="_blank"><i class="feather icon-printer"></i>
                                            Export</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="dt-responsive table-responsive">
                                    <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="table_id"
                                                    class="table table-striped table-bordered nowrap dataTable"
                                                    aria-describedby="simpletable_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                aria-controls="simpletable" rowspan="1" colspan="1"
                                                                aria-sort="ascending"
                                                                aria-label="#: activate to sort column descending">#</th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Pencatatan: activate to sort column ascending">
                                                                Pencatatan
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Waktu: activate to sort column ascending">
                                                                Waktu
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Tanggal: activate to sort column ascending">
                                                                Tanggal
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="simpletable" rowspan="1" colspan="1"
                                                                aria-label="Action: activate to sort column ascending">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dataHarian as $harian)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                @php
                                                                    $waktu = $harian->waktu;
                                                                    $awal = substr($waktu, -8, 2);
                                                                    if ($awal >= 00 && $awal <= 12) {
                                                                        echo '<td>Pencatatan ke - 1</td>';
                                                                    } elseif ($awal >= 12 && $awal <= 15) {
                                                                        echo '<td>Pencatatan ke - 2</td>';
                                                                    } elseif ($awal >= 15 && $awal <= 24) {
                                                                        echo '<td>Pencatatan ke - 3</td>';
                                                                    } else {
                                                                        echo '<td>Belum Ada data</td>';
                                                                    }
                                                                @endphp
                                                                <td>{{ $harian->waktu }}</td>
                                                                <td>{{ $harian->tanggal }}</td>
                                                                <td>
                                                                    {{-- Hapus Data --}}
                                                                    <a onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?');"
                                                                        class="inline">
                                                                        <form
                                                                            action="{{ route('harian.destroy', $harian->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit" class="btn btn-danger"
                                                                                style="float: right">
                                                                                <i class="feather icon-delete"></i>
                                                                            </button>
                                                                        </form>
                                                                    </a>
                                                                    <a href="{{ route('harian.updateData', $harian->id) }}"
                                                                        class="btn btn-warning mr-2"
                                                                        style="float: right"><i
                                                                            class="feather icon-settings"></i></a>
                                                                    {{-- Ubah data --}}
                                                                    {{-- <button type="button" class="btn btn-warning mr-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#staticBackdrop{{ $harian->id }}"
                                                                        style="float: right">
                                                                        <i class="feather icon-settings"></i>
                                                                    </button> --}}
                                                                    <div class="modal fade"
                                                                        id="staticBackdrop{{ $harian->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">Ubah
                                                                                        {{ $title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <i class="feather icon-x"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="col-md-12">
                                                                                        <form method="POST"
                                                                                            action="{{ route('harian.update', $harian->id) }}"
                                                                                            enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <input type="hidden"
                                                                                                name="oldImage"
                                                                                                value="{{ $harian->gambar }}">
                                                                                            <input type="hidden"
                                                                                                name="image"
                                                                                                value="{{ $harian->gambar }}">
                                                                                            <input type="hidden"
                                                                                                name="id"
                                                                                                value="{{ $server->id }}">
                                                                                            <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                    <div
                                                                                                        class="form-group fill">
                                                                                                        <label
                                                                                                            class="form-label"
                                                                                                            for="koneksi">Cek
                                                                                                            Koneksi</label>
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            id="koneksi"
                                                                                                            name="koneksi">
                                                                                                            <option
                                                                                                                value="Aktif">
                                                                                                                Aktif
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="Non Aktif">
                                                                                                                Non Aktif
                                                                                                            </option>
                                                                                                        </select>
                                                                                                        @error('koneksi')
                                                                                                            <span
                                                                                                                id="category_id-error"
                                                                                                                class="error text-danger"
                                                                                                                for="input-id"
                                                                                                                style="display: block;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div
                                                                                                        class="form-group fill">
                                                                                                        <label
                                                                                                            class="form-label"
                                                                                                            for="service">Cek
                                                                                                            Web
                                                                                                            Service</label>
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            id="service"
                                                                                                            name="service">
                                                                                                            <option
                                                                                                                value="Aktif">
                                                                                                                Aktif
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="Non Aktif">
                                                                                                                Non Aktif
                                                                                                            </option>
                                                                                                        </select>
                                                                                                        @error('service')
                                                                                                            <span
                                                                                                                id="category_id-error"
                                                                                                                class="error text-danger"
                                                                                                                for="input-id"
                                                                                                                style="display: block;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div
                                                                                                        class="form-group fill">
                                                                                                        <label
                                                                                                            class="form-label"
                                                                                                            for="tampilan">Cek
                                                                                                            Tampilan</label>
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            id="tampilan"
                                                                                                            name="tampilan">
                                                                                                            <option
                                                                                                                value="Normal">
                                                                                                                Normal
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="TIdak Normal">
                                                                                                                TIdak Normal
                                                                                                            </option>
                                                                                                        </select>
                                                                                                        @error('koneksi')
                                                                                                            <span
                                                                                                                id="category_id-error"
                                                                                                                class="error text-danger"
                                                                                                                for="input-id"
                                                                                                                style="display: block;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div
                                                                                                        class="form-group fill">
                                                                                                        <label
                                                                                                            class="form-label"
                                                                                                            for="ram">Cek
                                                                                                            Free Ram</label>
                                                                                                        <div
                                                                                                            class="row">
                                                                                                            <div
                                                                                                                class="col-md-9">
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    class="form-control"
                                                                                                                    id="ram"
                                                                                                                    placeholder="Cek Free Ram.."
                                                                                                                    name="ram"
                                                                                                                    value="{{ old('ram', $harian->ram) }}"
                                                                                                                    required>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-md-3">
                                                                                                                GB
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        @error('ram')
                                                                                                            <span
                                                                                                                id="category_id-error"
                                                                                                                class="error text-danger"
                                                                                                                for="input-id"
                                                                                                                style="display: block;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div
                                                                                                        class="form-group fill">
                                                                                                        <label
                                                                                                            class="form-label"
                                                                                                            for="hardisk">Cek
                                                                                                            Used
                                                                                                            Hardisk</label>
                                                                                                        <div
                                                                                                            class="row">
                                                                                                            <div
                                                                                                                class="col-md-9">
                                                                                                                <input
                                                                                                                    type="number"
                                                                                                                    class="form-control"
                                                                                                                    id="hardisk"
                                                                                                                    placeholder="Cek Used Hardisk.."
                                                                                                                    name="hardisk"
                                                                                                                    value="{{ old('hardisk', $harian->hardisk) }}"
                                                                                                                    required>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-md-3">
                                                                                                                %
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        @error('hardisk')
                                                                                                            <span
                                                                                                                id="category_id-error"
                                                                                                                class="error text-danger"
                                                                                                                for="input-id"
                                                                                                                style="display: block;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div
                                                                                                        class="form-group fill">
                                                                                                        <label
                                                                                                            class="form-label"
                                                                                                            for="pengunjung">Cek
                                                                                                            Pengunjung</label>
                                                                                                        <div
                                                                                                            class="row">
                                                                                                            <div
                                                                                                                class="col-md-9">
                                                                                                                <input
                                                                                                                    type="number"
                                                                                                                    class="form-control"
                                                                                                                    id="pengunjung"
                                                                                                                    placeholder="Cek Pengunjung.."
                                                                                                                    name="pengunjung"
                                                                                                                    value="{{ old('pengunjung', $harian->pengunjung) }}"
                                                                                                                    required>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-md-3">
                                                                                                                Orang
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        @error('pengunjung')
                                                                                                            <span
                                                                                                                id="category_id-error"
                                                                                                                class="error text-danger"
                                                                                                                for="input-id"
                                                                                                                style="display: block;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <center>
                                                                                                        <label
                                                                                                            for="image"
                                                                                                            class="form-label">Upload
                                                                                                            Gambar</label>
                                                                                                    </center>
                                                                                                    <div class="form-group fill"
                                                                                                        id="dynamic">
                                                                                                        <div
                                                                                                            class="row">
                                                                                                            <div
                                                                                                                class="col-md-10">
                                                                                                                <input
                                                                                                                    class="form-control @error('image') is-invalid @enderror"
                                                                                                                    type="file"
                                                                                                                    id="image"
                                                                                                                    name="image[]">
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-md-2">
                                                                                                                <button
                                                                                                                    type="button"
                                                                                                                    id="tambah"
                                                                                                                    class="btn btn-success">Add</button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        @error('image')
                                                                                                            <span
                                                                                                                id="category_id-error"
                                                                                                                class="error text-danger"
                                                                                                                for="input-id"
                                                                                                                style="display: block;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="sumbit"
                                                                                        class="btn btn-primary">Ubah
                                                                                        Data</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- Detail DATA --}}
                                                                    <button type="button" class="btn btn-primary mr-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#detail{{ $harian->id }}"
                                                                        style="float: right">
                                                                        <i class="feather icon-eye"></i>
                                                                    </button>
                                                                    <div class="modal fade"
                                                                        id="detail{{ $harian->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">Detail
                                                                                        {{ $title }}</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <i class="feather icon-x"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="col-md-12">
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <h6>Koneksi</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6"> :
                                                                                                @if ($harian->koneksi == 'Aktif')
                                                                                                    <label
                                                                                                        class="badge badge-light-success">{{ $harian->koneksi }}</label>
                                                                                                @else
                                                                                                    <label
                                                                                                        class="badge badge-light-danger">{{ $harian->koneksi }}</label>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Web Service</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2"> :
                                                                                                @if ($harian->service == 'Aktif')
                                                                                                    <label
                                                                                                        class="badge badge-light-success">{{ $harian->service }}</label>
                                                                                                @else
                                                                                                    <label
                                                                                                        class="badge badge-light-danger">{{ $harian->service }}</label>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>DB Service</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2"> :
                                                                                                @if ($harian->service == 'Aktif')
                                                                                                    <label
                                                                                                        class="badge badge-light-success">{{ $harian->service }}</label>
                                                                                                @else
                                                                                                    <label
                                                                                                        class="badge badge-light-danger">{{ $harian->service }}</label>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Tampilan Aplikasi</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2"> :
                                                                                                @if ($harian->tampilan == 'Normal')
                                                                                                    <label
                                                                                                        class="badge badge-light-success">{{ $harian->tampilan }}</label>
                                                                                                @else
                                                                                                    <label
                                                                                                        class="badge badge-light-danger">{{ $harian->tampilan }}</label>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Kondisi Backup Server
                                                                                                </h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                :
                                                                                                {{ $harian->Backup->backup }}
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Free Memory RAM</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                : {{ $harian->ram }} GB /
                                                                                                {{ $server->memory }}
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Informasi Hardisk</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                : {{ $harian->hardisk }} GB
                                                                                                /
                                                                                                {{ $server->hdd }}
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Informasi Pengunjung
                                                                                                </h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                : {{ $harian->pengunjung }}
                                                                                                Pengunjung
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Waktu Input</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                : {{ $harian->waktu }}
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Tanggal Input</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                : {{ $harian->tanggal }}
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>PIC</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                : {{ $harian->User->name }}
                                                                                            </div>
                                                                                            <div class="col-md-12 mt-4">
                                                                                                <center>
                                                                                                    @foreach ($gambar as $gbr)
                                                                                                        <img class="img-preview img-fluid mb-1 col-sm-4 card-img-top"
                                                                                                            src="{{ asset('uploads-harian/' . $gbr->original_filename) }}"
                                                                                                            alt="Gambar">
                                                                                                    @endforeach
                                                                                                </center>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@if (Auth::user()->id_role == 5)
    <div class="modal fade" id="tanggal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Input Range Tanggal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form method="GET" action="{{ route('harian.show', $server->id) }}">
                            @csrf
                            <input type="hidden" name="awal" value="">
                            <input type="hidden" name="akhir" value="">
                            <div class="row">
                                <div class="col">
                                    <center>
                                        <label for="image" class="form-label">Tanggal Awal</label>
                                    </center>
                                    <input type="date" class="form-control" placeholder="Tanggal Awal"
                                        name="awal">
                                    @error('awal')
                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                            style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <center>
                                        <label for="image" class="form-label">Tanggal Akhir</label>
                                    </center>
                                    <input type="date" class="form-control" placeholder="Tanggal Akhir"
                                        name="akhir">
                                    @error('akhir')
                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                            style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="sumbit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@section('jsTambahan')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                "aLengthMenu": [
                    [10, 25, 50, 100, 250, 500, -1],
                    [10, 25, 50, 100, 250, 500, 'All']
                ],
                "oLanguage": {
                    "sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
                    "sLengthMenu": 'Tampilkan _MENU_ Data',
                    "sInfoEmpty": 'Tidak ada Data.',
                    "sSearch": 'Pencarian:',
                    "sEmptyTable": 'Tidak ada Data di dalam Database',
                    "oPaginate": {
                        "sNext": 'Selanjutnya',
                        "sLast": 'Terakhir',
                        "sFirst": 'Pertama',
                        "sPrevious": 'Sebelumnya'
                    }
                }
            });
        });
    </script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pages/data-basic-custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('#table_id1').DataTable({
                "aLengthMenu": [
                    [10, 25, 50, 100, 250, 500, -1],
                    [10, 25, 50, 100, 250, 500, 'All']
                ],
                "oLanguage": {
                    "sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
                    "sLengthMenu": 'Tampilkan _MENU_ Data',
                    "sInfoEmpty": 'Tidak ada Data.',
                    "sSearch": 'Pencarian:',
                    "sEmptyTable": 'Tidak ada Data di dalam Database',
                    "oPaginate": {
                        "sNext": 'Selanjutnya',
                        "sLast": 'Terakhir',
                        "sFirst": 'Pertama',
                        "sPrevious": 'Sebelumnya'
                    }
                }
            });
        });
    </script>

    {{-- Update Data --}}
    <script>
        $(document).ready(function() {

            var no = 1;
            var ni = 1;
            $('#tambah').click(function() {
                no++;
                ni++;
                $('#dynamic').append(
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

    @php
        if ($dataGrafik != null) {
            foreach ($dataGrafik as $key => $value) {
                $ram[] = $value['ram'];
                $hardisk[] = $value['hardisk'];
                $pengunjung[] = $value['pengunjung'];
                $tanggal[] = $value['tanggal'];
            }
        } else {
            $ram[] = 0;
            $hardisk[] = 0;
            $pengunjung[] = 0;
            $tanggal[] = 0;
        }
    @endphp

    <script>
        var ctx = document.getElementById('getGrafik').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($tanggal) ?>,
                datasets: [{
                    label: 'Free Memory ',
                    data: <?= json_encode($ram) ?>,
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.25)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('getGrafik1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($tanggal) ?>,
                datasets: [{
                    label: 'Free Hardisk ',
                    data: <?= json_encode($hardisk) ?>,
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.25)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('getGrafik2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($tanggal) ?>,
                datasets: [{
                    label: 'Pengunjung ',
                    data: <?= json_encode($pengunjung) ?>,
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.25)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
@endsection
