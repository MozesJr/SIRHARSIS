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
                                    <a href="{{ route('servers.index') }}">Server Management</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('servers.show', $dataServer->id) }}">{{ $dataServer->nameServer }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#!">{{ $dataServer->ketServer }}</a>
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
                                    <h4>Data Server | {{ $dataServer->ketServer }}</h4>
                                </div>
                                {{-- <div class="col-md-3">
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
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="nav flex-column nav-pills mb-3" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                            href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                            aria-selected="true">Keterangan</a>
                                        <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                            href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                            aria-selected="false">Data Base</a>
                                        <a class="nav-link" id="v-pills-Seating-tab" data-bs-toggle="pill"
                                            href="#v-pills-Seating" role="tab" aria-controls="v-pills-Seating"
                                            aria-selected="false">Aplikasi</a>
                                        <a class="nav-link" id="v-pills-Seating-tab" data-bs-toggle="pill"
                                            href="#v-pills-Seating1" role="tab" aria-controls="v-pills-Seating"
                                            aria-selected="false">Spesifikasi</a>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        {{-- Keterangan Aplikasi --}}
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Keterangan | {{ $dataServer->nameServer }} |
                                                    {{ $dataServer->ketServer }}</h5>
                                                <button type="button" class="btn btn-primary btn-sm rounded m-0 float-end"
                                                    data-bs-toggle="collapse" data-bs-target=".pro-det-edit"
                                                    aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye-edit" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                        <path
                                                            d="M11.192 17.966c-3.242 -.28 -5.972 -2.269 -8.192 -5.966c2.4 -4 5.4 -6 9 -6c3.326 0 6.14 1.707 8.442 5.122">
                                                        </path>
                                                        <path
                                                            d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="pro-det-edit collapse show" id="pro-det-edit-1">
                                                <form>
                                                    <h5 class="text-primary">Keterangan Server</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Keterangan
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->ketServer }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">DNS
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            @if ($dataServer->id_ipAddress != null)
                                                                {{ $dataServer->DNS->ipAddress }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Akses
                                                        </label>
                                                        <div class="col-sm-9">
                                                            @if ($dataServer->id_pathAkses != null)
                                                                {{ $dataServer->Path->path }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Tanggal
                                                            Go
                                                            Live
                                                        </label>
                                                        <div class="col-sm-9">
                                                            @if ($dataServer->id_tglGo != null)
                                                                {{ Carbon\Carbon::parse($dataServer->TGL->tglGo)->isoFormat('dddd, D MMMM Y') }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">BPO
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->bpo }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Integrasi
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->intgs }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">PIC
                                                        </label>
                                                        <div class="col-sm-9">
                                                            @if ($dataServer->id_pic_idUsers != null)
                                                                {{ $dataServer->User->name }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="pro-det-edit collapse " id="pro-det-edit-2">
                                                <form action="{{ route('servers.update', $dataServer->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="reqS" value="no3">
                                                    <h5 class="text-primary">Keterangan Server</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label
                                                            class="col-sm-3 col-form-label font-weight-bolder">Keterangan
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Keterangan Aplikasi.."
                                                                value="{{ $dataServer->ketServer }}" name="ketApp">
                                                        </div>
                                                        @error('ketApp')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">DNS
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="DNS.."
                                                                value="{{ $dataServer->DNS->ipAddress }}" name="dnsApp">
                                                        </div>
                                                        @error('dnsApp')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Akses </label>
                                                        <div class="col-sm-9">
                                                            @if ($dataServer->id_pathAkses != null)
                                                                <input type="text" class="form-control"
                                                                    placeholder="Path Akses.."
                                                                    value="{{ $dataServer->Path->path }}"
                                                                    name="pathAkses">
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    placeholder="Path Akses.." name="pathAkses">
                                                            @endif

                                                        </div>
                                                        @error('pathAkses')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Tanggal
                                                            Go Live </label>
                                                        <div class="col-sm-9">
                                                            <input type="date" class="form-control"
                                                                placeholder="Tanggal Go Live.."
                                                                value="{{ $dataServer->id_tglGo }}" name="tglGo">
                                                        </div>
                                                        @error('tglGo')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">BPO
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="BPO.." value="{{ $dataServer->bpo }}"
                                                                name="bpo">
                                                        </div>
                                                        @error('bpo')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Integrasi
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Integrasi.."
                                                                value="{{ $dataServer->intgs }}" name="intgs">
                                                        </div>
                                                        @error('intgs')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">PIC
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <select class='form-control' name='pic' id='pic'>
                                                                @foreach ($dataUser as $users)
                                                                    <option value='{{ $users->id }}'>
                                                                        {{ $users->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mt-2">
                                                        <label class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        {{-- Database --}}
                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                            aria-labelledby="v-pills-messages-tab">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Data Base | {{ $dataServer->ENDB->engine }}</h5>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded m-0 float-end"
                                                    data-bs-toggle="collapse" data-bs-target=".pro-det-edit"
                                                    aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye-edit" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                        <path
                                                            d="M11.192 17.966c-3.242 -.28 -5.972 -2.269 -8.192 -5.966c2.4 -4 5.4 -6 9 -6c3.326 0 6.14 1.707 8.442 5.122">
                                                        </path>
                                                        <path
                                                            d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="pro-det-edit collapse show" id="pro-det-edit-1">
                                                <form>
                                                    <h5 class="text-primary">Data Base</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Engine
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->ENDB->engine }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Nama
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->nDB }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->PathDB->path }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Username
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->usDB }}
                                                        </div>
                                                    </div>
                                                    {{-- <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->psDB }}
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Username
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control form-password"
                                                                placeholder="Username.." value="{{ $dataServer->usDB }}"
                                                                name="usDB">
                                                        </div>
                                                        @error('usDB')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div> --}}
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control form-password"
                                                                placeholder="Password Database.."
                                                                value="{{ $dataServer->psDB }}" disabled>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->id_role == 5)
                                                        <div class="col-sm-5 mt-2" style="float: right">
                                                            <input type="checkbox" class="form-checkbox"> Show Password
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="pro-det-edit collapse " id="pro-det-edit-2">
                                                <form action="{{ route('servers.update', $dataServer->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="reqS" value="no4">
                                                    <h5 class="text-primary">User Name DBS</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Engine
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <select class='form-control' name='enDB' id='enDB'>
                                                                <option value='{{ $dataServer->ENDB->id }}'>
                                                                    {{ $dataServer->ENDB->engine }}</option>
                                                                @foreach ($engineDB as $db)
                                                                    <option value='{{ $db->id }}'>
                                                                        {{ $db->engine }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('enDB')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Nama
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Nama Database.."
                                                                value="{{ $dataServer->nDB }}" name="nDB">
                                                        </div>
                                                        @error('nDB')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Path Database.."
                                                                value="{{ $dataServer->PathDB->path }}" name="pathDB">
                                                        </div>
                                                        @error('pathDB')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Username
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Username.." value="{{ $dataServer->usDB }}"
                                                                name="usDB">
                                                        </div>
                                                        @error('usDB')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control form-password"
                                                                placeholder="Password Database.."
                                                                value="{{ $dataServer->psDB }}" name="psDB">
                                                        </div>
                                                        @error('psDB')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if (Auth::user()->id_role == 5)
                                                        <div class="col-sm-5 mt-2" style="float: right">
                                                            <input type="checkbox" class="form-checkbox"> Show Password
                                                        </div>
                                                    @endif
                                                    <div class="form-group row align-items-center mt-2">
                                                        <label class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        {{-- Teknologi APlikasi --}}
                                        <div class="tab-pane fade" id="v-pills-Seating" role="tabpanel"
                                            aria-labelledby="v-pills-Seating-tab">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Teknologi Aplikasi</h5>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded m-0 float-end"
                                                    data-bs-toggle="collapse" data-bs-target=".pro-det-edit"
                                                    aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye-edit" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                        <path
                                                            d="M11.192 17.966c-3.242 -.28 -5.972 -2.269 -8.192 -5.966c2.4 -4 5.4 -6 9 -6c3.326 0 6.14 1.707 8.442 5.122">
                                                        </path>
                                                        <path
                                                            d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="pro-det-edit collapse show" id="pro-det-edit-1">
                                                <form>
                                                    <h5 class="text-primary">Teknologi Aplikasi</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Bahasa
                                                            Pemrograman </label>
                                                        <div class="col-sm-9">
                                                            @if ($dataServer->id_bhsApp != null)
                                                                {{ $dataServer->BHS->bhs_prg }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Framework
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->ENAPP->engine }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Akses </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->PathApp->path }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Username
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->usApp }}
                                                        </div>
                                                    </div>
                                                    {{-- <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->psApp }}
                                                        </div>
                                                    </div> --}}
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control form-password"
                                                                placeholder="Password Database.."
                                                                value="{{ $dataServer->psApp }}" disabled>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->id_role == 5)
                                                        <div class="col-sm-5 mt-2" style="float: right">
                                                            <input type="checkbox" class="form-checkbox"> Show Password
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="pro-det-edit collapse " id="pro-det-edit-2">
                                                <form action="{{ route('servers.update', $dataServer->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="reqS" value="no5">
                                                    <h5 class="text-primary">User Name DBS</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Bahasa
                                                            Pemrograman </label>
                                                        <div class="col-sm-9">
                                                            @if ($dataServer->id_bhsApp != null)
                                                                <input type="text" class="form-control"
                                                                    placeholder="Bahasa Pemrograman.."
                                                                    value="{{ $dataServer->BHS->bhs_prg }}"
                                                                    name="bhsKetPrg">
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    placeholder="Bahasa Pemrograman.." value=""
                                                                    name="bhsKetPrg">
                                                            @endif
                                                        </div>
                                                        @error('bhsKetPrg')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label
                                                            class="col-sm-3 col-form-label font-weight-bolder">Framework</label>
                                                        <div class="col-sm-9">
                                                            <select class='form-control' name='enApp' id='enApp'>
                                                                <option value='{{ $dataServer->ENAPP->id }}'>
                                                                    {{ $dataServer->ENAPP->engine }}</option>
                                                                @foreach ($engineApp as $app)
                                                                    <option value='{{ $app->id }}'>
                                                                        {{ $app->engine }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('fmKetPrg')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Akses</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Path Lokasi Aplikasi.."
                                                                value="{{ $dataServer->PathApp->path }}"
                                                                name="pathKetPrg">
                                                        </div>
                                                        @error('pathKetPrg')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Username
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Username.." value="{{ $dataServer->usApp }}"
                                                                name="usApp">
                                                        </div>
                                                        @error('usApp')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control form-password"
                                                                placeholder="Password Aplikasi.."
                                                                value="{{ $dataServer->psApp }}" name="psApp">
                                                        </div>
                                                        @error('psApp')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if (Auth::user()->id_role == 5)
                                                        <div class="col-sm-5 mt-2" style="float: right">
                                                            <input type="checkbox" class="form-checkbox"> Show Password
                                                        </div>
                                                    @endif
                                                    <div class="form-group row align-items-center mt-2">
                                                        <label class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        {{-- SPEK APP --}}
                                        <div class="tab-pane fade" id="v-pills-Seating1" role="tabpanel"
                                            aria-labelledby="v-pills-Seating-tab">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Spesifikasi Server</h5>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded m-0 float-end"
                                                    data-bs-toggle="collapse" data-bs-target=".pro-det-edit"
                                                    aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye-edit" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                        <path
                                                            d="M11.192 17.966c-3.242 -.28 -5.972 -2.269 -8.192 -5.966c2.4 -4 5.4 -6 9 -6c3.326 0 6.14 1.707 8.442 5.122">
                                                        </path>
                                                        <path
                                                            d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="pro-det-edit collapse show" id="pro-det-edit-1">
                                                <form>
                                                    <h5 class="text-primary">Spesifikasi Server</h5>
                                                    <hr>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Host Name
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->hostName }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Lokasi
                                                            Server
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->lokasi }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">OS Server
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->os }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">CPU
                                                            Server
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->cpu }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Memory
                                                            Server
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->memory }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">HDD
                                                            Server
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->hdd }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">HDD
                                                            Terpakai
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->terpakai }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Username
                                                            Server
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->usServer }}
                                                        </div>
                                                    </div>
                                                    {{-- <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                            Server
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataServer->psServer }}
                                                        </div>
                                                    </div> --}}
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                            Server </label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control form-password"
                                                                placeholder="Password Database.."
                                                                value="{{ $dataServer->psServer }}" disabled>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->id_role == 5)
                                                        <div class="col-sm-5 mt-2" style="float: right">
                                                            <input type="checkbox" class="form-checkbox"> Show Password
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="pro-det-edit collapse " id="pro-det-edit-2">
                                                <form action="{{ route('servers.update', $dataServer->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="reqS" value="no6">
                                                    <h5 class="text-primary">Spesifikasi Server</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Host
                                                            Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Hostname.."
                                                                value="{{ $dataServer->hostName }}" name="hostname">
                                                        </div>
                                                        @error('hostname')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Lokasi
                                                            Server</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Lokasi.." value="{{ $dataServer->lokasi }}"
                                                                name="lokasi">
                                                        </div>
                                                        @error('lokasi')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Os
                                                            Server</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="os Server.." value="{{ $dataServer->os }}"
                                                                name="os">
                                                        </div>
                                                        @error('os')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">CPU
                                                            Server</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="cpu Server.." value="{{ $dataServer->cpu }}"
                                                                name="cpu">
                                                        </div>
                                                        @error('cpu')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Memory
                                                            Server</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="memory Server.."
                                                                value="{{ $dataServer->memory }}" name="memory">
                                                        </div>
                                                        @error('memory')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">HDD
                                                            Server</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="hdd Server.." value="{{ $dataServer->hdd }}"
                                                                name="hdd">
                                                        </div>
                                                        @error('hdd')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">HDD
                                                            Terpakai</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="terpakai Server.."
                                                                value="{{ $dataServer->terpakai }}" name="terpakai">
                                                        </div>
                                                        @error('terpakai')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Username
                                                            Server</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Username Server.."
                                                                value="{{ $dataServer->usServer }}" name="usServer">
                                                        </div>
                                                        @error('usServer')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                            Server</label>
                                                        <div class="col-sm-9">
                                                            <input type="password" class="form-control form-password"
                                                                placeholder="Password Server.."
                                                                value="{{ $dataServer->psServer }}" name="psServer">
                                                        </div>
                                                        @error('psServer')
                                                            <span id="category_id-error" class="error text-danger"
                                                                for="input-id"
                                                                style="display: block;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    @if (Auth::user()->id_role == 5)
                                                        <div class="col-sm-5 mt-2" style="float: right">
                                                            <input type="checkbox" class="form-checkbox"> Show Password
                                                        </div>
                                                    @endif
                                                    <div class="form-group row align-items-center mt-2">
                                                        <label class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
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
    </div>
@endsection
@section('jsTambahan')
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.form-checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $('.form-password').attr('type', 'text');
                } else {
                    $('.form-password').attr('type', 'password');
                }
            });
        });
    </script>
@endsection
