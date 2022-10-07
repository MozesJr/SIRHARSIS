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
                                        href="{{ route('servers.show', $data->Server->id) }}">{{ $data->Server->name }}</a>
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
                                    <h4>{{ $title }} | {{ $data->Server->name }}</h4>
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
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        {{-- Keterangan Aplikasi --}}
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Spesifikasi Server</h5>
                                                <button type="button" class="btn btn-primary btn-sm rounded m-0 float-end"
                                                    data-bs-toggle="collapse" data-bs-target=".pro-det-edit"
                                                    aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                                    <i class="feather icon-edit"></i>
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="pro-det-edit collapse show" id="pro-det-edit-1">
                                                @php
                                                    if ($dataSpek != null) {
                                                        $data = unserialize($dataSpek->ketH);
                                                        $pecahStr = explode('-', $data);
                                                    } else {
                                                        $pecahStr = ['', '', '', '', ''];
                                                    }
                                                @endphp
                                                <form>
                                                    <h5 class="text-primary">Spesifikasi Server</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Operating
                                                            System</label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[0] }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">CPU
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[1] }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Memory
                                                        </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[2] }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Kapasitas
                                                            HDD </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[3] }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Kapasitas
                                                            Terpakai </label>
                                                        <div class="col-sm-9">
                                                            {{ $pecahStr[4] }}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="pro-det-edit collapse " id="pro-det-edit-2">
                                                <form action="" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="spek" value="spekServer">
                                                    <h5 class="text-primary">Spesifikasi Server</h5>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Operating
                                                            System </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Operating System.."
                                                                value="{{ $pecahStr[0] }}" name="osSpek">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">CPU
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" placeholder="CPU.."
                                                                value="{{ $pecahStr[1] }}" name="cpuSpek">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Memory
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Memory.." value="{{ $pecahStr[2] }}"
                                                                name="memorySpek">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Kapasitas
                                                            HDD </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Kapasitas HDD.." value="{{ $pecahStr[3] }}"
                                                                name="hddSpek">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-sm-3 col-form-label font-weight-bolder">Kapasitas
                                                            Terpakai </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Kapasitas Terpakai.."
                                                                value="{{ $pecahStr[4] }}" name="hddTSpek">
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
