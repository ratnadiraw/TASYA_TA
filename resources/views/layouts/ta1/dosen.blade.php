@extends('layouts.dosen')
@section('navbar')
	<nav class="navbar-mahasiswa navbar navbar-expand-md navbar-light">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="row">
            	<ul class="navbar-nav padding-left-15">
				    <li><a class="nav-link" href="/dosen/ta1/administrasi/pengajuan_topik">Pengajuan Topik</a></li>
				    <li><a class="nav-link" href="/dosen/ta1/administrasi/pemilihan_mahasiswa_bimbingan">Pemilihan Mahasiswa Bimbingan</a></li>
				    <li><a class="nav-link" href="/dosen/ta1/administrasi/progress_summary">Progress Mahasiswa Bimbingan</a></li>
				    <li><a class="nav-link" href="/dosen/ta1/bimbingan/daftar_topik_bimbingan">Bimbingan Mahasiswa</a></li>
				    <li><a class="nav-link" href="/dosen/ta1/seminar/jadwal_seminar_pembimbing">Jadwal Seminar Pembimbing</a></li>
				    <li><a class="nav-link" href="/dosen/ta1/seminar/jadwal_seminar_penguji">Jadwal Seminar Penguji</a></li>
				</ul>
			</div>
		</div>
	</nav>
@endsection
