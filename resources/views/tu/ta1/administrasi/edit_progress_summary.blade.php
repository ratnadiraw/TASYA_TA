@extends('layouts.ta1.tu')
@section('title')
    <title>TA1 | Ubah Progress Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
        	<div class="col-sm-4">
        		<div class="card">
        			<div class="card-header"><h3>Profile</h3></div>
        			<div class="card-body">
        				<table class="table">
        					<tbody>
        						<tr>
        							<td>Name</td>
        							<td>{{$summary->nama}}</td>
        						</tr>
        						<tr>
        							<td>NIM</td>
        							<td>{{$summary->nim}}</td>
        						</tr>
        						<tr>
        							<td>Topik</td>
        							<td>{{$summary->nama_topik}}</td>
        						</tr>
        						<tr>
        							<td>Dosen Pembimbing</td>
        							<td>
		                                @if (count($dosens) > 0)
		                                    @foreach ($dosens as $dosen)
		                                        {{$dosen->nama}}<br/>
		                                    @endforeach
		                                @endif
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
		            </div>
		        </div>
		    </div>
		    <div class="col-sm-8">
		    	<div class="card">
		    		<div class="card-header"><h3>Progress Mahasiswa</h3></div>
		    		<div class="card-body">
                        <h4>Progress</h4>
                        <form action="/tu/ta1/administrasi/update_progress_summary/{{$summary->id}}" method="get" onsubmit="return confirm('Apakah Anda yakin ingin mengubah progress summary mahasiswa?');">
                        	<table class="table">
                        		<tbody>
                        			<tr>
                        				<td>Jumlah Kehadiran Kelas</td>
                        				<td>
                                            <input type="text" name="kehadiran_kelas" class="form-control" value="{{$summary->jumlah_kehadiran_kelas}}">
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>Jumlah Kehadiran Seminar</td>
                                    	<td>
                                            <input type="text" name="kehadiran_seminar" class="form-control" value="{{$summary->jumlah_kehadiran_seminar}}">
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>Jumlah Bimbingan</td>
                                        <td>{{$summary->jumlah_bimbingan}}</td>
                                    </tr>
                                    <tr>
                                    	<td>Laporan Seminar</td>
                                    	<td>
                                            @if ($summary->status_pengumpulan == 1)
                                                <input type="checkbox" name="laporan" checked>
                                            @else
                                                <input type="checkbox" name="laporan">
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                           	<button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                        <h4 style="margin-top: 32px;">Pendaftaran Seminar</h4>
                        <form action="/tu/ta1/administrasi/finalisasi_seminar" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mendaftarkan mahasiswa untuk melakukan seminar?');">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" class="form-control" name="class-attendance" value="{{$summary->jumlah_kehadiran_kelas}}">
                        <input type="hidden" class="form-control" name="bimbingan-attendance" value="{{$summary->jumlah_bimbingan}}">
                        @if ($summary->status_pengumpulan == 1)
                            <input type="hidden" class="form-control" name="laporan" value="1">
                        @endif
                        <input type="hidden" class="form-control" name="ta-id" value="{{$summary->ta_id}}">
                        @if (isset($seminar) && $seminar->final == 0)
                            <button type="submit" class="btn btn-primary">Daftarkan</button>
                        @elseif (isset($seminar) && $seminar->final != 0)
                            Mahasiswa sudah didaftarkan seminar.
                        @else
                            Mahasiswa belum didaftarkan seminar.
                        @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection