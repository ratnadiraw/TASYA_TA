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
		#judulta {
			width: 100%;
			text-align: center;
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
			No : {{$kop_surat}}<br>
			tentang<br>
			Seminar Tugas Akhir I
		</div>
		<div id="isi">
			<span style="font-size: 14px;">
				Disesuaikan dengan permintaan Pembimbing Tugas Akhir :<br>
				<span style="margin-left: 20px;">
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
					</table>
				</span><br>
				yang telah melaksanakan Tugas Akhir I pada Semester {{$semester}} dengan judul : <br>
				<br>
				<div id="judulta">
					<i>{{$judul}}</i>
				</div>
				<br>
				maka dengan ini ditetapkan oleh Program Studi Teknik Informatika, Panitia Seminar Tugas Akhir I yang bersangkutan dengan susunan sebagai berikut : <br>
				<table>
					@if ($pembimbing2 == null)
					<tr>
						<td>Pembimbing</td>
						<td>:</td>
						<td>{{$pembimbing1}}</td>
					</tr>
					@else
					<tr>
						<td>Pembimbing I</td>
						<td>:</td>
						<td>{{$pembimbing1}}</td>
					</tr>
					<tr>
						<td>Pembimbing II</td>
						<td>:</td>
						<td>{{$pembimbing2}}</td>
					</tr>
					@endif
					@if ($penguji2 == null)
					<tr>
						<td>Penguji</td>
						<td>:</td>
						<td>{{$penguji1}}</td>
					</tr>
					@else
					<tr>
						<td>Penguji 1</td>
						<td>:</td>
						<td>{{$penguji1}}</td>
					</tr>
					<tr>
						<td>Penguji 2</td>
						<td>:</td>
						<td>{{$penguji2}}</td>
					</tr>
					@endif
				</table>
				<br>
				Waktu pelaksanaan Seminar Tugas Akhir I pada hari Kamis, waktu seminar sepenuhnya diserahkan kepada Pembimbing.<br>
				Demikian Surat Tugas ini dibuat untuk dapat dipergunakan sebagaimana mestinya.				
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