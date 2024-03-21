@extends('layouts.admin')
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
                                <li class="breadcrumb-item">
                                    <a href="#!">Tugas Harian</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @if (Auth::user()->id_role == 5)
                    @foreach ($dataServerAdmin as $server)
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center m-l-0">
                                        <div class="col-auto">
                                            <a href="{{ route('harian.show', $server->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-server-bolt" width="48"
                                                    height="48" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                                    </path>
                                                    <path d="M15 20h-9a3 3 0 0 1 -3 -3v-2a3 3 0 0 1 3 -3h12"></path>
                                                    <path d="M7 8v.01"></path>
                                                    <path d="M7 16v.01"></path>
                                                    <path d="M20 15l-2 3h3l-2 3"></path>
                                                </svg>
                                            </a>
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
                @endif
                @foreach ($dataServer as $server)
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <a href="{{ route('harian.show', $server->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-server-bolt" width="48"
                                                height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                                </path>
                                                <path d="M15 20h-9a3 3 0 0 1 -3 -3v-2a3 3 0 0 1 3 -3h12"></path>
                                                <path d="M7 8v.01"></path>
                                                <path d="M7 16v.01"></path>
                                                <path d="M20 15l-2 3h3l-2 3"></path>
                                            </svg>
                                        </a>
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
