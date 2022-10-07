@extends('layouts.admin')
@section('cssTambahan')
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/plugins/dataTables.bootstrap4.min.css">
    <script>
        function tampilkan(){
        var nama_kota=document.getElementById("form1").kategori.value;
        if (nama_kota=="kete")
            {
                document.getElementById("tampil").innerHTML="<div class='col-md-12'><div class='form-group'><label for='ket'>Keterangan</label><textarea class='form-control' id='exampleFormControlTextarea1' rows='3' name='ket'></textarea></div>@error('ket')<span id='category_id-error' class='error text-danger' for='input-id' style='display: block;'>{{ $message }}</span>@enderror</div><div class='col-md-12'><div class='row'><div class='col-md-4'><div class='form-group'><label for='dns'>DNS / IP Server</label><input type='text' class='form-control' id='dns' placeholder='DNS / IP Server' name='dns' value='{{ old('dns') }}' required></div>@error('dns')<span id='category_id-error' class='error text-danger' for='input-id' style='display: block;'>{{ $message }}</span>@enderror</div><div class='col-md-4'><div class='form-group'><label for='exampleDataList' class='form-label'>Database</label><select class='form-control' name='ext' id='ext'>@foreach ($dbs as $d)<option value='{{ $d->id }}'>{{ $d->name }}</option>@endforeach</select></div>@error('ext')<span id='category_id-error' class='error text-danger' for='input-id' style='display: block;'>{{ $message }}</span>@enderror</div><div class='col-md-4'><div class='form-group'><label for='dbn'>Nama Database</label><input type='text' class='form-control' id='dbn' placeholder='Nama Database' name='dbn' value='{{ old('dbn') }}' required></div>@error('dbn')<span id='category_id-error' class='error text-danger' for='input-id' style='display: block;'>{{ $message }}</span>@enderror</div></div></div>";
            }
        else if (nama_kota=="spek")
            {
                document.getElementById("tampil").innerHTML="<div class='col-md-12'><div class='row'><div class='col-md-6'><div class='form-group'><label for='nama'>Nama</label><input type='text' class='form-control' id='nama' placeholder='Nama Server' name='name' value='{{ old('nama') }}' required></div>@error('nama')<span id='category_id-error' class='error text-danger' for='input-id' style='display: block;'>{{ $message }}</span> @enderror</div><div class='col-md-6'><div class='form-group'><label for='hostname'>HostName</label><input type='text' class='form-control' id='hostname' placeholder='hostname Server' name='hostname' value='{{ old('hostname') }}' required></div>@error('hostname')<span id='category_id-error' class='error text-danger' for='input-id' style='display: block;'>{{ $message }}</span> @enderror</div><div class='col-md-6'><div class='form-group'><label for='ip'>IP Server</label><input type='text' class='form-control' id='ip' placeholder='ip Server' name='ip' value='{{ old('ip') }}' required></div>@error('ip')<span id='category_id-error' class='error text-danger' for='input-id' style='display: block;'>{{ $message }}</span> @enderror</div><div class='col-md-6'><div class='form-group'><label for='exampleDataList' class='form-label'>Lokasi</label><input class='form-control' list='datalistOptions' id='exampleDataList' name='lokasi' placeholder='Cari Lokasi...'><datalist id='datalistOptions'><option value='Karawang'><option value='Jakarta'></datalist></div>@error('lokasi')<span id='category_id-error' class='error text-danger' for='input-id' style='display: block;'>{{ $message }}</span> @enderror</div><div class='col-md-12'><div class='form-group'><label for='ket'>Keterangan</label><textarea class='form-control' id='exampleFormControlTextarea1' rows='3' name='ket'></textarea></div>@error('ket')<span id='category_id-error' class='error text-danger' for='input-id' style='display: block;'>{{ $message }}</span> @enderror</div></div></div>";
            }
        }
    </script>
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
                                <li class="breadcrumb-item"><a href="{{ route('servers.index') }}">Server Management</a></li>
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
                                <h4>Data Keterangan Server</h4>
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
                                                            aria-label="Keterangan: activate to sort column ascending">
                                                            Keterangan
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
                                                    @foreach ( $ket as $k )
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $k->ket }}</td>
                                                        <td>{{ $k->dns }}</td>
                                                        <td>{{ $k->DB->name }}</td>
                                                        <td>{{ $bahasa }}</td>
                                                        <td>
                                                            <a href="{{ route('ketServer.show', $k->id) }}">
                                                                <button class="btn btn-primary">
                                                                    <i class="feather icon-eye"></i>
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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <center>
                                <h4>Data Spesifikasi Server</h4>
                            </center>
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
                                                            aria-controls="simpletable1" rowspan="1" colspan="1"
                                                            aria-sort="ascending"
                                                            aria-label="#: activate to sort column descending">#</th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Nama: activate to sort column ascending">
                                                            Nama
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="HostName: activate to sort column ascending">
                                                            HostName
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Lokasi: activate to sort column ascending">
                                                            Lokasi
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="IP Address: activate to sort column ascending">
                                                            IP Address
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending">Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ( $spek as $sp )
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $sp->name }}</td>
                                                        <td>{{ $sp->hostname }}</td>
                                                        <td>{{ $sp->lokasi }}</td>
                                                        <td>{{ $sp->ip }}</td>
                                                        <td>
                                                            <a href="{{ route('spekServer.show', $sp->id) }}">
                                                                <button class="btn btn-primary">
                                                                    <i class="feather icon-eye"></i>
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
                        <form method="POST" action="{{ route('servers.store') }}" id="form1" name="form1">
                            @csrf
                            <input type="hidden" name="id" value="{{ $server->id }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="role">Tipe Catatan</label>
                                    <select class="form-control" name="role" id="kategori" onchange="tampilkan()">
                                        <option value="kete">Keterangan Server</option>
                                        <option value="spek">Spesifikasi Server</option>
                                    </select>
                                </div>
                                @error('role')
                                <span id="category_id-error" class="error text-danger" for="input-id"
                                    style="display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div id="tampil"></div>
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
    $(document).ready( function () {
        $('#table_id').DataTable({
            "aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
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
    } );
    $(document).ready( function () {
        $('#table_id1').DataTable({
            "aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
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
    } );
    </script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pages/data-basic-custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
@endsection