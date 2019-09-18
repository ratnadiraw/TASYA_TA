@extends('layouts.timta')
@section('title')
    <title>TA1 | Home Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
            <h3>
                Menu Tugas Akhir 2
            </h3>
            <div class="row mt-4">
                <div class="col-md-4 text-center">
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tim_ta/ta2/administrasi/pengumuman_umum">
                                <img class="menu-card-icon" src="{{ asset('img/pengumuman.png') }}" />
                                <div class="font-button">
                                    Pengumuman Umum
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tim_ta/ta2/kelas/daftar_kelas">
                                <img class="menu-card-icon" src="{{ asset('img/kelas.png') }}"/>
                                <div class="font-button">
                                    Kelas
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="btn btn-border btn-responsive menu-card">
                        <a href="/tim_ta/ta2/administrasi/daftar_progress_summary">
                            <img class="menu-card-icon" src="{{ asset('img/progress_summary.png') }}" />
                            <div class="font-button">
                                Progress Mahasiswa
                            </div>
                        </a>
                    </div>
                    <div class="row justify-content-center">
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tim_ta/ta2/seminar/pendaftar">
                                    <img class="menu-card-icon" src="{{ asset('img/seminar.png') }}" />
                                    <div class="font-button">
                                        Seminar
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="btn btn-border btn-responsive menu-card">
                        <a href="/tim_ta/ta2/sidang/pendaftar">
                            <img class="menu-card-icon" src="{{ asset('img/sidang.png') }}" />
                            <div class="font-button">
                                Sidang
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Pengumuman Tugas Akhir 2
                    </div>
                    <div class="card-body">
                        @if (count($listOfPengumumanTA2) > 0)
                            @foreach($listOfPengumumanTA2 as $pengumuman)
                                <a href="/ta2/pengumuman/{{$pengumuman->id}}"><h5>{{$pengumuman->judul}}</h5></a>
                                <p>On: <i>{{$pengumuman->tanggal_mulai}}</i></p>
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