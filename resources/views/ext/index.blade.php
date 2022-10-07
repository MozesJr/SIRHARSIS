@extends('layouts.admin')
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Software</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Software</a></li>
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
                                <div class="col-md-12">
                                    <center>
                                        <h4>Daftar Data Software</h4>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Data Base</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop" style="float: right">
                                <i class="feather icon-plus"></i> Add Data
                            </button>
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
                                                            aria-label="Data Base: activate to sort column ascending">
                                                            Data Base
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending">Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($db as $d)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $d->name }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-warning"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop1{{ $d->id }}">
                                                                    <i class="feather icon-settings"></i>
                                                                </button>
                                                                <div class="modal fade"
                                                                    id="staticBackdrop1{{ $d->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticBackdropLabel">Ubah Data
                                                                                    Data Base</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i class="feather icon-x"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-md-12">
                                                                                    <form method="POST"
                                                                                        action="{{ route('ext.update', $d->id) }}">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <input type="hidden" name="soft"
                                                                                            value="dbs">
                                                                                        <div class="form-group fill">
                                                                                            <label class="form-label"
                                                                                                for="name">Data
                                                                                                Base</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="name"
                                                                                                placeholder="Data Base"
                                                                                                name="name"
                                                                                                value="{{ old('name', $d->name) }}"
                                                                                                required>
                                                                                            @error('name')
                                                                                                <span id="category_id-error"
                                                                                                    class="error text-danger"
                                                                                                    for="input-id"
                                                                                                    style="display: block;">{{ $message }}</span>
                                                                                            @enderror
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
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Data Bahasa Pemrograman / Framework</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop1" style="float: right">
                                <i class="feather icon-plus"></i> Add Data
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="table_id1"
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
                                                            aria-label="Bahasa: activate to sort column ascending">
                                                            Bahasa
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending">Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bh as $b)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $b->name }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-warning"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop1{{ $b->id }}">
                                                                    <i class="feather icon-settings"></i>
                                                                </button>
                                                                <div class="modal fade"
                                                                    id="staticBackdrop1{{ $b->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticBackdropLabel">Ubah Data
                                                                                    Bahasa Pemrograman</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i class="feather icon-x"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-md-12">
                                                                                    <form method="POST"
                                                                                        action="{{ route('ext.update', $b->id) }}">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <input type="hidden"
                                                                                            name="soft" value="bhs">
                                                                                        <div class="form-group fill">
                                                                                            <label class="form-label"
                                                                                                for="name">Bahasa
                                                                                                Pemrograman</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="name"
                                                                                                placeholder="Bahasa Pemrograman"
                                                                                                name="name"
                                                                                                value="{{ old('name', $b->name) }}"
                                                                                                required>
                                                                                            @error('name')
                                                                                                <span id="category_id-error"
                                                                                                    class="error text-danger"
                                                                                                    for="input-id"
                                                                                                    style="display: block;">{{ $message }}</span>
                                                                                            @enderror
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
                                                            </td>>
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
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Software</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('ext.store') }}" id="form1" name="form1">
                            @csrf
                            <input type="hidden" name="soft" value="dbs">
                            <div class="form-group fill">
                                <label class="form-label" for="name">Data Base</label>
                                <input type="text" class="form-control" id="name" placeholder="Data Base"
                                    name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
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

    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Software</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('ext.store') }}" id="form1" name="form1">
                            @csrf
                            <input type="hidden" name="soft" value="bhs">
                            <div class="form-group fill">
                                <label class="form-label" for="name">Bahasa Pemrograman / Framwork</label>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Bahasa Pemrograman / Framwork" name="name"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
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
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pages/data-basic-custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
@endsection
