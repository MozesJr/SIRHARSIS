@extends('layouts.auth')
@section('auth')
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                {{-- <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" class="img-fluid mb-4"> --}}
                                <h4 class="mb-3 f-w-400">Signin</h4>
                                <div class="form-group mb-3">
                                    <label class="floating-label" for="username">User Name</label>
                                    <input type="text" class="form-control" id="username" placeholder="" name="username"
                                        equired autofocus :value="old('username')">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="floating-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder=""
                                        name="password" required autocomplete="current-password">
                                </div>
                                <button type="submit" class="btn btn-block btn-primary mb-4">Signin</button>
                                <p class="mb-2 text-muted">Forgot password? <a href="{{ route('password.request') }}"
                                        class="f-w-400">Reset</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
