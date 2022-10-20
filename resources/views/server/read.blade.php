@extends('layouts.admin')
@section('cssTambahan')
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/plugins/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">{{ $title }}</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('servers.index') }}">Server Management</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">{{ $title }}</a></li>
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
                                    <h4>Daftar Data {{ $title }}</h4>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop" style="float: right">
                                        <i class="feather icon-plus"></i> Add Data
                                    </button>
                                    <button type="button" class="btn btn-success mr-2" style="float: right"><i
                                            class="feather icon-printer"></i> Export</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <center>
                                <h4>Data Keterangan Server {{ $title }}</h4>
                            </center>
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
                                                            aria-label="Server Name: activate to sort column ascending">
                                                            Server Name
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="DNS: activate to sort column ascending">
                                                            DNS
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Data Base: activate to sort column ascending">
                                                            Data Base
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Teknologi: activate to sort column ascending">
                                                            Teknologi
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending">Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataServer as $server)
                                                        @if ($server->ketServer != null)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $server->ketServer }}</td>
                                                                <td>{{ $server->DNS->ipAddress }}</td>
                                                                <td>{{ $server->ENDB->engine }}</td>
                                                                <td>{{ $server->ENAPP->engine }}</td>
                                                                <td>
                                                                    <a href="{{ route('showServer', $server->id) }}">
                                                                        <button class="btn btn-primary">
                                                                            <i class="feather icon-eye"></i>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
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
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('servers.store') }}">
                            @csrf
                            <input type="hidden" name="reqS" value="no2">
                            <input type="hidden" name="id" value="{{ $server->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label class="form-label" for="ketServer">Nama Server / Web</label>
                                        <select class="form-control" id="ketServer" name="ketServer">
                                            <option value="Server Production">Server Production</option>
                                            <option value="Server Development">Server Development</option>
                                        </select>
                                        @error('ketServer')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label class="form-label" for="ipAddress">DNS Server / Web</label>
                                        <input type="text" class="form-control" id="ipAddress"
                                            placeholder="DNS Server / Web" name="ipAddress"
                                            value="{{ old('ipAddress') }}" required>
                                        @error('ipAddress')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label class="form-label" for="ketServer">Engine DB</label>
                                        <select class="form-control" id="engineDB" name="engineDB">
                                            @foreach ($engineDB as $db)
                                                <option value="{{ $db->id }}">{{ $db->engine }}</option>
                                            @endforeach
                                        </select>
                                        @error('ketServer')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label class="form-label" for="ipAddress">Engine APP</label>
                                        <select class="form-control" id="engineApp" name="engineApp">
                                            @foreach ($engineApp as $app)
                                                <option value="{{ $app->id }}">{{ $app->engine }}</option>
                                            @endforeach
                                        </select>
                                        @error('ipAddress')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label class="form-label" for="pathDB">Path Database</label>
                                        <input type="text" class="form-control" id="pathDB"
                                            placeholder="Path Database" name="pathDB" value="{{ old('pathDB') }}"
                                            required>
                                        @error('pathDB')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label class="form-label" for="pathApp">Path Aplikasi</label>
                                        <input type="text" class="form-control" id="pathApp"
                                            placeholder="Path Aplikasi" name="pathApp" value="{{ old('pathApp') }}"
                                            required>
                                        @error('pathApp')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
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
@endsection
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
@endsection
