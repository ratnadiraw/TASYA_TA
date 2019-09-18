@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Tambah Bimbingan | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-header"><h3>Minutes of Meeting Bimbingan Tugas Akhir</h3></div>
                    <div class="card-body">
                        <form action="/mahasiswa/ta2/add_bimbingan_submit" enctype="multipart/form-data" method="POST" class="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST">
                            <div class="add-bimbingan-content">
                                <div class="row add-bimbingan-content-field">
                                    <div class="col-md-3">
                                        NIM/NAMA:
                                    </div>
                                    <div class="col-md-9 font-weight-bold">
                                        {{$mahasiswa->nim}}/{{$mahasiswa->nama}}
                                    </div>
                                </div>
                                <div class="row add-bimbingan-content-field">
                                    <div class="col-md-3">
                                        Pembimbing:
                                    </div>
                                    <div class="form-check col-md-8">
                                        @if(count($dosen_pembimbings) > 0)
                                            @foreach($dosen_pembimbings as $dosen_pembimbing)
                                                <input type="checkbox" class="form-check-input" id="checkbox{{$dosen_pembimbing->user_id}}" name="dosen_pembimbing_id[]" value="{{$dosen_pembimbing->user_id}}">
                                                <label class="form-check-label" for="checkbox{{$dosen_pembimbing->user_id}}">{{$dosen_pembimbing->nama}}</label>
                                                <br>
                                            @endforeach
                                        @endif
                                    </div>
                                    {{--<div class="dropdown">--}}
                                    {{--<select name="dosen_pembimbing_id">--}}
                                    {{--@if(count($dosen_pembimbings) > 0)--}}
                                    {{--@foreach($dosen_pembimbings as $dosen_pembimbing)--}}
                                    {{--<option class = "dropdown-item" value={{$dosen_pembimbing->user_id}}> {{$dosen_pembimbing->nama}}</option>--}}
                                    {{--@endforeach--}}
                                    {{--@endif--}}
                                    {{--</select>--}}
                                    {{--</div>--}}

                                </div>
                                <div class="row add-bimbingan-content-field">
                                    <div class="col-md-3">
                                        Tanggal:
                                    </div>
                                    <div class="col-md-9">
                                        <input name="tanggal" type="date" id="tanggal"  width="276" />
                                    </div>
                                </div>
                                <div class="row add-bimbingan-content-field">
                                    <div class="col-md-3">
                                        Hasil Diskusi:
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="hasil_diskusi" class="form-control" rows="5" id="diskusi" width="276"></textarea>
                                    </div>
                                </div>
                                <div class="row add-bimbingan-content-field">
                                    <div class="col-md-3">
                                        Rencana Tindak Lanjut:
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="tindak_lanjut" class="form-control" rows="5" id="tindaklanjut" width="276"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input class="form-control btn-md btn-primary" type="submit" required >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection