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
                                <li class="breadcrumb-item"><a href="#!">{{ $dataUser->name }}</a></li>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Details Data User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row align-items-center">
                                <center>
                                    @if ($dataUser->gambar)
                                        <img src="{{ asset('storage/' . $dataUser->gambar) }}" alt=""
                                            class="img-preview img-fluid mb-3 col-sm-3 d-block">
                                    @else
                                        <img src="{{ asset('assets/images/user/men.jpg') }}"
                                            class="img-preview img-fluid mb-3 col-sm-3 card-img-top" height="21"
                                            width="21">
                                    @endif
                                </center>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
                                <div class="col-sm-9">
                                    {{ $dataUser->name }}
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Email</label>
                                <div class="col-sm-9">
                                    <a href="mailto:{{ $dataUser->email }}" target="_blank">{{ $dataUser->email }}</a>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Job Description</label>
                                <div class="col-sm-9">
                                    {{ $dataUser->Job->job }}
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Roles</label>
                                <div class="col-sm-9">
                                    {{ $dataUser->Role->role }}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @if (Auth::user()->Role->role == 'Super Admin')
                                <a onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?');">
                                    <form action="{{ route('users.destroy', $dataUser->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger block mr-2" style="float: right">
                                            <i class="feather icon-delete"></i>
                                        </button>
                                    </form>
                                </a>
                            @endif
                            <a href="{{ route('users.edit', $dataUser->id) }}" class="btn btn-warning mr-2"
                                style="float: right"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                    </path>
                                    <path d="M16 5l3 3"></path>
                                </svg></a>
                            <a href="{{ route('users.index') }}" class="btn btn-primary mr-2" style="float: right"><i
                                    class="feather icon-arrow-left"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Password</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.update', $dataUser->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label" for="current_password">Password Lama</label>
                                        <input type="password" class="form-control form-password" id="current_password"
                                            placeholder="Password Lama" name="current_password"
                                            value="{{ old('current_password') }}" required autocomplete="current_password">
                                        @error('current_password')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label" for="password">Password Baru</label>
                                        <input type="password" class="form-control form-password" id="password"
                                            placeholder="Password Baru" name="password" value="{{ old('password') }}"
                                            required onChange="onChange()">
                                        @error('password')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label" for="confirm_password">Konfirmasi
                                            Password</label>
                                        <input type="password" class="form-control form-password" id="confirm_password"
                                            placeholder="Konfirmasi Password" name="current_password"
                                            value="{{ old('confirm_password') }}" required onChange="onChange()">
                                        <span id='message'></span>
                                        @error('confirm_password')
                                            <span id="category_id-error" class="error text-danger" for="input-id"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-7 mt-2"></div>
                                    <div class="col-md-5 mt-2">
                                        <input type="checkbox" class="form-checkbox"> Show Password
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary mr-2" style="float: right" id="gantiSubmit"><i
                                    class="feather icon-check"></i>
                            </button>
                            </form>
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
