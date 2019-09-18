@extends('layouts.tu')
@section('navbar')
    <nav class="navbar-mahasiswa navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="row">
                <ul class="navbar-nav padding-left-15">
                    <li><a class="nav-link" href="/tu/home">Home</a></li>
                    <li><a class="nav-link" href="/tu/ta2/administrasi/daftar_progress_summary">Progress Mahasiswa</a></li>
                    <li class="dropdown nav-link">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Kelas<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="/tu/ta2/kelas/add_kelas">Tambah Kelas</a></li>
                            <li><a class="nav-link" href="/tu/ta2/kelas/daftar_kelas">Tugas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown nav-link">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Seminar<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="/tu/ta2/seminar/pendaftar">Pendaftar</a></li>
                            <li><a class="nav-link" href="/tu/ta2/seminar/seminar">Terdaftar</a></li>
                            <li><a class="nav-link" href="/tu/ta2/seminar/lampiran_berita_acara_seminar">Berita Acara</a></li>
                        </ul>
                    </li>
                    <li class="dropdown nav-link">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sidang<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="/tu/ta2/sidang/pendaftar">Pendaftar</a></li>
                            <li><a class="nav-link" href="/tu/ta2/sidang/sidang">Terdaftar</a></li>
                            <li><a class="nav-link" href="/tu/ta2/sidang/berita_acara_sidang">Finalisasi</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link" href="/tu/ta2/finalisasi/list_finalisasi">Finalisasi</a></li>
                    <li><a class="nav-link" href="/tu/ta2/history/show_history">History</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection