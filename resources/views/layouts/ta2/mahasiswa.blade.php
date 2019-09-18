@extends('layouts.mahasiswa')
@section('navbar')
    <nav class="navbar-mahasiswa navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="row">
                <ul class="navbar-nav padding-left-15">
                    <li><a class="nav-link" href="/mahasiswa/ta2/view_progress_summary">Administrasi</a></li>
                    <li><a class="nav-link" href="/mahasiswa/ta2/kelas">Kelas</a></li>
                    <li><a class="nav-link" href="/mahasiswa/ta2/bimbingan">Bimbingan</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection