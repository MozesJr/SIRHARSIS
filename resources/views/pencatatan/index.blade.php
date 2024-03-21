@extends('layouts.admin')
@section('cssTambahan')
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/plugins/dataTables.bootstrap4.min.css">
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
                                    <a href="#!">Pencatatan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4>Daftar Catatan Pekerjaan</h4>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('pencatatan.create') }}" class="btn btn-primary mr-2"
                                        style="float: right"><svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-pencil-plus" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                                            <path d="M13.5 6.5l4 4"></path>
                                            <path d="M16 19h6"></path>
                                            <path d="M19 16v6"></path>
                                        </svg> Add Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="simpletable"
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
                                                            aria-label="Judul: activate to sort column ascending">Judul</th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Kegiatan: activate to sort column ascending">
                                                            Kegiatan</th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Tanggal: activate to sort column ascending">Tanggal
                                                        </th>
                                                        @if (Auth::user()->id_role == 5)
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Oleh: activate to sort column ascending">
                                                                Oleh
                                                            </th>
                                                        @endif
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending">Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pencatatan as $pct)
                                                        <tr class="odd">
                                                            <td class="sorting_1">{{ $loop->iteration }}</td>
                                                            <td>{{ $pct->judul }}</td>
                                                            <td>{{ $pct->excerpt }}</td>
                                                            <td>{{ Carbon\Carbon::parse($pct->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                                            </td>
                                                            @if (Auth::user()->id_role == 5)
                                                                <td>{{ $pct->User->name }} | {{ $pct->User->username }}</td>
                                                            @endif
                                                            <td>
                                                                <a href="{{ route('pencatatan.show', $pct->id) }}">
                                                                    <button class="btn btn-primary">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="icon icon-tabler icon-tabler-eye-check"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" stroke-width="2"
                                                                            stroke="currentColor" fill="none"
                                                                            stroke-linecap="round" stroke-linejoin="round">
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
                                                                </a>
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
            </div>
        </div>
    </div>
@endsection
@section('jsTambahan')
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pages/data-basic-custom.js"></script>
@endsection
