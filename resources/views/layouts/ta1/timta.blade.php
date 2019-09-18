@extends('layouts.timta')
@section('navbar')
    <nav class="navbar-mahasiswa navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="row">
                <ul class="navbar-nav" style="padding-left: 15px;">
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta1/administrasi/daftar_progress_summary">Daftar Progress Mahasiswa</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta1/administrasi/daftar_mahasiswa_bimbingan">Finalisasi Mahasiswa Bimbingan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta1/administrasi/daftar_topik">Daftar Final Topik</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta1/administrasi/pengumuman_umum">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta1/administrasi/nilai_akhir">Nilai Akhir</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta1/seminar/jadwal_seminar">Jadwal Seminar</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta1/administrasi/tugas">Tugas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tim_ta/ta1/administrasi/history">Riwayat</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endsection