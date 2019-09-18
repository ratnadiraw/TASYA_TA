<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	<style type="text/css">
		#content {
			height: 842px;
			width: 650px;
		}

		#logo {
			margin-top: 7px;
			float: left;
			width: 70px;
			height: 90px;
			background : url("{{public_path()}}/img/logo_itb.jpg");
			margin-left: 10px;
		}

		#header {
			padding-top: 10px;
			width: 570px;
			text-align: center;
			padding-bottom: 10px;
		}

		#line {
			width: 650px;
			height: 2px;
			background-color: black;
			position: absolute;
			top: 110px;
		}

		#prodi {
			margin-top : 15px;
			text-align: right;
			font-size: 11px;
			width: 200px;
		}
		#isi {
			margin-top: 10px;
			width: 650px;
			text-align: justify;
		}
		ol {
			margin-left: -15px;
			font-size: 14px;
		}
		#ttd {
			margin-left: 420px;
			width: 250px;
			font-size: 14px;
			margin-top : 30px;
		}
		table {
			border: none;
			font-size: 14px;
		}
		#judul {
			margin-top: 20px;
			text-align: center;
			font-size: 16px;
		}
	</style>
</head>
<body>
	<div id="content">
		<div id="logo"></div>
		<div id="header">
			<span style="font-size: 24px;">INSTITUT TEKNOLOGI BANDUNG</span><br>
			<span style="font-size: 16px;">SEKOLAH TEKNIK ELEKTRO DAN INFORMATIKA</span><br>
			<span style="font-size: 11px;">
				Jl. Ganesha 10, Gedung Achmad Bakrie, Labtek VIII Lantai 2, Bandung 40132; Telp: +6222 2502260<br>
				IP Phone: +6222 4254028, Fax: +6222 2534222, e-mail: stei@stei.itb.ac.id http://www.stei.itb.ac.id
			</span>
			<br>
		</div>
		<div id="line"></div>
		<div id="prodi">
			<strong>Program Studi<br>
			Teknik Informatika <br></strong>
			Labtek V. Lt. 2
			Telp: +6222 2508135, 2508136<br>
			Fax: +6222 2500940 
		</div>
		<div id="judul">
			<b><u>SURAT TUGAS</u></b><br>
			No : {{$kop_surat}}
		</div>
		<div id="isi">
			<span style="font-size: 14px;">
				Program Studi Teknik Informatika, Sekolah Teknik Elektro dan Informatika, Institut Teknologi Bandung, dalam rangka Pelaksanaan Bimbingan Tugas Akhir Program Sarjana Teknik Informatika menugaskan :<br>
				<ol>
					<?php $i = 1; ?>
					@foreach($dosbings as $dosbing)
					<li>{{$dosbing->nama}} sebagai Pembimbing {{$i}}</li>
					<?php $i++; ?>
					@endforeach
				</ol>
				dari mahasiswa :<br>
				<table>
					<tr>
						<td> Nama </td>
						<td> : </td>
						<td> {{$nama_mahasiswa}} </td>
					</tr>
					<tr>
						<td> NIM </td>
						<td> : </td>
						<td> {{$nim_mahasiswa}} </td>
					</tr>
					<tr>
						<td> Judul TA </td>
						<td> : </td>
						<td> {{$topik}} </td>
					</tr>
				</table>
				
				dengan tugas utama sebagai berikut :<br>
				<ol>
					<li>
						Membimbing pelaksanaan Tugas Akhir untuk mahasiswa bimbingannya, terutama dari sisi materi Tugas Akhir, penulisan proposal Tugas Akhir, Dokumen Tugas Akhir dan dokumen teknis lain (jika ada),
					</li>
					<li>
						Memberikan persetujuan pelaksanaan Seminar Tugas Akhir I, Seminar Tugas Akhir II dan Sidang untuk mahasiswa bimbingannya berdasarkan kemajuan Tugas Akhir yang dicapai mahasiswa tersebut, termasuk menyetujui penundaannya apabila kemajuan Tugas Akhir mahasiswa tersebut mencapai target,
					</li>
					<li>
						Memastikan mahasiswa bimbingan dapat melaksanakan Seminar Tugas Akhir I, Seminar Tugas Akhir 2 dan Sidang pada jadwal yang telah ditetapkan.
					</li>
					<li>
						Apabila mengalami kesulitan komunikasi dengan mahasiswa bimbingan, dimohon menghubungi dosen Koordinator Tugas Akhir,
					</li>
					<li>
						Bilamana diperlukan, Pembimbing dapat merekomendasikan penggantian topik atau pembimbing,
					</li>
				</ol>
				Dengan masa berlaku : sejak tanggal ditetapkan surat tugas ini sampai dengan selesai Tugas Akhir.
			</span>
		</div>
		<div id="ttd">
			Bandung, {{ $tanggal_terbit }}<br>
			Ketua
			<br>
			<br>
			<br>
			{{$nama_kaprodi}}<br>
			NIP : {{$nip_kaprodi}}
		</div>
	</div>
</body>
</html>