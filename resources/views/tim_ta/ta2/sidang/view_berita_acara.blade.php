@extends('layouts.ta2.timta')
@section('title')
    <title>Lampiran Berita Acara Sidang | Tim TA</title>
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
                Lampiran Berita Acara Sidang
            </div>
            <div class="card-body">
                <div class="berita-acara">
                    <form action="/tim_ta/ta2/sidang/view_berita_acara_submit" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="sidang_id" value="{{$sidang->sidang_id}}">
                        <input type="hidden" name="bas_id" value="{{$berita_acara->bas_id}}">
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
                                <div class="col-md-3 col-xs-3">Nilai Keseluruhan: </div>
                                <div class="col-md-9 col-xs-9">{{$berita_acara->nilai}}</div>
                            </div>

                            {{--file--}}
                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">File berita acara sidang:</div>
                                <div class="col-md-9 col-xs-9">
                                    @if ($berita_acara->berita_acara != null)
                                        <a href="/tim_ta/ta2/sidang/download_berita_acara/{{$berita_acara->bas_id}}"> View Document </a>
                                    @endif
                                </div>
                            </div>

                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">File finalisasi sidang:</div>
                                <div class="col-md-9 col-xs-9">
                                    @if ($berita_acara->lembar_finalisasi != null)
                                        <a href="/tim_ta/ta2/sidang/download_lembar_finalisasi/{{$berita_acara->bas_id}}"> View Document </a>
                                    @endif
                                </div>
                            </div>

                            {{--end bagian file--}}

                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">Catatan : </div>
                                <div class="col-md-9 col-xs-9"><textarea type="text" name="catatan" class="form-control" id="catatan" placeholder="Isi catatan">{{$berita_acara->catatan}}</textarea></div>
                            </div>

                            <div class="row berita-acara-content-data justify-content-center">
                                <button type="submit" class="btn btn-primary btn-margin" name="lulus" value="1"> Final</button>
                                <button type="Submit" class="btn btn-secondary btn-margin" name="lulus" value="0"> Belum </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection