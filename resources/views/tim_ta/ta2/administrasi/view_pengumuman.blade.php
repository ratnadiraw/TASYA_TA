@extends('layouts.app')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp

@section('title')
    <title>Daftar Pengumuman | Tim TA</title>
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

        @if (isset($tahun) && isset($semester))
            <h3>Tugas Akhir 2 Semester {{$semester}} Tahun Ajaran {{$tahun}}</h3>
        @endif

        <div class="card mt-4">
            <div class="card-header"><h3>Pengumuman</h3></div>
            <div class="card-body">
                <h4 class="align-self-center">{{$pengumuman->judul}}</h4>
                {{$pengumuman->konten}}
            </div>
            <div class="card-footer">
                Start <i>{{$pengumuman->tanggal_mulai}}</i>
                End <i>{{$pengumuman->tanggal_berakhir}}</i>
            </div>
        </div>
    </div>
@endsection