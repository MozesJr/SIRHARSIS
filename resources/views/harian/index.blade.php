@extends('layouts.admin')
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tugas Harian</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Tugas Harian</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($dataServer as $server)
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <i class="fas fa-laptop-code f-36 text-c-purple"></i>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('harian.show', $server->id) }}">
                                            <h6 class="text-muted m-b-10">{{ $server->nameServer }}
                                            </h6>
                                            <h6 class="text-muted m-b-10">{{ $server->ketServer }}
                                            </h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('jsTambahan')
@endsection
