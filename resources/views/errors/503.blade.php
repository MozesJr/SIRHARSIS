@extends('errors::layout')
@section('title', __('Service Unavailable'))
@section('errors')
    <img src="{{ asset('assets/images/errors/503N.png') }}" alt="" class="img-preview img-fluid">
    <h5 class="text-muted my-4">Oops! Service Unavailable!</h5>
    <form action="{{ route('dashboard') }}">
        <button class="btn waves-effect waves-light btn-primary mb-4"><i class="feather icon-refresh-ccw"></i> Reload</button>
    </form>
@endsection
