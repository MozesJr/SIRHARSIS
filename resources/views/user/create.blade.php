@extends('layouts.admin')
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tambah Users</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Data Users</a></li>
                                <li class="breadcrumb-item"><a href="#!">Tambah</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tambah Data Users</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="name">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Nama Lengkap" name="name" value="{{ old('name') }}"
                                                required>
                                            @error('name')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email"
                                                name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="username">User Name</label>
                                            <input type="text" class="form-control" id="username"
                                                placeholder="User Name" name="username" value="{{ old('username') }}"
                                                required>
                                            @error('username')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-5">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" class="form-control form-password" id="password"
                                                placeholder="Password" name="password" required onChange="onChange()">
                                            @error('password')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                                            <input type="password" class="form-control form-password" id="confirm_password"
                                                placeholder="Konfirmasi Password" name="current_password" required
                                                onChange="onChange()">
                                            <span id='message'></span>
                                            @error('confirm_password')
                                                <span id="category_id-error" class="error text-danger" for="input-id"
                                                    style="display: block;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" class="form-checkbox"> Show password
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">Roles</label>
                                                <select class="form-control" id="role" name="role">
                                                    @foreach ($dataRole as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
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
                                                    @foreach ($dataJob as $job)
                                                        <option value="{{ $job->id }}">{{ $job->job }}</option>
                                                    @endforeach
                                                </select>
                                                @error('job')
                                                    <span id="category_id-error" class="error text-danger" for="input-id"
                                                        style="display: block;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn  btn-primary" id="gantiSubmit"
                                        style="float: right">Tambah
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $('.form-password').attr('type', 'text');
                } else {
                    $('.form-password').attr('type', 'password');
                }
            });
        });
        $('#password, #confirm_password').on('keyup', function() {
            if ($('#password').val() != $('#confirm_password').val()) {
                $('#message').html('Password Tidak Sama').css('color', 'red');
            } else
                $('#message').html('Password Sama').css('color', 'green');
        });

        function onChange() {
            const password = document.querySelector('input[name=password]');
            const confirm = document.querySelector('input[name=confirm_password]');
            if (confirm.value === password.value) {
                confirm.setCustomValidity('');
            } else {
                confirm.setCustomValidity('Password tidak Sama');
            }
        }
    </script>
@endsection
