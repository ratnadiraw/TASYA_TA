@extends('layouts.ta2.timta')
@section('title')
    <title>Tambah Lampiran Berita Acara Seminar | Tim TA</title>
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
                Lampiran Berita Acara Pelaksanaan Tugas Akhir 2
            </div>
            <div class="card-body">
                <div class="berita-acara">
                    <form action="/tim_ta/ta2/seminar/add_lampiran_berita_acara_seminar_submit" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="seminar_id" value="{{$seminar->seminar_id}}">
                        <input type="hidden" name="berita_acara_id" value="{{$berita_acara->berita_acara_id}}">
                        <div class="berita-acara-content">
                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">Nama:</div>
                                <div class="col-md-9 col-xs-9"><b>{{$data_summary->nama}}</b></div>
                            </div>
                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">NIM:</div>
                                <div class="col-md-9 col-xs-9"><b>{{$data_summary->nim}}</b></div>
                            </div>
                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">Topik:</div>
                                <div class="col-md-9 col-xs-9"><b>{{$data_summary->topik}}</b></div>
                            </div>
                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">Waktu:</div>
                                <div class="col-md-9 col-xs-9">{{$data_summary->tanggal}}</div>
                            </div>
                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">Catatan:</div>
                                <div class="col-md-9 col-xs-9"><textarea type="text" name="catatan" class="form-control" id="catatan" placeholder="Isi catatan">{{$berita_acara->catatan}}</textarea></div>
                            </div>
                            <div class="row berita-acara-content-data justify-content-center">
                                Rekomendasi?
                            </div>
                            <div class="row berita-acara-content-data justify-content-center">
                                <button type="submit" class="btn btn-primary btn-margin" name="lulus" value="1">Rekomendasi</button>
                                <button type="Submit" class="btn btn-secondary btn-margin" name="lulus" value="0">Tidak Rekomendasi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
