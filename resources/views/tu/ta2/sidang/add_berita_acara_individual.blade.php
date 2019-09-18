@extends('layouts.ta2.tu')
@section('title')
    <title>Tambah Berita Acara Sidang| TU</title>
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
                    <form action="/tu/ta2/sidang/add_berita_acara_individual_submit" method="POST" enctype="multipart/form-data">
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
                                <div class="col-md-3 col-xs-3">Nilai Akhir: </div>
                                <div class="col-md-9 col-xs-9"> <input type="text" name="nilai" value="{{$nilai}}"></div>
                            </div>

                            {{--file--}}
                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">File berita acara sidang:</div>
                                <div class="col-md-9 col-xs-9">
                                    @if ($berita_acara->berita_acara != null)
                                        <a href="/tu/ta2/sidang/download_berita_acara/{{$berita_acara->bas_id}}"> See previous upload </a>
                                    @endif
                                    <label for="file"> | Choose file to upload</label>
                                    <input type="file" id="file" name="file_berita_acara" value="{{$berita_acara->berita_acara}}">
                                </div>
                            </div>

                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">File finalisasi sidang:</div>
                                <div class="col-md-9 col-xs-9">
                                    @if ($berita_acara->lembar_finalisasi != null)
                                        <a href="/tu/ta2/sidang/download_lembar_finalisasi/{{$berita_acara->bas_id}}"> See previous upload </a>
                                    @endif
                                    <label for="file"> | Choose file to upload</label>
                                    <input type="file" id="file" name="file_lembar_finalisasi" value="{{$berita_acara->lembar_finalisasi}}">
                                </div>
                            </div>

                            {{--end bagian file--}}

                            <div class="row berita-acara-content-data">
                                <div class="col-md-3 col-xs-3">Catatan : </div>
                                <div class="col-md-9 col-xs-9"><textarea type="text" name="catatan" class="form-control" id="catatan" placeholder="Isi catatan">{{$berita_acara->catatan}}</textarea></div>
                            </div>

                            <div class="row berita-acara-content-data justify-content-center">
                                <button class="btn-primary" type="submit" name="button_berita_acara" value="1">
                                    Lulus
                                </button>

                                <button class="btn-danger" type="submit" name="button_berita_acara" value="0">
                                    Belum Lulus
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection