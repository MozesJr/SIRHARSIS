@extends('layouts.admin')
@section('cssTambahan')
    <style>
        .form-step {
            display: none;
        }

        .active-step {
            display: block;
        }

        button {
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        #stepButtons button {
            background-color: #4680FF;
        }

        #stepButtons button.completed-step {
            background-color: #4CAF50;
            color: #ffffff;
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
                                    <a href="#!">Update Data</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header justify-content-center">
                            <center>
                                <div id="stepButtons">
                                    <button type="button" onclick="goToStep(1)"> Connection</button>
                                    <button type="button" onclick="goToStep(2)"> Web Service</button>
                                    <button type="button" onclick="goToStep(3)"> Tampilan </button>
                                    <button type="button" onclick="goToStep(4)"> Memory </button>
                                    <button type="button" onclick="goToStep(5)"> Penyimpanan </button>
                                    <button type="button" onclick="goToStep(6)"> Pengunjung </button>
                                    <button type="button" onclick="goToStep(7)"> Backup Aplikasi </button>
                                    <button type="button" onclick="goToStep(8)"> Service Database </button>
                                </div>
                            </center>
                        </div>
                        <div class="card-body justify-content-center">
                            <form id="formWizard" enctype="multipart/form-data" method="POST"
                                action="{{ route('harian.update', $server->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-step form-group fill" id="step1">
                                    <h3 class="form-label mt-3 mb-4 text-center">Connection</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <img id="preview1"
                                                    class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                                    src="{{ asset('storage/' . $server->image1) }}" alt="Gambar"
                                                    style="width: 750px; height: 350px;">
                                                {{-- <div id="preview1" class="mt-3 mb-3 text-center"></div> --}}
                                            </center>
                                        </div>
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
                                            <input class="form-control mb-3" type="file" name="image1" accept="image/*"
                                                onchange="previewImage(this, 'preview1')">
                                            @error('image1')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" onclick="nextStep()"
                                                style="float: right;">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-step form-group fill" id="step2">
                                    <h3 class="form-label mt-3 mb-4 text-center">Web Service</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <img id="preview1"
                                                    class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                                    src="{{ asset('storage/' . $server->image2) }}" alt="Gambar"
                                                    style="width: 750px; height: 350px;">
                                            </center>
                                        </div>
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
                                            <input class="form-control mb-3" type="file" name="image2" accept="image/*"
                                                onchange="previewImage(this, 'preview1')">
                                            @error('image2')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" onclick="nextStep()"
                                                style="float: right;">Next</button>
                                            <button type="button" class="btn btn-primary" onclick="prevStep()"
                                                style="float: right;">Previous</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-step form-group fill" id="step3">
                                    <h3 class="form-label mt-3 mb-4 text-center">Tampilan</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <img id="preview1"
                                                    class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                                    src="{{ asset('storage/' . $server->image3) }}" alt="Gambar"
                                                    style="width: 750px; height: 350px;">
                                            </center>
                                        </div>
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
                                                accept="image/*" onchange="previewImage(this, 'preview1')">
                                            @error('image2')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" onclick="nextStep()"
                                                style="float: right;">Next</button>
                                            <button type="button" class="btn btn-primary" onclick="prevStep()"
                                                style="float: right;">Previous</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-step form-group fill" id="step4">
                                    <h3 class="form-label mt-3 mb-4 text-center">Memory</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <img id="preview1"
                                                    class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                                    src="{{ asset('storage/' . $server->image4) }}" alt="Gambar"
                                                    style="width: 750px; height: 350px;">
                                            </center>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="number" id="ram" name="ram"
                                                placeholder="5.5 GB" step="0.01" required value="<?= $server->ram ?>">
                                            @error('ram')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control mb-3" type="file" name="image4"
                                                accept="image/*" onchange="previewImage(this, 'preview1')">
                                            @error('image2')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" onclick="nextStep()"
                                                style="float: right;">Next</button>
                                            <button type="button" class="btn btn-primary" onclick="prevStep()"
                                                style="float: right;">Previous</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-step form-group fill" id="step5">
                                    <h3 class="form-label mt-3 mb-4 text-center">Penyimpanan</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <img id="preview1"
                                                    class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                                    src="{{ asset('storage/' . $server->image5) }}" alt="Gambar"
                                                    style="width: 750px; height: 350px;">
                                            </center>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="number" id="hardisk" name="hardisk"
                                                placeholder="550.50 GB" step="0.01" required
                                                value="<?= $server->hardisk ?>">
                                            @error('hardisk')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control mb-3" type="file" name="image5"
                                                accept="image/*" onchange="previewImage(this, 'preview1')">
                                            @error('image2')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" onclick="nextStep()"
                                                style="float: right;">Next</button>
                                            <button type="button" class="btn btn-primary" onclick="prevStep()"
                                                style="float: right;">Previous</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-step form-group fill" id="step6">
                                    <h3 class="form-label mt-3 mb-4 text-center">Pengunjung</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <img id="preview1"
                                                    class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                                    src="{{ asset('storage/' . $server->image6) }}" alt="Gambar"
                                                    style="width: 750px; height: 350px;">
                                            </center>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="number" id="pengunjung" name="pengunjung"
                                                placeholder="10 Orang" required value="<?= $server->pengunjung ?>">
                                            @error('pengunjung')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control mb-3" type="file" name="image6"
                                                accept="image/*" onchange="previewImage(this, 'preview1')">
                                            @error('image2')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" onclick="nextStep()"
                                                style="float: right;">Next</button>
                                            <button type="button" class="btn btn-primary" onclick="prevStep()"
                                                style="float: right;">Previous</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-step form-group fill" id="step7">
                                    <h3 class="form-label mt-3 mb-4 text-center">Backup Aplikasi</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <img id="preview1"
                                                    class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                                    src="{{ asset('storage/' . $server->image7) }}" alt="Gambar"
                                                    style="width: 750px; height: 350px;">
                                            </center>
                                        </div>
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
                                                accept="image/*" onchange="previewImage(this, 'preview1')">
                                            @error('image2')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" onclick="nextStep()"
                                                style="float: right;">Next</button>
                                            <button type="button" class="btn btn-primary" onclick="prevStep()"
                                                style="float: right;">Previous</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-step form-group fill" id="step8">
                                    <h3 class="form-label mt-3 mb-4 text-center">Service DataBase</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <img id="preview1"
                                                    class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                                    src="{{ asset('storage/' . $server->image8) }}" alt="Gambar"
                                                    style="width: 750px; height: 350px;">
                                            </center>
                                        </div>
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
                                                accept="image/*" onchange="previewImage(this, 'preview1')">
                                            @error('image2')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success"
                                                style="float: right;">Submit</button>
                                            <button type="button" class="btn btn-primary" onclick="prevStep()"
                                                style="float: right;">Previous</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsTambahan')
    <script>
        let currentStep = 1;

        function showStep(step) {
            const steps = document.querySelectorAll('.form-step');
            steps.forEach((s, index) => {
                s.classList.remove('active-step');
                if (index < step - 1) {
                    s.classList.add('completed-step');
                }
            });

            const currentStepElement = document.getElementById(`step${step}`);
            currentStepElement.classList.add('active-step');

            updateStepButtons();
        }

        function updateStepButtons() {
            const buttons = document.querySelectorAll('#stepButtons button');
            buttons.forEach((button, index) => {
                button.classList.remove('completed-step');
                if (index < currentStep - 1) {
                    button.classList.add('completed-step');
                }
            });
        }

        function nextStep() {
            if (currentStep < 8) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function goToStep(step) {
            if (step >= 1 && step <= 8) {
                currentStep = step;
                showStep(currentStep);
            }
        }

        // Pemanggilan fungsi showStep(1) untuk memastikan Step 1 muncul saat halaman dimuat
        showStep(1);

        function previewImage(input, previewId) {
            console.log('Preview Image function called');
            var previewContainer = document.getElementById(previewId);
            var previewImageElement = document.querySelector(`#${previewId} img`);

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    if (!previewImageElement) {
                        // If the image element doesn't exist, create it
                        previewImageElement = document.createElement('img');
                        previewImageElement.classList.add('img-fluid');
                        previewContainer.appendChild(previewImageElement);
                    }

                    previewImageElement.src = e.target.result;
                    previewImageElement.style.maxWidth = '500px';
                    previewImageElement.style.maxHeight = '500px';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                if (previewImageElement) {
                    // If there's an existing image element, remove it
                    previewContainer.removeChild(previewImageElement);
                }
            }
        }
    </script>
@endsection
