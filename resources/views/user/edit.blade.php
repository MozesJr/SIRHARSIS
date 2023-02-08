@extends('layouts.admin')
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Edit Users</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Data Users</a></li>
                                <li class="breadcrumb-item"><a href="#!">Edit</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Data Users</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{ route('users.update', $dataUser->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="oldImage" value="{{ $dataUser->gambar }}">
                                    <input type="hidden" name="image" value="{{ $dataUser->gambar }}">
                                    <input type="hidden" name="id_role" value="{{ Auth::user()->id_role }}">
                                    <input type="hidden" name="id_job" value="{{ Auth::user()->id_job }}">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Upload Gambar</label>
                                            <img class="img-preview img-fluid mb-3 col-sm-3">
                                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                                id="image" name="image" onchange="previewImage()">
                                        </div>
                                        @error('image')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="name">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Nama Lengkap" name="name"
                                                value="{{ old('name', $dataUser->name) }}" required>
                                            @error('name')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email"
                                                name="email" value="{{ old('email', $dataUser->email) }}" required>
                                            @error('email')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="username">User Name</label>
                                            <input type="text" class="form-control" id="username"
                                                placeholder="User Name" name="username"
                                                value="{{ old('username', $dataUser->username) }}" required>
                                            @error('username')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if (Auth::user()->Role->role == 'Super Admin')
                                        <div class="row mt-5">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="role">Roles</label>
                                                    <select class="form-control" id="role" name="role">
                                                        <option value="{{ $dataUser->Role->id }}" selected>
                                                            {{ $dataUser->Role->role }}</option>
                                                        @foreach ($dataRole as $role)
                                                            <option value="{{ $role->id }}">{{ $role->role }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('role')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="job">Job Description</label>
                                                    <select class="form-control" id="job" name="job">
                                                        <option value="{{ $dataUser->Job->id }}" selected>
                                                            {{ $dataUser->Job->job }}</option>
                                                        @foreach ($dataJob as $job)
                                                            <option value="{{ $job->id }}">{{ $job->job }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('job')
                                                        <span id="category_id-error" class="error text-danger" for="input-id"
                                                            style="display: block;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary mt-5" id="gantiSubmit"
                                        style="float: right">Edit
                                        Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jsTambahan')
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
