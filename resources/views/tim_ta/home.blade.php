@extends('layouts.timta')
@section('title')
    <title>Home Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
            <h3>Selamat Datang, {{ Auth::user()->name }}</h3>
            <div class="row mt-4">
                <div class="col-md-4 text-center">
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tim_ta/ta1/home">
                                <img class="menu-card-icon" src="{{ asset('img/ta_1.png') }}" />
                                <div class="font-button">
                                    Tugas Akhir 1
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tim_ta/tahun_ajaran">
                                <img class="menu-card-icon" src="{{ asset('img/jadwal_seminar.png') }}" />
                                <div class="font-button">
                                    Tahun Ajaran
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tim_ta/ta2/home">
                                <img class="menu-card-icon" src="{{ asset('img/ta_2.png') }}" />
                                <div class="font-button">
                                    Tugas Akhir 2
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tim_ta/agenda">
                                <img class="menu-card-icon" src="{{ asset('img/pendaftaran_agenda.png') }}"/>
                                <div class="font-button">
                                    Agenda
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Pengumuman Tugas Akhir 1
                    </div>
                    <div class="card-body scrollable">
                        @if (count($listOfPengumumanTA1) > 0)
                            @foreach($listOfPengumumanTA1 as $pengumuman)
                                <a href="/ta1/pengumuman/{{$pengumuman->id}}"><h5>{{$pengumuman->judul}}</h5></a>
                                <p>On: <i>{{App\Http\Controllers\DateID::formatDate($pengumuman->tanggal_mulai, true)}}</i></p>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Pengumuman Tugas Akhir 2
                    </div>
                    <div class="card-body">
                        @if (count($listOfPengumumanTA2) > 0)
                            @foreach($listOfPengumumanTA2 as $pengumuman)
                                <a href="/ta2/pengumuman/{{$pengumuman->id}}"><h5>{{$pengumuman->judul}}</h5></a>
                                <p>On: <i>{{App\Http\Controllers\DateID::formatDate($pengumuman->tanggal_mulai, true)}}</i></p>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Kalender
                    </div>
                    <div class="card-body">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    {!! $calendar->script() !!}
@endsection