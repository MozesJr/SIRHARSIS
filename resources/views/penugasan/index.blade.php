@extends('layouts.admin')
@section('cssTambahan')
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/plugins/fullcalendar.min.css">
@endsection
@section('content')
    <div class="pcoded-main-container">
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
                                <li class="breadcrumb-item"><a href="#!">Penugasan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->id_role == 5)
                <div class="row">
                    <!-- customar project  start -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <i class="fas fa-user-graduate f-36 text-c-purple"></i>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted m-b-10">Student</h6>
                                        <h2 class="m-b-0">45</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <i class="fas fa-users f-36 text-c-red"></i>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted m-b-10">Parents</h6>
                                        <h2 class="m-b-0">9</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <i class="fas fa-user-tie f-36 text-c-green"></i>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted m-b-10">Teacher</h6>
                                        <h2 class="m-b-0">5</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <i class="fas fa-book-open f-36 text-c-blue"></i>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted m-b-10">Subject</h6>
                                        <h2 class="m-b-0">25</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- customar project  end -->
                    <!-- subscribe start -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Account summary</h5>
                            </div>
                            <div class="card-body">
                                <div id="summary-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Event List </h5>
                            </div>
                            <div class="card-body">
                                <div id='Eventcalendar' class='calendar'></div>
                            </div>
                        </div>
                    </div>
                    <!-- subscribe end -->
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4>Daftar Penugasan</h4>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('penugasan.create') }}" class="btn btn-primary mr-2"
                                        style="float: right"><i class="feather icon-plus"></i> Add Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="simpletable"
                                                class="table table-striped table-bordered nowrap dataTable"
                                                aria-describedby="simpletable_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting sorting_asc" tabindex="0"
                                                            aria-controls="simpletable" rowspan="1" colspan="1"
                                                            aria-sort="ascending"
                                                            aria-label="#: activate to sort column descending">
                                                            #</th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Judul: activate to sort column ascending">
                                                            Judul</th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Tujuan: activate to sort column ascending">
                                                            Keterangan</th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Tanggal: activate to sort column ascending">
                                                            Tanggal Berakhir Tugas
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Level: activate to sort column ascending">
                                                            Level Tugas
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Status: activate to sort column ascending">
                                                            Status Tugas
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="simpletable"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($penugasan as $tugas)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $tugas->judul }}</td>
                                                            <td>{{ $tugas->excerpt }}</td>
                                                            <td>
                                                                @php
                                                                    $string = $tugas->daterange;
                                                                    $pecah1 = substr($string, -10);
                                                                @endphp
                                                                {{ Carbon\Carbon::parse($pecah1)->isoFormat('dddd, D MMMM Y') }}
                                                            </td>
                                                            <td>{{ $tugas->Level->level }}</td>
                                                            <td>{{ $tugas->Status->status }}</td>
                                                            <td>
                                                                @if (Auth::user()->id_role == 5)
                                                                    <a href="{{ route('penugasan.show', $tugas->id) }}">
                                                                        <button class="btn btn-primary">
                                                                            <i class="feather icon-eye"></i>
                                                                        </button>
                                                                    </a>
                                                                @endif
                                                                @if (Auth::user()->id_role == 1)
                                                                    <a
                                                                        href="{{ route('penugasan.show', $tugas->id_penugasans) }}">
                                                                        <button class="btn btn-primary">
                                                                            <i class="feather icon-eye"></i>
                                                                        </button>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('jsTambahan')
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/moment.js"></script>
    {{-- <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/jquery-ui.min.js"></script> --}}
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/fullcalendar.min.js"></script>
    {{-- <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/apexcharts.min.js"></script> --}}
    <script>
        // [ operation-processed ] start
        $(function() {
            var options = {
                chart: {
                    height: 250,
                    type: 'area',
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                colors: ["#ff5252", "#4680ff"],
                fill: {
                    type: 'solid',
                    opacity: 0.2,
                },
                markers: {
                    size: 3,
                    opacity: 0.9,
                    colors: "#fff",
                    strokeColor: ["#ff5252", "#4680ff"],
                    strokeWidth: 2,
                    hover: {
                        size: 7,
                    }
                },
                series: [{
                    name: 'Expense',
                    data: [40, 75, 20, 45, 30, 50, 30]
                }, {
                    name: 'Income',
                    data: [90, 40, 60, 20, 10, 0, 0]
                }],

                xaxis: {
                    type: 'datetime',
                    categories: ["2019\-01-19", "2019\-02-19", "2019\-03-19", "2019\-04-19", "2019\-05-19",
                        "2019\-06-19", "2019\-07-19"
                    ],
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#summary-chart"),
                options
            );
            chart.render();
        });
        // [ operation-processed ] end
        // [ proj-earning ] start
        $(function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 310,
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                colors: ["#fff"],
                plotOptions: {
                    bar: {
                        color: '#fff',
                        columnWidth: '60%',
                    }
                },
                fill: {
                    type: 'solid',
                    opacity: 1,
                },
                series: [{
                    data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63, 54, 25, 66,
                        41, 89, 63, 25, 44, 12, 36
                    ]
                }],
                xaxis: {
                    crosshairs: {
                        width: 1
                    },
                    labels: {
                        show: false,
                    },
                },
                yaxis: {
                    labels: {
                        style: {
                            color: '#fff',
                        }
                    },
                },
                grid: {
                    borderColor: '#ffffff85',
                    padding: {
                        bottom: 0,
                        left: 10,
                    }
                },
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return 'Total absent'
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#absent-chart"), options);
            chart.render();
        });
        // [ proj-earning ] end
        // Full calendar
        $(function() {
            $('#Eventcalendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '2018-08-12',
                editable: true,
                droppable: true,
                events: [{
                    title: 'All Day Event',
                    start: '2018-08-01',
                    borderColor: '#04a9f5',
                    backgroundColor: '#04a9f5',
                    textColor: '#fff'
                }, {
                    title: 'Long Event',
                    start: '2018-08-07',
                    end: '2018-08-10',
                    borderColor: '#f44236',
                    backgroundColor: '#f44236',
                    textColor: '#fff'
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2018-08-09T16:00:00',
                    borderColor: '#f4c22b',
                    backgroundColor: '#f4c22b',
                    textColor: '#fff'
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2018-08-16T16:00:00',
                    borderColor: '#3ebfea',
                    backgroundColor: '#3ebfea',
                    textColor: '#fff'
                }, {
                    title: 'Conference',
                    start: '2018-08-11',
                    end: '2018-08-13',
                    borderColor: '#1de9b6',
                    backgroundColor: '#1de9b6',
                    textColor: '#fff'
                }, {
                    title: 'Meeting',
                    start: '2018-08-12T10:30:00',
                    end: '2018-08-12T12:30:00'
                }, {
                    title: 'Lunch',
                    start: '2018-08-12T12:00:00',
                    borderColor: '#f44236',
                    backgroundColor: '#f44236',
                    textColor: '#fff'
                }, {
                    title: 'Happy Hour',
                    start: '2018-08-12T17:30:00',
                    borderColor: '#a389d4',
                    backgroundColor: '#a389d4',
                    textColor: '#fff'
                }, {
                    title: 'Birthday Party',
                    start: '2018-08-13T07:00:00'
                }, {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2018-08-28',
                    borderColor: '#a389d4',
                    backgroundColor: '#a389d4',
                    textColor: '#fff'
                }],
                drop: function() {
                    if ($('#drop-remove').is(':checked')) {
                        $(this).remove();
                    }
                }
            });
        });
    </script>
@endsection
@endsection
