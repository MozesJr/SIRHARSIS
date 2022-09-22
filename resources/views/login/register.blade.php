@extends('layouts.auth')
@section('auth')
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                {{-- <img src="assets/images/logo-dark.png" alt="" class="img-fluid mb-4"> --}}
                                <h4 class="mb-3 f-w-400">Sign up</h4>
                                <div class="form-group mb-3">
                                    <label class="floating-label" for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="" name="name"
                                        :value="old('name')" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="floating-label" for="username">User Name</label>
                                    <input type="text" class="form-control" id="username" placeholder="" name="username"
                                        :value="old('username')" required autofocus>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="floating-label" for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="" name="email"
                                        :value="old('email')" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="floating-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder=""
                                        name="password" required autocomplete="new-password">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="floating-label" for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" placeholder=""
                                        name="password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>
                                <p class="mb-2">Already have an account? <a href="{{ route('login') }}"
                                        class="f-w-400">Signin</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
