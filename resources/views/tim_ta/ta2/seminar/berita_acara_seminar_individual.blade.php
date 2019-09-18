@extends('layouts.ta2.timta')
@section('title')
    <title>Berita Acara Seminar | Tim TA</title>
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
               <h3>Lampiran Berita Acara Pelaksanaan Tugas Akhir 2</h3>
            </div>
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
                    <div class="col-md-9 col-xs-9">{{App\Http\Controllers\DateID::formatDateTime($data_summary->tanggal, false)}}</div>
                </div>
                <div class="row berita-acara-content-data">
                    <div class="col-md-3 col-xs-3">Catatan:</div>
                    <div class="col-md-9 col-xs-9">{{$berita_acara->catatan}}</div>
                </div>
                <div class="row berita-acara-content-data">
                    <div class="col-md-3 col-xs-3">Berita Acara Seminar:</div>
                    <div class="col-md-9 col-xs-9"><a href="/tim_ta/ta2/seminar/download_berita_acara/{{$berita_acara->berita_acara_id}}"> View document</a></div>
                </div>
                <div class="row berita-acara-content-data justify-content-center">
                    <div class="col-md-3 col-xs-3">Rekomendasi:</div>
                    @if ($data_summary->status_pendaftaran == 3)
                        <div class="col-md-9 col-xs-9"><span style="color:green"> Direkomendasikan 🗸 </span></div>
                    @else
                        <div class="col-md-9 col-xs-9"><span style="color:red"> Belum direkomendasikan ✕ </span></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
