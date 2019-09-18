@extends('layouts.app')
@section('title')
    <title>TA2 | Menu Mahasiswa</title>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h3>Menu Tugas Akhir 2</h3>
            <div class="row mt-4">
                <div class="col-sm-4 text-center">
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/mahasiswa/ta2/view_progress_summary">
                                <img class="menu-card-icon" src="{{ asset('img/progress_summary.png') }}" />
                                <div class="font-button">
                                    Administrasi
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-center">
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/mahasiswa/ta2/kelas">
                                <img class="menu-card-icon" src="{{ asset('img/kelas.png') }}" />
                                <div class="font-button">
                                    Kelas
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-center">
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/mahasiswa/ta2/bimbingan">
                                <img class="menu-card-icon" src="{{ asset('img/penambahan_bimbingan.png') }}" />
                                <div class="font-button">
                                    Bimbingan
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
                    Pengumuman Tugas Akhir 2
                </div>
                <div class="card-body scrollable">
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