@extends('layouts.admin')
@section('cssTambahan')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/trix.css') }}">
    <script type="text/javascript" src="{{ asset('assets/js/trix.js') }}"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
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
                                    <a href="#!">Server Management</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9 text-start">
                                    <h4>Server Management</h4>
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
                                    <a href="{{ route('exportServer') }}" class="btn btn-success mr-2"
                                        style="float: right"><svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-file-export" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3">
                                            </path>
                                        </svg> Export</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($server as $srv)
                    <div class="col-lg-4 col-md-6">
                        <div class="card user-card user-card-1 mt-4">
                            <div class="card-body pt-0">
                                <div class="user-about-block text-center">
                                    <div class="row align-items-end">
                                        <div class="col text-start pb-3">
                                            @if ($srv->Status->status == 'Active')
                                                <span class="badge bg-success">{{ $srv->Status->status }}</span>
                                            @elseif ($srv->Status->status == 'Pending')
                                                <span class="badge bg-warning">{{ $srv->Status->status }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $srv->Status->status }}</span>
                                            @endif
                                        </div>
                                        <div class="col"><img class="img-radius img-fluid"
                                                src="{{ asset('assets/images/peruri.jpg') }}" alt="User image"></div>
                                        <div class="col text-end pb-3">
                                            {{-- <div class="dropdown">
                                                <a class="drp-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"><i
                                                        class="feather icon-more-horizontal"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop">
                                                        Edit
                                                    </button>
                                                    <a class="dropdown-item"
                                                        href="{{ route('showServer', $srv->id) }}">Edit</a>
                                                    <form action="{{ route('servers.destroy', $srv->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?');">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('servers.show', $srv->id) }}">
                                        <h4 class="mb-1 mt-3">{{ $srv->nameServer }} @if ($srv->ketServer != null)
                                                | {{ $srv->ketServer }}
                                            @endif
                                        </h4>
                                    </a>
                                    <p class="mb-3 text-muted"><svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-calendar-event" width="18"
                                            height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                                            </path>
                                            <path d="M16 3l0 4"></path>
                                            <path d="M8 3l0 4"></path>
                                            <path d="M4 11l16 0"></path>
                                            <path d="M8 15h2v2h-2z"></path>
                                        </svg></i>
                                        {{ Carbon\Carbon::parse($srv->created_at)->isoFormat('dddd, D MMMM Y') }}
                                    </p>
                                    <p class="mb-0"><b>Keterangan : </b>
                                        {{ $srv->excerpt }}
                                    </p>
                                    <p class="mb-0"><b>Status Server : </b>
                                        @if ($srv->Level->level == 'Core')
                                            <span class="badge bg-danger">{{ $srv->Level->level }}</span>
                                        @else
                                            <span class="badge bg-warning">{{ $srv->Level->level }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Server</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('servers.store') }}">
                            @csrf
                            <input type="hidden" name="reqS" value="no1">
                            <div class="form-group fill">
                                <label class="form-label" for="name">Nama Server / Web</label>
                                <input type="text" class="form-control" id="name" placeholder="Data Server"
                                    name="nameServer" value="{{ old('name') }}" required>
                                @error('nameServer')
                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label for="status">Status Server</label>
                                        <select class="form-control" id="status" name="status">
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
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label for="level">Level Server</label>
                                        <select class="form-control" id="level" name="level">
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
                            </div>
                            <div class="form-group fill">
                                <label class="form-label" for="inputAddress2">Keterangan Server</label>
                                <input id="x" type="hidden" name="ket" value="{{ old('ket') }}"
                                    required>
                                <trix-editor input="x">
                                </trix-editor>
                                @error('ket')
                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                </div>
                <div class="modal-footer mt-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="sumbit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Update Data --}}
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Server</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather icon-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('servers.store') }}">
                            @csrf
                            <input type="hidden" name="reqS" value="no1">
                            <div class="form-group fill">
                                <label class="form-label" for="name">Nama Server / Web</label>
                                <input type="text" class="form-control" id="name" placeholder="Data Server"
                                    name="nameServer" value="{{ old('name') }}" required>
                                @error('nameServer')
                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label for="status">Status Server</label>
                                        <select class="form-control" id="status" name="status">
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
                                <div class="col-md-6">
                                    <div class="form-group fill">
                                        <label for="level">Level Server</label>
                                        <select class="form-control" id="level" name="level">
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
                            </div>
                            <div class="form-group fill">
                                <label class="form-label" for="inputAddress2">Keterangan Server</label>
                                <input id="x" type="hidden" name="ket" value="{{ old('ket') }}"
                                    required>
                                <trix-editor input="x">
                                </trix-editor>
                                @error('ket')
                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                        style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                </div>
                <div class="modal-footer mt-2">
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
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
@endsection
