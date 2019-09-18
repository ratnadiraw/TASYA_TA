@extends('layouts.timta')
@section('title')
    <title>TA1 | Home Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
            <h3>
                Selamat Datang, {{ Auth::user()->name }} di menu Tugas Akhir 1
            </h3>
            <div class="row mt-4">
                <div class="col-md-4 text-center">
                    <div class="btn btn-border btn-responsive menu-card">
                        <a href="/tim_ta/ta1/administrasi/daftar_progress_summary">
                            <img class="menu-card-icon" src="{{ asset('img/progress_summary.png') }}" />
                            <div class="font-button">
                                Daftar Progress Mahasiswa
                            </div>
                        </a>
                    </div>
                    <div class="btn btn-border btn-responsive menu-card">
                        <a href="/tim_ta/ta1/administrasi/pengumuman_umum">
                            <img class="menu-card-icon" src="{{ asset('img/pengumuman.png') }}" />
                            <div class="font-button">
                                Pengumuman Umum
                            </div>
                        </a>
                    </div>
                    <div class="btn btn-border btn-responsive menu-card">
                        <a href="/tim_ta/ta1/administrasi/tugas">
                            <img class="menu-card-icon" src="{{ asset('img/tambah_tugas.png') }}" />
                            <div class="font-button">
                                Daftar Tugas
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tim_ta/ta1/administrasi/daftar_mahasiswa_bimbingan">
                                <img class="menu-card-icon" src="{{ asset('img/pemilihan_mahasiswa.png') }}" />
                                <div class="font-button">
                                    Finalisasi Mahasiswa Bimbingan
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tim_ta/ta1/seminar/jadwal_seminar">
                                <img class="menu-card-icon" src="{{ asset('img/jadwal_seminar.png') }}" />
                                <div class="font-button">
                                    Jadwal Seminar
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="btn btn-border btn-responsive menu-card">
                        <a href="/tim_ta/ta1/administrasi/history">
                            <img class="menu-card-icon" src="{{ asset('img/nilai_akhir.png') }}" />
                            <div class="font-button">
                                Riwayat
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="row justify-content-center">
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tim_ta/ta1/administrasi/daftar_topik">
                                <img class="menu-card-icon" src="{{ asset('img/pengajuan_topik.png') }}"/>
                                <div class="font-button">
                                    Daftar Final Topik
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tim_ta/ta1/administrasi/nilai_akhir">
                                    <img class="menu-card-icon" src="{{ asset('img/progress_summary.png') }}" />
                                    <div class="font-button">
                                        Finalisasi Nilai Akhir
                                    </div>
                                </a>
                            </div>
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