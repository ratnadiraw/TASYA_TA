{{--26--}}
@extends('layouts.ta1.dosen')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | MoM Bimbingan</title>
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
            <div class="card-header"><h3>MoM Mahasiswa Bimbingan</h3></div>
            <div class="card-body">
                <form action="/dosen/ta1/bimbingan/update_mom_bimbingan" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui/menolak MoM ini?');">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="ta-id" value="{{$taID}}">
                    <input type="hidden" name="mom-id" value="{{$MoM->id}}">
                    <div class="form-group col-xs-6 mt-2">
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
                    <div class="form-group col-xs-6 mt-2">
                        <label for="comment">Komentar</label>
                        <textarea name="comment" class="form-control" id="comment"></textarea>
                    </div>
                    <div class="form-group col-xs-6 mt-2">
                        <button type="submit" name="action" value="approve" class="btn btn-primary align-self-center">Setuju</button>
                        <button type="submit" name="action" value="decline" class="btn btn-danger align-self-center">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection