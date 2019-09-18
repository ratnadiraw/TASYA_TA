@extends('layouts.dosen')
@section('navbar')
    <nav class="navbar-mahasiswa navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="row">
                <ul class="navbar-nav padding-left-15">
                    <li><a class="nav-link" href="/dosen/ta2/progress_summary/list_progress_summary">Progress Mahasiswa</a></li>
                    <li><a class="nav-link" href="/dosen/ta2/bimbingan/mahasiswa">Bimbingan Mahasiswa</a></li>
                    <li class="dropdown nav-link">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Seminar<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="/dosen/ta2/seminar/list_seminar">Jadwal Seminar Mahasiswa Bimbingan</a></li>
                            <li><a class="nav-link" href="/dosen/ta2/seminar/lampiran_berita_acara_seminar">Berita Acara</a></li>
                        </ul>
                    </li>
                    <li class="dropdown nav-link">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sidang<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="/dosen/ta2/sidang/sidang">Sebagai Dosen Pembimbing</a></li>
                            <li><a class="nav-link" href="/dosen/ta2/sidang/sidang_penguji">Sebagai Dosen Penguji</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link" href="/dosen/ta2/history/show_history">History</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection
