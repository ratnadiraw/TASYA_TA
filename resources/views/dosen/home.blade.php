@extends('layouts.dosen')
@section('title')
    <title>Home | Dosen</title>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h3>Selamat Datang, {{ Auth::user()->name }}</h3>
                <div class="row mt-4">
                    <div class="col-md-11">
                        <div class="card">
                            <div class="card-header">Petunjuk Pengisian Topik</div>

                            <div class="card-body">
                                1.	Silakan menuliskan data topik/tema TA pada form. Satu tabel digunakan untuk 1 topik/tema TA dan sub-topik yang bersesuaian (boleh lebih dari satu). Dipersilakan untuk menambahkan tabel sebanyak topik/tema TA yang akan diajukan.
                                <br>
                                2.  Apabila pengisian form telah selesai, maka silahkan menekan tombol icon submit (dengan warna hijau) untuk mengirimkan topik/tema ke Tim TA
                                <br> <br>
                                Jika Anda menemukan kesulitan, keluhan ataupun saran anda dapat mengirimkan email di <a href="mailto:tasya@informatika.org?subject=Feedback Tasya">tasya@informatika.org</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">Daftar Menu</div>

                            <div class="card-body">

                                <div class="form-group row">
                                <div class="col-sm-4">
                                    <div class="row justify-content-center">
                                        <div class="btn btn-border btn-responsive menu-card">
                                            <a href="/dosen/ta1/topik">
                                                <img class="menu-card-icon" src="{{ asset('img/pengajuan_topik.png') }}" />
                                                <div class="font-button">
                                                    Input Topik
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="row justify-content-center">
                                        <div class="btn btn-border btn-responsive menu-card">
                                            <a href="/dosen/ta1/topikdosen">
                                                <img class="menu-card-icon" src="{{ asset('img/ta_1.png') }}" />
                                                <div class="font-button">
                                                    Seluruh Topik
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                    @if ($message==="timta")

                                    <div class="col-sm-4">
                                            <div class="row justify-content-center">
                                                <div class="btn btn-border btn-responsive menu-card">
                                                    <a href="/dosen/ta1/alltopikdosen">
                                                        <img class="menu-card-icon" src="{{ asset('img/progress_summary.png') }}" />
                                                        <div class="font-button">
                                                            Finalisasi Topik
                                                        </div>
                                                    </a>
                                                </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                    {{--<div class="col-md-4 text-center">--}}
                        {{--<div class="row justify-content-center">--}}
                            {{--<div class="btn btn-border btn-responsive menu-card">--}}
                                {{--<a href="/dosen/ta1/home">--}}
                                    {{--<img class="menu-card-icon" src="{{ asset('img/ta_1.png') }}" />--}}
                                    {{--<div class="font-button">--}}
                                        {{--Tugas Akhir 1--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4 text-center">--}}
                        {{--<div class="row justify-content-center">--}}
                            {{--<div class="btn btn-border btn-responsive menu-card">--}}
                                {{--<a href="/dosen/ta2/home">--}}
                                    {{--<img class="menu-card-icon" src="{{ asset('img/ta_2.png') }}"/>--}}
                                    {{--<div class="font-button">--}}
                                        {{--Tugas Akhir 2--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
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
                    <div class="card-body scrollable">
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