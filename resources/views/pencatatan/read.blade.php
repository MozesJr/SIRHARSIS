@extends('layouts.admin')
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Pencatatan</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('pencatatan.index') }}">Pencatatan</a></li>
                                <li class="breadcrumb-item"><a href="#!">{{ $pencatatan->judul }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Gambar</h4>
                        </div>
                        <div class="card-body">
                            @if ($pencatatan->gambar != null)
                                <center>
                                    <img class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                        src="{{ asset('storage/' . $pencatatan->gambar) }}" alt="Gambar1">
                                </center>
                            @else
                                <center>
                                    <img class="img-preview img-fluid mb-3 col-sm-12 card-img-top"
                                        src="{{ asset('assets/images/work.jpg') }}" alt="Gambar">
                                </center>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-9">
                                <h4>{{ $pencatatan->judul }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $pencatatan->catatan !!}</p>
                            <hr>
                            <p class="card-text"><small class="text-muted">{{ $pencatatan->tanggal }} |
                                    {{ $pencatatan->User->name }}</small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?');">
                                <form action="{{ route('pencatatan.destroy', $pencatatan->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger block mr-2" style="float: right">
                                        <i class="feather icon-delete"></i>
                                    </button>
                                </form>
                            </a>
                            <a href="{{ route('pencatatan.edit', $pencatatan->id) }}">
                                <button class="btn btn-warning mr-2" style="float: right"><i
                                        class="feather icon-settings"></i>
                                </button>
                            </a>
                            <a href="{{ route('pencatatan.index') }}">
                                <button class="btn btn-primary mr-2" style="float: right">
                                    <i class="feather icon-arrow-left"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
