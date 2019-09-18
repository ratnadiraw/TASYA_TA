{{--5--}}
@extends('layouts.ta1.mahasiswa')
@section('title')
    <title>TA1 | Progress Mahasiswa</title>
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
            <div class="card-header"><h3>Lihat MoM</h3></div>
            <div class="card-body">
                <p>Pembimbing : {{$pembimbing->nama}}</p>
                <form>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="mom-id" value="{{$MoM->id}}">
                    <div class="form-group col-xs-6 mt-4">
                        <label for="dicussion">Hasil Diskusi</label>
                        <textarea name="discussion" class="form-control" id="discussion" readonly>{{$MoM->hasil_diskusi}}</textarea>
                    </div>
                    <div class="mt-2">
                        <label for="follow-up">Tindak Lanjut</label>
                        <textarea name="follow-up" class="form-control" id="follow-up" readonly>{{$MoM->tindak_lanjut}}</textarea>
                    </div>
                    <div class="mt-2">
                        <label for="next-bimbingan-date">Tanggal Bimbingan Selanjutnya</label>
                        <input name="next-bimbingan-date" type="date" class="form-control" id="next-bimbingan-date" value="{{$MoM->tangal_bimbingan_berikutnya}}" readonly>
                    </div>
                    @if (isset($MoM->komentar))
                        <div class="form-group col-xs-6 mt-2">
                            <label for="dicussion">Komentar</label>
                            <textarea name="comment" class="form-control" id="comment" readonly>{{$MoM->komentar}}</textarea>
                        </div>
                    @else
                    @endif
                </form>
            </div>
        </div>
        <a href="{{ URL::previous() }}">
            <div class="btn btn-primary align-self-center">Kembali</div>
        </a>
    </div>
@endsection
