@extends('errors::layout')
@section('title', __('Unauthorized'))
@section('errors')
    <img src="{{ asset('assets/images/errors/401N.png') }}" alt="" class="img-preview img-fluid">
    <h5 class="text-muted my-4">Oops! Page Unauthorized!</h5>
    <form action="{{ route('dashboard') }}">
        <button class="btn waves-effect waves-light btn-primary mb-4"><i class="feather icon-refresh-ccw"></i> Reload</button>
    </form>
@endsection
