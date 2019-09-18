@extends('layouts.tu')
@section('title')
    <title>TA2 | Home TU</title>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h3>Menu Tugas Akhir 2</h3>
                <div class="row mt-4">
                    <div class="col-md-4 text-center">
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tu/ta2/administrasi/daftar_progress_summary">
                                    <img class="menu-card-icon" src="{{ asset('img/progress_summary.png') }}"/>
                                    <div class="font-button">
                                        Progress Mahasiswa
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tu/ta2/seminar/pendaftar">
                                    <img class="menu-card-icon" src="{{ asset('img/pendaftaran_dosen.png') }}" />
                                    <div class="font-button">
                                        Lihat pendaftar seminar
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tu/ta2/sidang/pendaftar">
                                    <img class="menu-card-icon" src="{{ asset('img/pendaftaran_dosen.png') }}" />
                                    <div class="font-button">
                                        Lihat pendaftar sidang
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="btn btn-border btn-responsive menu-card">
                            <a href="/tu/ta2/administrasi/unduh_dokumen">
                                <img class="menu-card-icon" src="{{ asset('img/tambah_tugas.png') }}" />
                                <div class="font-button">
                                    Unduh Dokumen Seminar dan Sidang
                                </div>
                            </a>
                        </div>

                    </div>
                    <div class="col-md-4 text-center">
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tu/ta2/kelas/daftar_kelas">
                                    <img class="menu-card-icon" src="{{ asset('img/tambah_tugas.png') }}" />
                                    <div class="font-button">
                                        Administrasi Tugas TA
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tu/ta2/seminar/seminar">
                                    <img class="menu-card-icon" src="{{ asset('img/jadwal_seminar.png') }}" />
                                    <div class="font-button">
                                        Jadwal Seminar TA 2
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tu/ta2/sidang/sidang">
                                    <img class="menu-card-icon" src="{{ asset('img/jadwal_seminar.png') }}" />
                                    <div class="font-button">
                                        Jadwal Sidang
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tu/ta2/kelas/add_kelas">
                                    <img class="menu-card-icon" src="{{ asset('img/tambah_tugas.png') }}" />
                                    <div class="font-button">
                                        Tambah Kelas
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tu/ta2/seminar/lampiran_berita_acara_seminar">
                                    <img class="menu-card-icon" src="{{ asset('img/progress_summary.png') }}" />
                                    <div class="font-button">
                                        Isi lampiran berita acara seminar
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn btn-border btn-responsive menu-card">
                                <a href="/tu/ta2/sidang/berita_acara_sidang">
                                    <img class="menu-card-icon" src="{{ asset('img/progress_summary.png') }}" />
                                    <div class="font-button">
                                        Isi lampiran berita acara sidang
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