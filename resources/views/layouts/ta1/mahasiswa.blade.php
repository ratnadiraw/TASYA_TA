@extends('layouts.mahasiswa')
@section('navbar')
    <nav class="navbar-mahasiswa navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="row">
                <ul class="navbar-nav navbar-mahasiswa" style="padding-left: 15px;">
                    <li><a class="nav-link" href="/mahasiswa/ta1/administrasi/topik">Pemilihan Topik</a></li>
                    <li><a class="nav-link" href="/mahasiswa/ta1/administrasi/progress_summary">Progress Mahasiswa</a></li>
                    <li><a class="nav-link" href="/mahasiswa/ta1/bimbingan/daftar_bimbingan">Administrasi Bimbingan</a></li>
                    <li><a class="nav-link" href="/mahasiswa/ta1/seminar/jadwal_seminar">Seminar</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection