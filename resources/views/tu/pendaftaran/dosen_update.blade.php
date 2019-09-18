@extends('layouts.tu')
@section('title')
    <title>Ubah Dosen</title>
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
            <div class="card-header"><h3>Ubah Data Dosen</h3></div>
            <div class="card-body">
                <form action="/tu/pendaftaran/updatedosen/{{$dosen->user_id}}" method="POST">
                    <div class="row">     
                        <div class="col-md-7">      
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{$dosen->nama}}">
                            </div>
                            <div class="form-group">
                                <label for="NIP">NIP:</label>
                                <input name="NIP" type="text" class="form-control" id="NIP" value="{{$dosen->nip}}">
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label for="kk">Kelompok Keahlian:</label>--}}
                                {{--<select name="kk" class="form-control" id="kk">--}}
                                    {{--<option value="" @if($dosen->kelompok_keahlian == '') selected @endif>Kelompok Keahlian</option>--}}
                                    {{--<option value="Rekayasa Perangkat Lunak dan Data" @if($dosen->kelompok_keahlian == 'Rekayasa Perangkat Lunak dan Data') selected @endif>Rekayasa Perangkat Lunak & Data</option>--}}
                                    {{--<option value="Grafika dan Intelegensia Buatan" @if($dosen->kelompok_keahlian == 'Grafika dan Intelegensia Buatan') selected @endif>Grafika dan Intelegensia Buatan</option>--}}
                                    {{--<option value="Ilmu Rekayasa Komputasi" @if($dosen->kelompok_keahlian == 'Ilmu Rekayasa Komputasi') selected @endif >Ilmu Rekayasa Komputasi</option>--}}
                                    {{--<option value="Sistem Terdistribusi" @if($dosen->kelompok_keahlian == 'Sistem Terdistribusi') selected @endif>Sistem Terdistribusi</option>--}}
                                    {{--<option value="Sistem Informasi" @if($dosen->kelompok_keahlian == 'Sistem Informasi') selected @endif>Sistem Informasi</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label for="inisial">Inisial:</label>
                                <input name="inisial" type="text" class="form-control" id="inisial" value="{{$dosen->inisial}}">
                            </div>
                            <div class="form-group">
                                <label for="wewenang-pembimbing">Wewenang Pembimbing:</label>
                                    <select name="wewenang-pembimbing" class="form-control" id="wewenang-pembimbing">
                                        <option value="" disabled selected>Wewenang</option>
                                        <option value="0" @if($dosen->wewenang_pembimbing == 0) selected @endif >Belum Bisa</option>
                                        <option value="1" @if($dosen->wewenang_pembimbing == 1) selected @endif >Pembimbing I</option>
                                        <option value="2" @if($dosen->wewenang_pembimbing == 2) selected @endif >Pembimbing II</option>
                                    </select>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{$dosen->email}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary align-self-center">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
