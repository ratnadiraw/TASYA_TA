@extends('layouts.timta')
@section('navbar')
    <nav class="navbar-mahasiswa navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="row">
                <ul class="navbar-nav padding-left-15">
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta2/administrasi/pengumuman_umum">Pengumuman Umum</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta2/kelas/daftar_kelas">Kelas</a></li>
                    <li><a class="nav-link" href="/tim_ta/ta2/administrasi/daftar_progress_summary">Progress Mahasiswa</a></li>
                    <li class="dropdown nav-link">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Seminar<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="/tim_ta/ta2/seminar/pendaftar">Pendaftar</a></li>
                            <li><a class="nav-link" href="/tim_ta/ta2/seminar/seminar">Terdaftar</a></li>
                            <li><a class="nav-link" href="/tim_ta/ta2/seminar/lampiran_berita_acara_seminar">Berita Acara</a></li>
                        </ul>
                    </li>
                    <li class="dropdown nav-link">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sidang<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="/tim_ta/ta2/sidang/pendaftar">Pendaftar</a></li>
                            <li><a class="nav-link" href="/tim_ta/ta2/sidang/list_sidang">Terdaftar</a></li>
                            <li><a class="nav-link" href="/tim_ta/ta2/sidang/list_berita_acara">Finalisasi</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link" href="/tim_ta/ta2/history/show_history">History</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection