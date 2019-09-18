@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Lampiran Berita Acara Seminar | Mahasiswa</title>
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
                Lampiran Berita Acara Seminar Pelaksanaan Tugas Akhir 2
            </div>
            <div class="card-body">
                <div class="berita-acara">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="seminar_id" value="{{$seminar->seminar_id}}">
                    <input type="hidden" name="berita_acara_id" value="{{$berita_acara->berita_acara_id}}">
                    <div class="berita-acara-content">
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">Nama:</div>
                            <div class="col-md-9 col-xs-9"><b>{{$mahasiswa->nama}}</b></div>
                        </div>
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">NIM:</div>
                            <div class="col-md-9 col-xs-9"><b>{{$mahasiswa->nim}}</b></div>
                        </div>
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">Topik:</div>
                            <div class="col-md-9 col-xs-9"><b>{{$seminar->topik}}</b></div>
                        </div>
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">Waktu:</div>
                            <div class="col-md-9 col-xs-9">{{$seminar->tanggal}}</div>
                        </div>
                        <div class="row berita-acara-content-data">
                            <div class="col-md-3 col-xs-3">Catatan:</div>
                            <div class="col-md-9 col-xs-9">{{$berita_acara->catatan}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection