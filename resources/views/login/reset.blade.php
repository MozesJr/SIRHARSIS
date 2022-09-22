@extends('layouts.auth')
@section('auth')
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                {{-- <img src="assets/images/logo-dark.png" alt="" class="img-fluid mb-4"> --}}
                                <h4 class="mb-3 f-w-400">Reset your password</h4>
                                <div class="form-group mb-4">
                                    <label class="floating-label" for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" :value="old('email')"
                                        required autofocus>
                                </div>
                                <button class="btn btn-block btn-primary mb-4">Reset password</button>
                                <p class="mb-0 text-muted">Don’t have an account? <a href="{{ route('register') }}"
                                        class="f-w-400">Signup</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
