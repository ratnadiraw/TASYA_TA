{{--5--}}
@extends('layouts.ta1.mahasiswa')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Tambah Bimbingan</title>
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
		<div class="card">
    			<div class="card-header"><h3>Penambahan Bimbingan</h3></div>
        		<div class="card-body">
			        <form action="/mahasiswa/ta1/bimbingan/save_bimbingan" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan MoM ini?');">
			            <input type="hidden" name="_token" value="{{ csrf_token() }}">
			            <div class="form-group col-xs-6 gap">
			                <label for="pembimbing">Pembimbing</label>
			                <select name="pembimbing" class="form-control" id="pembimbing">
			                    <option value="" disabled selected>Dosen Pembimbing</option>
			                    @if (count($listOfPembimbing) > 0)
			                        @foreach ($listOfPembimbing as $pembimbing)
			                            <option value="{{$pembimbing->user_id}}">{{$pembimbing->nama}}</option>
			                        @endforeach
			                    @endif
			                </select>
			            </div>
			            <div class="form-group col-xs-6 gap">
			                <label for="bimbingan-date">Tanggal Bimbingan</label>
			                <input name="bimbingan-date" type="date" class="form-control" id="bimbingan-date">
			            </div>
			            <div class="form-group col-xs-6 gap">
			                <label for="dicussion">Hasil Diskusi</label>
			                <textarea name="discussion" class="form-control" id="discussion"></textarea>
			            </div>
			            <div class="form-group col-xs-6 gap">
			                <label for="follow-up">Tindak Lanjut</label>
			                <textarea name="follow-up" class="form-control" id="follow-up"></textarea>
			            </div>
			            <div class="form-group col-xs-6 gap">
			                <label for="next-bimbingan-date">Tanggal Bimbingan Selanjutnya</label>
			                <input name="next-bimbingan-date" type="date" class="form-control" id="next-bimbingan-date">
			            </div>
			            <div class="form-group col-xs-6 gap">
			                <button type="submit" class="btn btn-primary align-self-center">Simpan MoM Bimbingan</button>
			            </div>
			        </form>
			    </div>
			</div>
		</div>
    </div>
@endsection
