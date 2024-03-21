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
                                    <a href="#!">{{ $title }}</a>
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
                                    <h4>Daftar {{ $title }}</h4>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop" style="float: right">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-pencil-plus" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                                            <path d="M13.5 6.5l4 4"></path>
                                            <path d="M16 19h6"></path>
                                            <path d="M19 16v6"></path>
                                        </svg> Add Data
                                    </button>
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
                                                            aria-label="Status: activate to sort column ascending">Status
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending">Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($status as $sts)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $sts->status }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-warning"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop1{{ $sts->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-edit"
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        stroke-width="2" stroke="currentColor"
                                                                        fill="none" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none"></path>
                                                                        <path
                                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                        </path>
                                                                        <path
                                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                        </path>
                                                                        <path d="M16 5l3 3"></path>
                                                                    </svg>
                                                                </button>
                                                                <div class="modal fade"
                                                                    id="staticBackdrop1{{ $sts->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticBackdropLabel">Ubah Data
                                                                                    {{ $title }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i class="feather icon-x"></i>
                                                                                </button>
                                                                            </div>
                                                                            @if ($title == 'Status Penugasan')
                                                                                <div class="modal-body">
                                                                                    <div class="col-md-12">
                                                                                        <form method="POST"
                                                                                            action="{{ route('status.update', $sts->id) }}">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <div class="form-group fill">
                                                                                                <label class="form-label"
                                                                                                    for="status">Status
                                                                                                    Penugasan</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="status"
                                                                                                    placeholder="{{ $title }}"
                                                                                                    name="status"
                                                                                                    value="{{ old('status', $sts->status) }}"
                                                                                                    required>
                                                                                                @error('status')
                                                                                                    <span
                                                                                                        id="category_id-error"
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
                                                                            @else
                                                                                <div class="modal-body">
                                                                                    <div class="col-md-12">
                                                                                        <form method="POST"
                                                                                            action="{{ route('stsSvr.update', $sts->id) }}">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <div class="form-group fill">
                                                                                                <label class="form-label"
                                                                                                    for="status">Status
                                                                                                    Penugasan</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="status"
                                                                                                    placeholder="{{ $title }}"
                                                                                                    name="status"
                                                                                                    value="{{ old('status', $sts->status) }}"
                                                                                                    required>
                                                                                                @error('status')
                                                                                                    <span
                                                                                                        id="category_id-error"
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
                                                                            @endif
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
            </div>
        </div>
    </div>
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x"></i>
                    </button>
                </div>
                @if ($title == 'Status Penugasan')
                    <div class="modal-body">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('status.store') }}">
                                @csrf
                                <div class="form-group fill">
                                    <label class="form-label" for="status">Status Penugasan</label>
                                    <input type="text" class="form-control" id="status"
                                        placeholder="{{ $title }}" name="status" value="{{ old('status') }}"
                                        required>
                                    @error('status')
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
                @else
                    <div class="modal-body">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('stsSvr.store') }}">
                                @csrf
                                <div class="form-group fill">
                                    <label class="form-label" for="status">Status Server</label>
                                    <input type="text" class="form-control" id="status"
                                        placeholder="{{ $title }}" name="status" value="{{ old('status') }}"
                                        required>
                                    @error('status')
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
                @endif
            </div>
        </div>
    </div>
@endsection
@section('jsTambahan')
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pages/data-basic-custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
@endsection
