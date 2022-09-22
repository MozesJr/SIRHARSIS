@extends('layouts.admin')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Penugasan</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('penugasan.index') }}">Penugasan</a></li>
                                <li class="breadcrumb-item"><a href="#!">{{ $penugasan->judul }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-12 task-detail-right">
                    <div class="card">
                        <div class="card-body bg-c-green">
                            <div class="counter text-center">
                                <h4 id="timer" class="text-white m-0"></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Penugasan Details</h5>
                        </div>
                        <div class="card-body task-details">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><i class="fas fa-adjust m-r-5"></i> Project:</td>
                                        <td class="text-end"><span class="float-end">{{ $penugasan->judul }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><i class="far fa-credit-card m-r-5"></i> Created:</td>
                                        @php
                                            $string = $penugasan->daterange;
                                            $pecah = substr($string, 0, -12);
                                        @endphp
                                        <td class="text-end">{{ Carbon\Carbon::parse($pecah)->isoFormat('dddd, D MMMM Y') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><i class="far fa-credit-card m-r-5"></i> Deadline:</td>
                                        @php
                                            $string = $penugasan->daterange;
                                            $pecah1 = substr($string, -10);
                                        @endphp
                                        <td class="text-end">
                                            {{ Carbon\Carbon::parse($pecah1)->isoFormat('dddd, D MMMM Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-chart-line m-r-5"></i> Priority:</td>
                                        <td class="text-end"><i class="fas fa-upload m-r-5"></i>
                                            {{ $penugasan->Level->level }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-user-plus m-r-5"></i> Added by:</td>
                                        <td class="text-end">{{ $penugasan->User->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-thermometer-half m-r-5"></i> Status:</td>
                                        <td class="text-end">{{ $penugasan->Status->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a onclick="return confirm('Apakah Anda Yakin Menghapus Data ini?');">
                                <form action="{{ route('penugasan.destroy', $penugasan->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger block mr-2" style="float: right">
                                        <i class="feather icon-delete"></i>
                                    </button>
                                </form>
                            </a>
                            <a href="{{ route('penugasan.edit', $penugasan->id) }}">
                                <button class="btn btn-warning mr-2" style="float: right"><i
                                        class="feather icon-settings"></i>
                                </button>
                            </a>
                            <a href="{{ route('penugasan.index') }}">
                                <button class="btn btn-primary mr-2" style="float: right">
                                    <i class="feather icon-arrow-left"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="mb-3"><i class="fas fa-ticket-alt m-r-5"></i>{{ $penugasan->judul }}</h3>
                        </div>
                        <div class="card-body">
                            @if ($penugasan->gambar)
                                <div class="m-b-20">
                                    <h6>Gambar</h6>
                                    <hr>
                                    <center>
                                        <img class="img-preview img-fluid mb-3 col-sm-5 card-img-top"
                                            src="{{ asset('storage/' . $penugasan->gambar) }}" alt="Gambar">
                                    </center>
                                </div>
                            @endif
                            <div class="m-b-20">
                                <h6>Keterangan</h6>
                                <hr>
                                <p>{!! $penugasan->penugasan !!}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@php
$string = $penugasan->daterange;
$pecah2 = substr($string, -10);
$timer = json_encode(Carbon\Carbon::parse($pecah2)->format('M d, Y'));
@endphp
@section('jsTambahan')
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date(<?= $timer ?>).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = "<b>" + days + "</b> Hari : <b>" + hours +
                "</b> Jam : <b>" +
                minutes + "</b> Menit : <b>" + seconds + "</b>s";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "Times over";
            }
        }, 1000);
    </script>
@endsection
