@extends('layouts.ta1.tu')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Pembuatan Surat Tugas</title>
@endsection
@section('content')
    <div class="container">
        @if (isset($tahun) && isset($semester))
            <h3>Tugas Akhir 1 Semester {{$semester}} Tahun Ajaran {{$tahun}}</h3>
        @endif
        <h3>Daftar Tugas Akhir</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/tu/ta1/administrasi/save_surat_tugas/{{$taid}}" method="post">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-3">
                            <label>ID TA</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="ta_id" class="form-control" value="{{$taid}}" disabled readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Nomor Kop Surat</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="kop_surat" class="form-control" @if($surattugas != null) value="{{$surattugas->nomor_kop_surat}}" @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Tanggal Terbit</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="tanggal_terbit" class="form-control" @if($surattugas != null) value="{{$surattugas->tanggal_terbit}}" @endif>
                        </div>
                    </div>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>

        @if ($surattugas != null)
        <form action="/tu/ta1/administrasi/cetak_surat_tugas/{{$surattugas->id}}">
            <button type="submit" class="btn btn-success">Cetak Surat Tugas</button>
        </form>
        @endif
    </div>
@endsection