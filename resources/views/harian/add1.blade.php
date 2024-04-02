@extends('layouts.admin')
@section('cssTambahan')
    <style>
        .form-step {
            display: none;
        }

        .form-step.active-step {
            display: block;
        }

        #progressBar {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        #progressBarFill {
            height: 20px;
            background-color: #4680FF;
            border-radius: 5px;
            width: 0%;
            /* Mulai dari 0% */
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
                                    <a href="{{ route('harian.index') }}">Tugas Harian</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#!">Create Data</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Data Tugas Harian | {{ $server->nameServer }} | {{ $server->ketServer }}</h4>
                        </div>
                        @if ($server->nameServer != 'ERP')
                            <div class="card-body">
                                <form method="POST" action="{{ route('harian.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $server->id }}">
                                    <div id="formWizard">

                                        <div class="progress mb-4" id="progressBar">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                id="progressBarFill">
                                            </div>
                                        </div>

                                        {{-- Input Step 1 --}}
                                        <div class="form-step form-group fill" id="step1">
                                            <div class="row">
                                                <div class="alert alert-primary">
                                                    <div class="media align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-info-circle" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                        <div class="media-body ms-3"> Cara Mengecek Koneksi dengan melakukan
                                                            ping pada alamat IP aplikasi</div>
                                                    </div>
                                                </div>
                                                <h3 class="form-label mt-3 mb-4 text-center"> 1. Connection</h3>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="koneksi" name="koneksi" required>
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Non Aktif">Non Aktif</option>
                                                    </select>
                                                    @error('koneksi')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control mb-3" type="file" name="image1"
                                                        accept="image/*" onchange="previewImage(this, 'preview1')" required>
                                                    <div id="preview1" class="mt-3 text-center"></div>
                                                    @error('image1')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="nextStep(2)">Next</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Input Step 2 --}}
                                        <div class="form-step" id="step2">
                                            <div class="row">
                                                <div class="alert alert-primary">
                                                    <div class="media align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-info-circle" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                        <div class="media-body ms-3"> Cara mengecek koneksi web service
                                                            adalah
                                                            <br>
                                                            1. Apache = service apache2 status <br>
                                                            2. Nginx = service nginx status
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="form-label mt-3 mb-4 text-center"> 2. Web Service</h3>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="service" name="service" required>
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Non Aktif">Non Aktif</option>
                                                    </select>
                                                    @error('service')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control mb-3" type="file" name="image2"
                                                        accept="image/*" onchange="previewImage(this, 'preview2')"
                                                        required>
                                                    <div id="preview2" class="mt-3 text-center"></div>
                                                    @error('image2')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="nextStep(3)">Next</button>
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="backStep(1)">Back</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Input Step 3 --}}
                                        <div class="form-step" id="step3">
                                            <div class="row">
                                                <div class="alert alert-primary">
                                                    <div class="media align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-info-circle"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                        <div class="media-body ms-3"> Cara Mengecek tampilan dengan membuka
                                                            aplikasi terkait, apakah aplikasi itu berjalan dengan semestinya
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="form-label mt-3 mb-4 text-center"> 3. Tampilan</h3>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="tampilan" name="tampilan" required>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Non Normal">Non Normal</option>
                                                    </select>
                                                    @error('tampilan')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control mb-3" type="file" name="image3"
                                                        accept="image/*" onchange="previewImage(this, 'preview3')"
                                                        required>
                                                    <div id="preview3" class="mt-3 text-center"></div>
                                                    @error('image3')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="nextStep(4)">Next</button>
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="backStep(2)">Back</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Input Step 4 --}}
                                        <div class="form-step" id="step4">
                                            <div class="row">
                                                <div class="alert alert-primary">
                                                    <div class="media align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-info-circle"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                        <div class="media-body ms-3"> Cara mengecek free Memory Ram adalah
                                                            dengan mengetik 'free' pada cli di server
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="form-label mt-3 mb-4 text-center"> 4. Memory</h3>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="number" id="ram"
                                                        name="ram" placeholder="5.5 GB" step="0.01" required>
                                                    @error('ram')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control mb-3" type="file" name="image4"
                                                        accept="image/*" onchange="previewImage(this, 'preview4')"
                                                        required>
                                                    <div id="preview4" class="mt-3 text-center"></div>
                                                    @error('image4')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="nextStep(5)">Next</button>
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="backStep(3)">Back</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Input Step 5 --}}
                                        <div class="form-step" id="step5">
                                            <div class="row">
                                                <div class="alert alert-primary">
                                                    <div class="media align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-info-circle"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                        <div class="media-body ms-3"> Cara mengecek free hardisk adalah
                                                            dengan
                                                            mengetik 'df -h' pada cli di server
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="form-label mt-3 mb-4 text-center"> 5. Penyimpanan</h3>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="number" id="hardisk"
                                                        name="hardisk" placeholder="550.50 GB" step="0.01" required>
                                                    @error('hardisk')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control mb-3" type="file" name="image5"
                                                        accept="image/*" onchange="previewImage(this, 'preview5')"
                                                        required>
                                                    <div id="preview5" class="mt-3 text-center"></div>
                                                    @error('image5')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="nextStep(6)">Next</button>
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="backStep(4)">Back</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Input Step 6 --}}
                                        <div class="form-step" id="step6">
                                            <div class="row">
                                                <div class="alert alert-primary">
                                                    <div class="media align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-info-circle"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                        <div class="media-body ms-3"> Cara mengecek Pengunjung adalah
                                                            dengan
                                                            mengetik 'netstat -anp |grep tcp |grep ::ffff: |wc -l' pada cli
                                                            di
                                                            server
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="form-label mt-3 mb-4 text-center"> 6. Pengunjung</h3>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="number" id="pengunjung"
                                                        name="pengunjung" placeholder="10 Orang" required>
                                                    @error('pengunjung')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control mb-3" type="file" name="image6"
                                                        accept="image/*" onchange="previewImage(this, 'preview6')"
                                                        required>
                                                    <div id="preview6" class="mt-3 text-center"></div>
                                                    @error('image6')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="nextStep(7)">Next</button>
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="backStep(5)">Back</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Input Step 7 --}}
                                        <div class="form-step" id="step7">
                                            <div class="row">
                                                <div class="alert alert-primary">
                                                    <div class="media align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-info-circle"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                        <div class="media-body ms-3"> Cara Mengecek bcakup aplikasi dengan
                                                            cara
                                                            membuka path terkait dan memeriksa apakah sudah ada data backup
                                                            aplikasi tersebut
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="form-label mt-3 mb-4 text-center"> 7. Backup Aplikasi</h3>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="backup" name="backup" required>
                                                        @foreach ($dataBackup as $backup)
                                                            <option value="{{ $backup->id }}">{{ $backup->backup }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('backup')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control mb-3" type="file" name="image7"
                                                        accept="image/*" onchange="previewImage(this, 'preview7')"
                                                        required>
                                                    <div id="preview7" class="mt-3 text-center"></div>
                                                    @error('image7')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="nextStep(8)">Next</button>
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="backStep(6)">Back</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Input Step 8 --}}
                                        <div class="form-step" id="step8">
                                            <div class="row">
                                                <div class="alert alert-primary">
                                                    <div class="media align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-info-circle"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                        <div class="media-body ms-3"> Cara mengecek service DB adalah
                                                            dengan
                                                            mengetik 'service mysql status' pada cli di server
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="form-label mt-3 mb-4 text-center"> 8. Service DataBase</h3>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="dbService" name="dbService">
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Non Aktif">Non Aktif</option>
                                                    </select>
                                                    @error('dbService')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control mb-3" type="file" name="image8"
                                                        accept="image/*" onchange="previewImage(this, 'preview8')"
                                                        required>
                                                    <div id="preview8" class="mt-3 text-center"></div>
                                                    @error('image8')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary"
                                                        style="float: right;">Submit</button>
                                                    <button class="btn btn-primary" type="button" style="float: right;"
                                                        onclick="backStep(7)">Back</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="card-body">
                            <form method="POST" action="{{ route('harian.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $server->id }}">
                                <div id="formWizard">

                                    <div class="progress mb-4" id="progressBar">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            id="progressBarFill">
                                        </div>
                                    </div>

                                    {{-- Input Step 1 --}}
                                    <div class="form-step form-group fill" id="step1">
                                        <div class="row">
                                            <div class="alert alert-primary">
                                                <div class="media align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-info-circle" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 9h.01"></path>
                                                        <path d="M11 12h1v4h1"></path>
                                                    </svg>
                                                    <div class="media-body ms-3"> Cara Mengecek Koneksi dengan
                                                        melakukan
                                                        ping pada alamat IP aplikasi</div>
                                                </div>
                                            </div>
                                            <h3 class="form-label mt-3 mb-4 text-center"> 1. Connection</h3>
                                            <div class="col-md-6">
                                                <select class="form-control" id="koneksi" name="koneksi" required>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Non Aktif">Non Aktif</option>
                                                </select>
                                                @error('koneksi')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control mb-3" type="file" name="image1"
                                                    accept="image/*" onchange="previewImage(this, 'preview1')" required>
                                                <div id="preview1" class="mt-3 text-center"></div>
                                                @error('image1')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="nextStep(2)">Next</button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Input Step 2 --}}
                                    <div class="form-step" id="step2">
                                        <div class="row">
                                            <div class="alert alert-primary">
                                                <div class="media align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-info-circle" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 9h.01"></path>
                                                        <path d="M11 12h1v4h1"></path>
                                                    </svg>
                                                    <div class="media-body ms-3"> Cara Mengecek tampilan dengan membuka
                                                        aplikasi terkait, apakah aplikasi itu berjalan dengan semestinya
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="form-label mt-3 mb-4 text-center"> 2. Tampilan</h3>
                                            <div class="col-md-6">
                                                <select class="form-control" id="tampilan" name="tampilan" required>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Non Normal">Non Normal</option>
                                                </select>
                                                @error('tampilan')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control mb-3" type="file" name="image3"
                                                    accept="image/*" onchange="previewImage(this, 'preview3')" required>
                                                <div id="preview3" class="mt-3 text-center"></div>
                                                @error('image3')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="nextStep(3)">Next</button>
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="backStep(1)">Back</button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Input Step 3 --}}
                                    <div class="form-step" id="step3">
                                        <div class="row">
                                            <div class="alert alert-primary">
                                                <div class="media align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-info-circle" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 9h.01"></path>
                                                        <path d="M11 12h1v4h1"></path>
                                                    </svg>
                                                    <div class="media-body ms-3"> Cara mengecek free Memory Ram adalah
                                                        dengan mengetik 'free' pada cli di server
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="form-label mt-3 mb-4 text-center"> 3. Memory</h3>
                                            <div class="col-md-6">
                                                <input class="form-control" type="number" id="ram" name="ram"
                                                    placeholder="5.5 GB" step="0.01" required>
                                                @error('ram')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control mb-3" type="file" name="image4"
                                                    accept="image/*" onchange="previewImage(this, 'preview4')" required>
                                                <div id="preview4" class="mt-3 text-center"></div>
                                                @error('image4')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="nextStep(4)">Next</button>
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="backStep(2)">Back</button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Input Step 4 --}}
                                    <div class="form-step" id="step4">
                                        <div class="row">
                                            <div class="alert alert-primary">
                                                <div class="media align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-info-circle" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 9h.01"></path>
                                                        <path d="M11 12h1v4h1"></path>
                                                    </svg>
                                                    <div class="media-body ms-3"> Cara mengecek free hardisk adalah
                                                        dengan
                                                        mengetik 'df -h' pada cli di server
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="form-label mt-3 mb-4 text-center"> 4. Penyimpanan</h3>
                                            <div class="col-md-6">
                                                <input class="form-control" type="number" id="hardisk" name="hardisk"
                                                    placeholder="550.50 GB" step="0.01" required>
                                                @error('hardisk')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control mb-3" type="file" name="image5"
                                                    accept="image/*" onchange="previewImage(this, 'preview5')" required>
                                                <div id="preview5" class="mt-3 text-center"></div>
                                                @error('image5')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="nextStep(5)">Next</button>
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="backStep(3)">Back</button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Input Step 6 --}}
                                    <div class="form-step" id="step5">
                                        <div class="row">
                                            <div class="alert alert-primary">
                                                <div class="media align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-info-circle" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 9h.01"></path>
                                                        <path d="M11 12h1v4h1"></path>
                                                    </svg>
                                                    <div class="media-body ms-3"> Cara Mengecek backup aplikasi dengan
                                                        cara
                                                        membuka path terkait dan memeriksa apakah sudah ada data backup
                                                        aplikasi tersebut
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="form-label mt-3 mb-4 text-center"> 5. Backup Aplikasi</h3>
                                            <div class="col-md-6">
                                                <select class="form-control" id="backup" name="backup" required>
                                                    @foreach ($dataBackup as $backup)
                                                        <option value="{{ $backup->id }}">{{ $backup->backup }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('backup')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control mb-3" type="file" name="image7"
                                                    accept="image/*" onchange="previewImage(this, 'preview7')" required>
                                                <div id="preview7" class="mt-3 text-center"></div>
                                                @error('image7')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="nextStep(6)">Next</button>
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="backStep(4)">Back</button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Input Step 7 --}}
                                    <div class="form-step" id="step6">
                                        <div class="row">
                                            <div class="alert alert-primary">
                                                <div class="media align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-info-circle" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                        <path d="M12 9h.01"></path>
                                                        <path d="M11 12h1v4h1"></path>
                                                    </svg>
                                                    <div class="media-body ms-3"> Cara mengecek service DB adalah
                                                        dengan
                                                        mengetik 'service mysql status' pada cli di server
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="form-label mt-3 mb-4 text-center"> 6. Service DataBase</h3>
                                            <div class="col-md-6">
                                                <select class="form-control" id="dbService" name="dbService">
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Non Aktif">Non Aktif</option>
                                                </select>
                                                @error('dbService')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control mb-3" type="file" name="image8"
                                                    accept="image/*" onchange="previewImage(this, 'preview8')" required>
                                                <div id="preview8" class="mt-3 text-center"></div>
                                                @error('image8')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <button type="submit" class="btn btn-primary"
                                                    style="float: right;">Submit</button>
                                                <button class="btn btn-primary" type="button" style="float: right;"
                                                    onclick="backStep(5)">Back</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('harian.show', $server->id) }}" class="btn btn-primary"
                                style="float: right;">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Untuk Alert Toast --}}
    <div class="position-fixed top-0 end-0 p-3" id="toastContainer" style="display:none; z-index: 99999;">
        <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="{{ asset('assets/images/favicon.ico') }}" class="img-fluid m-r-5" alt="images"
                    style="width: 17px">
                <strong class="me-auto">E-CODEC</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBody">Hello, world! This is a toast message.</div>
        </div>
    </div>
