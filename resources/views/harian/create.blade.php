@extends('layouts.admin')
@section('cssTambahan')
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/plugins/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">E-CODEC</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('harian.index') }}">Tugas Harian</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#!">{{ $server->nameServer }} |
                                        {{ $server->ketServer }}</a>
                                </li>
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
                                <a href="{{ route('generatePDF', $server->id) }}" class="btn btn-danger mr-2"
                                    target="_blank"><svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-file-type-pdf" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"></path>
                                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6"></path>
                                        <path d="M17 18h2"></path>
                                        <path d="M20 15h-3v6"></path>
                                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z"></path>
                                    </svg>
                                </a>
                                <button class="btn btn-danger" id="openModalButton">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-script-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M14 20h-8a3 3 0 0 1 0 -6h11a3 3 0 0 0 -3 3m7 -3v-8a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" />
                                        <path d="M17 17l4 4m0 -4l-4 4" />
                                    </svg>
                                </button>
                                <a href="{{ route('harian.export', $server->id) }}" class="btn btn-success mr-2"
                                    target="_blank"><svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-file-spreadsheet" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                        </path>
                                        <path d="M8 11h8v7h-8z"></path>
                                        <path d="M8 15h8"></path>
                                        <path d="M11 11v7"></path>
                                    </svg></a>
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#tanggal">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-calendar-plus" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5">
                                        </path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M16 19h6"></path>
                                        <path d="M19 16v6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row justify-content-center">
                @if (Auth::user()->id_role == 5)
                    <div class="card">
                        <div id="FullData" class="mt-3"></div>
                    </div>
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
                                            style="float: right"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-pencil-plus" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                                                <path d="M13.5 6.5l4 4"></path>
                                                <path d="M16 19h6"></path>
                                                <path d="M19 16v6"></path>
                                            </svg>
                                            Tambah Data</a>
                                        <a href="{{ route('exportHarianId', $server->id) }}" class="btn btn-success mr-2"
                                            style="float: right" target="_blank"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-file-export" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path
                                                    d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3">
                                                </path>
                                            </svg></i>
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
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="simpletable" rowspan="1" colspan="1"
                                                                aria-label="Pencatatan: activate to sort column ascending">
                                                                Pencatatan
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="simpletable" rowspan="1" colspan="1"
                                                                aria-label="Waktu: activate to sort column ascending">
                                                                Waktu
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="simpletable" rowspan="1" colspan="1"
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
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="icon icon-tabler icon-tabler-trash-x"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                                    stroke="currentColor" fill="none"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                                        fill="none" />
                                                                                    <path d="M4 7h16" />
                                                                                    <path
                                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                                    <path
                                                                                        d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                                    <path d="M10 12l4 4m0 -4l-4 4" />
                                                                                </svg>
                                                                            </button>
                                                                        </form>
                                                                    </a>
                                                                    {{-- Update Data --}}
                                                                    <a href="{{ route('harian.updateData', $harian->id) }}"
                                                                        class="btn btn-warning mr-2"
                                                                        style="float: right"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            class="icon icon-tabler icon-tabler-edit"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" stroke-width="2"
                                                                            stroke="currentColor" fill="none"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z"
                                                                                fill="none" />
                                                                            <path
                                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                            <path
                                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                            <path d="M16 5l3 3" />
                                                                        </svg></a>

                                                                    {{-- Detail DATA --}}
                                                                    <button type="button" class="btn btn-primary mr-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#detail{{ $harian->id }}"
                                                                        style="float: right">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="icon icon-tabler icon-tabler-eye-check"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" stroke-width="2"
                                                                            stroke="currentColor" fill="none"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path stroke="none" d="M0 0h24v24H0z"
                                                                                fill="none"></path>
                                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0">
                                                                            </path>
                                                                            <path
                                                                                d="M11.102 17.957c-3.204 -.307 -5.904 -2.294 -8.102 -5.957c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6a19.5 19.5 0 0 1 -.663 1.032">
                                                                            </path>
                                                                            <path d="M15 19l2 2l4 -4"></path>
                                                                        </svg>
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
                                                                                                    <span
                                                                                                        class="badge bg-primary">{{ $harian->koneksi }}</span>
                                                                                                @else
                                                                                                    <span
                                                                                                        class="badge bg-danger">{{ $harian->koneksi }}</span>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Web Service</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2"> :
                                                                                                @if ($harian->service == 'Aktif')
                                                                                                    <span
                                                                                                        class="badge bg-primary">{{ $harian->service }}</span>
                                                                                                @else
                                                                                                    <span
                                                                                                        class="badge danger">{{ $harian->service }}</span>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>DB Service</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2"> :
                                                                                                @if ($harian->service == 'Aktif')
                                                                                                    <span
                                                                                                        class="badge bg-primary">{{ $harian->service }}</span>
                                                                                                @else
                                                                                                    <span
                                                                                                        class="badge danger">{{ $harian->service }}</span>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2">
                                                                                                <h6>Tampilan Aplikasi</h6>
                                                                                            </div>
                                                                                            <div class="col-md-6 mt-2"> :
                                                                                                @if ($harian->tampilan == 'Normal')
                                                                                                    <span
                                                                                                        class="badge bg-primary">{{ $harian->tampilan }}</span>
                                                                                                @else
                                                                                                    <span
                                                                                                        class="badge danger">{{ $harian->tampilan }}</span>
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
                        <form method="POST" action="{{ route('harian.export.range', ['id' => $server->id]) }}">
                            @csrf
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
                    <button type="submit" class="btn btn-primary">Export Excel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dateRangeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateRangeModalLabel">Pilih Range Waktu Untuk Print PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('generatePDFByRange') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_server" value="{{ $server->id }}">
                        <div class="form-group">
                            <label for="start">Start Date</label>
                            <input type="date" class="form-control" id="start" name="start">
                        </div>
                        <div class="form-group">
                            <label for="end">End Date</label>
                            <input type="date" class="form-control" id="end" name="end">
                        </div>
                        <button type="submit" class="btn btn-primary">Generate PDF</button>
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            $('#openModalButton').click(function() {
                $('#dateRangeModal').modal('show');
            });
        });
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
        var options = {
            series: [{
                    name: 'Free Memory',
                    data: <?= json_encode($ram) ?>
                },
                {
                    name: 'Free Hardisk',
                    data: <?= json_encode($hardisk) ?>
                },
                {
                    name: 'Pengunjung',
                    data: <?= json_encode($pengunjung) ?>
                }
            ],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Statistik Penggunaan Memory, Hardisk dan Pengunjung',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: <?= json_encode($tanggal) ?>,
            }
        };

        var chart = new ApexCharts(document.querySelector("#FullData"), options);
        chart.render();
    </script>
@endsection
