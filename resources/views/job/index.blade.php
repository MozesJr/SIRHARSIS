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
                                    <a href="#!">Job Description</a>
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
                                    <h4>Daftar Job Description</h4>
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
                                                            aria-label="Job: activate to sort column ascending">Job
                                                            Description
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending">Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dataJob as $job)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $job->job }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-warning"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop1{{ $job->id }}">
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
                                                                    id="staticBackdrop1{{ $job->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticBackdropLabel">Ubah Data
                                                                                    Job Description</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i class="feather icon-x"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="col-md-12">
                                                                                    <form method="POST"
                                                                                        action="{{ route('job.update', $job->id) }}">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <div class="form-group fill">
                                                                                            <label class="form-label"
                                                                                                for="job">Job
                                                                                                Description</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="job"
                                                                                                placeholder="Job Description"
                                                                                                name="job"
                                                                                                value="{{ old('job', $job->job) }}"
                                                                                                required>
                                                                                            @error('job')
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
            </div>
        </div>
    </div>
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Job Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('job.store') }}">
                            @csrf
                            <div class="form-group fill">
                                <label class="form-label" for="job">Job Description</label>
                                <input type="text" class="form-control" id="job" placeholder="Job Description"
                                    name="job" value="{{ old('job') }}" required>
                                @error('job')
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
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pages/data-basic-custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
@endsection
