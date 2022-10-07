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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('servers.show', $dataKet->Server->id) }}">{{ $dataKet->Server->name }}</a>
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
                                    <h4>{{ $title }} | {{ $dataKet->Server->name }}</h4>
                                </div>
                                <div class="col-md-3">
                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop" style="float: right">
                                        <i class="feather icon-plus"></i> Add Data
                                    </button> --}}
                                </div>
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
                                            aria-selected="false">Teknologi Aplikasi</a>
                                        <a class="nav-link" id="v-pills-Seating-tab" data-bs-toggle="pill"
                                            href="#v-pills-Seating1" role="tab" aria-controls="v-pills-Seating"
                                            aria-selected="false">Akses</a>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        {{-- Keterangan Aplikasi --}}
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">{{ $dataKet->Server->name }}</h5>
                                                <button type="button" class="btn btn-primary btn-sm rounded m-0 float-end"
                                                    data-bs-toggle="collapse" data-bs-target=".pro-det-edit"
                                                    aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                                    <i class="feather icon-edit"></i>
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
                                                            {{ $dataKet->ket }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">DNS
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataKet->dns }}
                                                        </div>
                                                    </div>
                                                    <h5 class="text-primary">Keterangan DataBase</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Teknologi
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataKet->DB->name }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Nama
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            {{ $dataKet->ndb }}
                                                        </div>
                                                    </div>
                                                    <h5 class="text-primary">Path Root</h5>
                                                    @php
                                                        if ($dataSoftKet != null) {
                                                            $data = unserialize($dataSoftKet->ketS);
                                                            $pecahStr = explode('-', $data);
                                                        } else {
                                                            $pecahStr = ['', '', ''];
                                                        }
                                                    @endphp
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[0] }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[1] }}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="pro-det-edit collapse " id="pro-det-edit-2">
                                                <form action="{{ route('ketServer.update', $dataKet->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="keterangan" value="ketApp">
                                                    <h5 class="text-primary">Keterangan Server</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label
                                                            class="col-sm-3 col-form-label font-weight-bolder">Keterangan
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Keterangan Aplikasi.."
                                                                value="{{ $dataKet->ket }}" name="ketApp">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">DNS
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="DNS.." value="{{ $dataKet->dns }}"
                                                                name="dnsApp">
                                                        </div>
                                                    </div>
                                                    <h5 class="text-primary">Keterangan DataBase</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Teknologi
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <select class='form-control' name='ketDB' id='ketDB'>
                                                                <option value="{{ $dataKet->DB->id }}">
                                                                    {{ $dataKet->DB->name }}</option>
                                                                @foreach ($dbs as $d)
                                                                    <option value='{{ $d->id }}'>
                                                                        {{ $d->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Nama
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Nama Database.." value="{{ $dataKet->ndb }}"
                                                                name="nameDbs">
                                                        </div>
                                                    </div>
                                                    <h5 class="text-primary">Path Root</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Aplikasi </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Path Aplikasi.." name="pathApp"
                                                                value="{{ $pecahStr[0] }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Database </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Path Database.." name="pathDB"
                                                                value="{{ $pecahStr[1] }}">
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
                                                <h5 class="mb-0">Data Base | {{ $dataKet->DB->name }}</h5>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded m-0 float-end"
                                                    data-bs-toggle="collapse" data-bs-target=".pro-det-edit"
                                                    aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                                    <i class="feather icon-edit"></i>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="pro-det-edit collapse show" id="pro-det-edit-1">
                                                @php
                                                    if ($dataDBKet != null) {
                                                        $data = unserialize($dataDBKet->ketS);
                                                        $pecahStr = explode('-', $data);
                                                    } else {
                                                        $pecahStr = ['', '', ''];
                                                    }
                                                @endphp
                                                <form>
                                                    <h5 class="text-primary">User Name DBS</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">User
                                                            Name </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[0] }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[1] }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Akses </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[2] }}
                                                        </div>
                                                    </div>
                                                    @if ($dataKet != null)
                                                        <div class="form-group row align-items-center float-right">
                                                            <a
                                                                onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?');">
                                                                <form
                                                                    action="{{ route('ketServer.destroy', $dataKet->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="btn btn-danger block mr-2">
                                                                        <i class="feather icon-delete"></i>
                                                                    </button>
                                                                </form>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="pro-det-edit collapse " id="pro-det-edit-2">
                                                <form action="{{ route('ketServer.update', $dataKet->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="keterangan" value="dbApp">
                                                    <h5 class="text-primary">User Name DBS</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">User
                                                            Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Username database.."
                                                                value="{{ $pecahStr[0] }}" name="usDBKet">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label
                                                            class="col-sm-3 col-form-label font-weight-bolder">Password</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Password database.."
                                                                value="{{ $pecahStr[1] }}" name="psDBKet">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Akses</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="path lokasi database.."
                                                                value="{{ $pecahStr[2] }}" name="pathDBKet">
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
                                        {{-- Teknologi APlikasi --}}
                                        <div class="tab-pane fade" id="v-pills-Seating" role="tabpanel"
                                            aria-labelledby="v-pills-Seating-tab">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Teknologi Aplikasi</h5>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded m-0 float-end"
                                                    data-bs-toggle="collapse" data-bs-target=".pro-det-edit"
                                                    aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                                    <i class="feather icon-edit"></i>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="pro-det-edit collapse show" id="pro-det-edit-1">
                                                @php
                                                    if ($dataPrgKet != null) {
                                                        $data = unserialize($dataPrgKet->ketS);
                                                        $pecahStr = explode('-', $data);
                                                    } else {
                                                        $pecahStr = ['', '', ''];
                                                    }
                                                @endphp
                                                <form>
                                                    <h5 class="text-primary">Teknologi Aplikasi</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Bahasa
                                                            Pemrograman </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[0] }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Framework
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[1] }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Akses </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[2] }}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="pro-det-edit collapse " id="pro-det-edit-2">
                                                <form action="{{ route('ketServer.update', $dataKet->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="keterangan" value="prgApp">
                                                    <h5 class="text-primary">User Name DBS</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Bahasa
                                                            Pemrograman </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Bahasa Pemrograman.."
                                                                value="{{ $pecahStr[0] }}" name="bhsKetPrg">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label
                                                            class="col-sm-3 col-form-label font-weight-bolder">Framework</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Framework.." value="{{ $pecahStr[1] }}"
                                                                name="fmKetPrg">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Path
                                                            Akses</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Path Lokasi Aplikasi.."
                                                                value="{{ $pecahStr[2] }}" name="pathKetPrg">
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
                                        {{-- Akses APP --}}
                                        <div class="tab-pane fade" id="v-pills-Seating1" role="tabpanel"
                                            aria-labelledby="v-pills-Seating-tab">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Tipe Akses</h5>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded m-0 float-end"
                                                    data-bs-toggle="collapse" data-bs-target=".pro-det-edit"
                                                    aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                                    <i class="feather icon-edit"></i>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="pro-det-edit collapse show" id="pro-det-edit-1">
                                                @if ($dataH == 0)
                                                    <form>
                                                        <h5 class="text-primary">Tipe Akses</h5>
                                                        <hr>
                                                        <div class="form-group row align-items-center">
                                                            <label class="col-sm-3 col-form-label font-weight-bolder">Akses
                                                            </label>
                                                            <div class="col-sm-9">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <label
                                                                class="col-sm-3 col-form-label font-weight-bolder">Username
                                                            </label>
                                                            <div class="col-sm-9">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <label
                                                                class="col-sm-3 col-form-label font-weight-bolder">password
                                                            </label>
                                                            <div class="col-sm-9">
                                                            </div>
                                                        </div>
                                                    </form>
                                                @else
                                                    <form>
                                                        @foreach ($dataAkses as $data)
                                                            <h5 class="text-primary">Tipe Akses {{ $data->akses }}</h5>
                                                            <hr>
                                                            <div class="form-group row align-items-center">
                                                                <label
                                                                    class="col-sm-3 col-form-label font-weight-bolder">Akses
                                                                </label>
                                                                <div class="col-sm-9">
                                                                    {{ $data->akses }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row align-items-center">
                                                                <label
                                                                    class="col-sm-3 col-form-label font-weight-bolder">Username
                                                                </label>
                                                                <div class="col-sm-9">
                                                                    {{ $data->username }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row align-items-center">
                                                                <label
                                                                    class="col-sm-3 col-form-label font-weight-bolder">password
                                                                </label>
                                                                <div class="col-sm-9">
                                                                    {{ $data->password }}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </form>
                                                @endif
                                            </div>
                                            <div class="pro-det-edit collapse " id="pro-det-edit-2">
                                                <form action="{{ route('ketServer.update', $dataKet->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="keterangan" value="aksesApp">
                                                    @if ($dataH == 0)
                                                        <h5 class="text-primary">Tipe Akses</h5>
                                                        <hr>
                                                        <div id="dynamic_form">
                                                            <div class="form-group baru-data">
                                                                <div class="form-group row align-items-center">
                                                                    <label
                                                                        class="col-sm-3 col-form-label font-weight-bolder">Akses
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Akses.." value="aplikasi"
                                                                            name="aksesAks[]">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row align-items-center">
                                                                    <label
                                                                        class="col-sm-3 col-form-label font-weight-bolder">Username
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Username.." value="username"
                                                                            name="usAks[]">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row align-items-center">
                                                                    <label
                                                                        class="col-sm-3 col-form-label font-weight-bolder">password
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Password.." value="password"
                                                                            name="psAks[]">
                                                                    </div>
                                                                </div>
                                                                <div class="button-group">
                                                                    <button type="button"
                                                                        class="btn btn-success btn-tambah"><i
                                                                            class="fa fa-plus"></i></button>
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-hapus"
                                                                        style="display:none;"><i
                                                                            class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @foreach ($dataAkses as $data)
                                                            <input type="hidden" name="idUserServer[]"
                                                                value="{{ $data->id }}">
                                                            <h5 class="text-primary">Tipe Akses {{ $data->akses }}</h5>
                                                            <hr>
                                                            <div id="dynamic_form">
                                                                <div class="form-group baru-data">
                                                                    <div class="form-group row align-items-center">
                                                                        <label
                                                                            class="col-sm-3 col-form-label font-weight-bolder">Akses
                                                                        </label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Akses.."
                                                                                value="{{ $data->akses }}"
                                                                                name="aksesAks[]">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row align-items-center">
                                                                        <label
                                                                            class="col-sm-3 col-form-label font-weight-bolder">Username
                                                                        </label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Username.."
                                                                                value="{{ $data->username }}"
                                                                                name="usAks[]">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row align-items-center">
                                                                        <label
                                                                            class="col-sm-3 col-form-label font-weight-bolder">password
                                                                        </label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Password.."
                                                                                value="{{ $data->password }}"
                                                                                name="psAks[]">
                                                                        </div>
                                                                    </div>
                                                                    @if ($dataAkses == null)
                                                                        <div class="button-group">
                                                                            <button type="button"
                                                                                class="btn btn-success btn-tambah"><i
                                                                                    class="fa fa-plus"></i></button>
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-hapus"
                                                                                style="display:none;"><i
                                                                                    class="fa fa-times"></i></button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
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
        function addForm() {
            var addrow =
                '<div class="form-group baru-data">\
                                                                                                                                                                                                                                                                                                                                                                                                    <div class="form-group row align-items-center">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label class="col-sm-3 col-form-label font-weight-bolder">Akses</label>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="col-sm-9">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <input type="text" class="form-control" placeholder="Akses.." value="Aplikasi" name="aksesAks[]">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="form-group row align-items-center">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label class="col-sm-3 col-form-label font-weight-bolder">Username</label>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="col-sm-9">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <input type="text" class="form-control" placeholder="Username.." value="username" name="usAks[]">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="form-group row align-items-center">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label class="col-sm-3 col-form-label font-weight-bolder">password </label>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="col-sm-9">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <input type="text" class="form-control" placeholder="Password.." value="password" name="psAks[]">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="button-group">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button type="button" class="btn btn-danger btn-hapus" style="display:none;"><i class="fa fa-times"></i></button>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>'
            $("#dynamic_form").append(addrow);
        }

        $("#dynamic_form").on("click", ".btn-tambah", function() {
            addForm()
            $(this).css("display", "none")
            var valtes = $(this).parent().find(".btn-hapus").css("display", "");
        })

        $("#dynamic_form").on("click", ".btn-hapus", function() {
            $(this).parent().parent('.baru-data').remove();
            var bykrow = $(".baru-data").length;
            if (bykrow == 1) {
                $(".btn-hapus").css("display", "none")
                $(".btn-tambah").css("display", "");
            } else {
                $('.baru-data').last().find('.btn-tambah').css("display", "");
            }
        });

        $('.btn-simpan').on('click', function() {
            $('#dynamic_form').find('input[type="text"], input[type="number"], select, textarea').each(function() {
                if ($(this).val() == "") {
                    event.preventDefault()
                    $(this).css('border-color', 'red');

                    $(this).on('focus', function() {
                        $(this).css('border-color', '#ccc');
                    });
                }
            })
        })
    </script>
@endsection