@endsection
@section('jsTambahan')
    <script>
        function updateProgressBar(stepNumber) {
            var totalSteps = 7;
            var progressPercentage = ((stepNumber - 1) / totalSteps) * 100;
            document.getElementById('progressBarFill').style.width = progressPercentage + '%';
        }

        function nextStep(stepNumber) {
            var currentStep = document.querySelector('.active-step');
            if (currentStep) {
                var inputs = currentStep.querySelectorAll('input');
                var isValid = true;
                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].type !== 'button' && !inputs[i].value) {
                        isValid = false;
                        break;
                    }
                }

                if (!isValid) {
                    // Tampilkan toast
                    document.getElementById('toastBody').innerText =
                        'Semua bidang harus diisi sebelum melanjutkan ke form selanjutnya.';
                    var toastContainer = document.getElementById('toastContainer');
                    toastContainer.style.display = 'block';
                    $('.toast').toast('show');
                    return;
                } else {
                    currentStep.classList.remove('active-step');
                }
            }

            var nextStep = document.getElementById('step' + stepNumber);
            if (nextStep) {
                nextStep.classList.add('active-step');
            }

            updateProgressBar(stepNumber);
        }

        function backStep(stepNumber) {
            var currentStep = document.querySelector('.active-step');
            if (currentStep) {
                currentStep.classList.remove('active-step');
            }
            var previousStep = document.getElementById('step' + stepNumber);
            if (previousStep) {
                previousStep.classList.add('active-step');
            }

            updateProgressBar(stepNumber);
        }

        nextStep(1);

        function previewImage(input, previewId) {
            var previewContainer = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewContainer.innerHTML = '<img class="img-fluid" src="' + e.target.result +
                        '" style="max-width: 500px; max-height: 500px;"/>';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.innerHTML = '';
            }
        }
    </script>
@endsection
