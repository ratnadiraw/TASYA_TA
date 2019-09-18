@extends('layouts.ta2.dosen')
@section('title')
    <title>View Berita Acara Sidang| Dosen</title>
@endsection
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Lampiran Finalisasi TA 2
            </div>
            <div class="card-body">
                <div class="berita-acara">
                    <div class="berita-acara-content">
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">Nama : </div>
                            <div class="col-md-9 col-xs-9"><b>{{$data_summary->nama}}</b></div>
                        </div>
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">NIM : </div>
                            <div class="col-md-9 col-xs-9"><b>{{$data_summary->nim}}</b></div>
                        </div>
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">Judul : </div>
                            <div class="col-md-9 col-xs-9"><b>{{$data_summary->judul}}</b></div>
                        </div>
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">Waktu : </div>
                            <div class="col-md-9 col-xs-9">{{App\Http\Controllers\DateID::formatDateTime($data_summary->tanggal, false)}}</div>
                        </div>


                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">Nilai Akhir: </div>
                            <div class="col-md-9 col-xs-9">{{$berita_acara->nilai}}</div>
                        </div>

                        {{--file--}}
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">File berita acara sidang:</div>
                            <div class="col-md-9 col-xs-9">
                                @if ($berita_acara->berita_acara != null)
                                    <a href="/dosen/ta2/sidang/download_berita_acara/{{$berita_acara->bas_id}}"> View berita acara sidang </a>
                                @endif
                            </div>
                        </div>

                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">File finalisasi sidang:</div>
                            <div class="col-md-9 col-xs-9">
                                @if ($berita_acara->lembar_finalisasi != null)
                                    <a href="/dosen/ta2/sidang/download_lembar_finalisasi/{{$berita_acara->bas_id}}"> View lembar finalisasi </a>
                                @endif
                            </div>
                        </div>

                        {{--end bagian file--}}



                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">Catatan : </div>
                            <div class="col-md-9 col-xs-9">{{$berita_acara->catatan}}</div>
                        </div>

                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3"> Verdict Kelulusan : </div>
                            @if($berita_acara->status_lulus == 1)
                                <div class="col-md-9 col-xs-9"><span style="color:green"> Dinyatakan lulus 🗸 </span></div>
                            @else
                                <div class="col-md-9 col-xs-9"><span style="color:red"> Belum dinyatakan lulus ✕ </span></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection