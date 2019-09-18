{{--5--}}
@extends('layouts.ta1.mahasiswa')
@section('title')
    <title>TA1 | Ubah MoM Bimbingan</title>
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
            <div class="card-header"><h3>Ubah Bimbingan</h3></div>
            <div class="card-body">
                <form action="/mahasiswa/ta1/bimbingan/update_mom" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="mom-id" value="{{$MoM->id}}">
                    <p>Pembimbing: {{$pembimbing->nama}}</p>
                    <div class="form-group col-xs-6 gap">
                        <label for="dicussion">Hasil Diskusi</label>
                        <textarea name="discussion" class="form-control" id="discussion">{{$MoM->hasil_diskusi}}</textarea>
                    </div>
                    <div class="form-group col-xs-6 gap">
                        <label for="follow-up">Tindak Lanjut</label>
                        <textarea name="follow-up" class="form-control" id="follow-up">{{$MoM->tindak_lanjut}}</textarea>
                    </div>
                    <div class="form-group col-xs-6 gap">
                        <label for="next-bimbingan-date">Tanggal Bimbingan Selanjutnya</label>
                        <input name="next-bimbingan-date" type="date" class="form-control" id="next-bimbingan-date" value="{{$MoM->tangal_bimbingan_berikutnya}}">
                    </div>
                    @if (isset($MoM->komentar))
                        <div class="form-group col-xs-6 gap">
                            <label for="comment">Komentar</label>
                            <textarea name="comment" class="form-control" id="comment" readonly>{{$MoM->komentar}}</textarea>
                        </div>
                    @else
                    @endif
                    <div class="form-group col-xs-6">
                        <div class="row">
                            <div class="col-sm-1">
                                <button class="btn btn-primary align-self-center">Kembali</button>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary align-self-center">Simpan MoM Bimbingan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection