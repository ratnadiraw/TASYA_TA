@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>MoM Bimbingan | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-8 edit-mom">
                <div class="card-header"><h3>Minutes of Meeting Bimbingan Tugas Akhir</h3></div>
                <div class="card-body">
                    <form action="/mahasiswa/ta2/edit_bimbingan_submit" enctype="multipart/form-data" method="POST" class="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="bimbingan_id" value="{{$bimbingan->bimbingan_id}}">
                        <div class="add-bimbingan-content">
                            <div class="add-bimbingan-content-field font-weight-bold">
                                NIM/NAMA: {{$mahasiswa->nim}}/{{$mahasiswa->nama}}
                            </div>
                            <div class="row">
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    Pembimbing:
                                </div>
                                {{--<div class="dropdown">--}}
                                    {{--<select name="dosen_pembimbing_id">--}}
                                        {{--<option class = "dropdown-item" value="{{$current_dosen->user_id}}" selected hidden> {{$current_dosen->nama}}</option>--}}
                                        {{--@if(count($dosen_pembimbings) > 0)--}}
                                            {{--@foreach($dosen_pembimbings as $dosen_pembimbing)--}}
                                                {{--@if($dosen_pembimbing->user_id != $current_dosen->user_id)--}}
                                                    {{--<option class = "dropdown-item" value={{$dosen_pembimbing->user_id}}> {{$dosen_pembimbing->nama}}</option>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                <div class="form-check">
                                    @if(count($dosen_pembimbings) > 0)
                                        @foreach($dosen_pembimbings as $dosen_pembimbing)
                                            @if($dosen_pembimbing->user_id == $bimbingan->dosen_id)
                                                <input type="checkbox" id="checkbox{{$dosen_pembimbing->user_id}}" class="form-check-input" name="dosen_pembimbing_id[]" value="{{$dosen_pembimbing->user_id}}" checked>
                                            @elseif(!empty($bimbingan->dosen_id_2))
                                                @if($dosen_pembimbing->user_id == $bimbingan->dosen_id_2)
                                                    <input type="checkbox" id="checkbox{{$dosen_pembimbing->user_id}}" class="form-check-input" name="dosen_pembimbing_id[]" value="{{$dosen_pembimbing->user_id}}" checked>
                                                @else
                                                    <input type="checkbox" id="checkbox{{$dosen_pembimbing->user_id}}" class="form-check-input" name="dosen_pembimbing_id[]" value="{{$dosen_pembimbing->user_id}}">
                                                @endif
                                            @else
                                                <input type="checkbox" id="checkbox{{$dosen_pembimbing->user_id}}" class="form-check-input" name="dosen_pembimbing_id[]" value="{{$dosen_pembimbing->user_id}}">
                                            @endif
                                            <label class="form-check-label" for="checkbox{{$dosen_pembimbing->user_id}}">{{$dosen_pembimbing->nama}}</label>
                                            <br>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    Tanggal:
                                </div>
                                <input name="tanggal" type="date" id="tanggal"  width="276" value="{{$tanggal}}"/>
                            </div>
                            <div class="add-bimbingan-content-field font-weight-bold">
                                Hasil Diskusi :
                            </div>
                            <textarea name="hasil_diskusi" class="form-control" rows="5" id="diskusi" width="276" >{{$bimbingan->hasil_diskusi}}</textarea>
                            <div class="add-bimbingan-content-field font-weight-bold">
                                Rencana Tindak Lanjut :
                            </div>
                            <textarea name="tindak_lanjut" class="form-control" rows="5" id="tindak_lanjut" width="276" >{{$bimbingan->rencana_tindak_lanjut}}</textarea>
                        </div>
                        <input class="form-control btn-md btn-primary" type="submit" required >
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection