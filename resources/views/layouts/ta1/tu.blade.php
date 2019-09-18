@extends('layouts.tu')

@section('navbar')
    <nav class="navbar-mahasiswa navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="row">
                <ul class="navbar-nav navbar-mahasiswa" style="padding-left: 15px;">
                    <li><a class="nav-link" href="/tu/home">Home</a></li>
                    <li><a class="nav-link" href="/tu/ta1/administrasi/daftar_progress_summary">Daftar Progress Mahasiswa</a></li>
                    <li><a class="nav-link" href="/tu/ta1/administrasi/daftar_surat_tugas">Daftar Surat Tugas</a></li>

                    <li><a class="nav-link" href="/tu/ta1/seminar/seminar">Seminar</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
@endsection