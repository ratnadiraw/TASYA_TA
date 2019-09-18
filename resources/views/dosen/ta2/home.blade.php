@extends('layouts.ta2.dosen')
@section('title')
    <title>TA2 | Home Dosen</title>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h3>
                    Menu Tugas Akhir 2
                    <br>
                    @php
                        $semester = session('tahun_semester')->semester;
                        $tahun = session('tahun_semester')->tahun;
                    @endphp
                    @if (isset($tahun) && isset($semester))
                        Semester {{$semester}} Tahun Ajaran {{$tahun}}
                    @endif
                </h3>


            {{--Menu--}}
                <div class="row mt-4">
                    <div class="col-md-4 text-center">
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/dosen/ta2/progress_summary/list_progress_summary">
                                    <img class="menu-card-icon" src="{{ asset('img/progress_summary.png') }}" />
                                    <div class="font-button">
                                        Progress Mahasiswa
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/dosen/ta2/seminar/lampiran_berita_acara_seminar">
                                    <img class="menu-card-icon" src="{{ asset('img/jadwal_seminar.png') }}" />
                                    <div class="font-button">
                                        Berita Acara Seminar
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/dosen/ta2/history/show_history">
                                    <img class="menu-card-icon" src="{{ asset('img/jadwal_seminar.png') }}" />
                                    <div class="font-button">
                                        History
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/dosen/ta2/bimbingan/mahasiswa">
                                    <img class="menu-card-icon" src="{{ asset('img/pengajuan_topik.png') }}"/>
                                    <div class="font-button">
                                        Bimbingan Mahasiswa
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/dosen/ta2/sidang/sidang">
                                    <img class="menu-card-icon" src="{{ asset('img/pengajuan_topik.png') }}"/>
                                    <div class="font-button">
                                        Sidang - Sebagai Dosen Pembimbing
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 text-center">
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/dosen/ta2/seminar/list_seminar">
                                    <img class="menu-card-icon" src="{{ asset('img/jadwal_seminar.png') }}" />
                                    <div class="font-button">
                                        Jadwal Seminar Mahasiswa Bimbingan
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/dosen/ta2/sidang/sidang_penguji">
                                    <img class="menu-card-icon" src="{{ asset('img/pengajuan_topik.png') }}"/>
                                    <div class="font-button">
                                        Sidang - Sebagai Dosen Penguji
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