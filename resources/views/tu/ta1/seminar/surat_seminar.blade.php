@extends('layouts.ta1.tu')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Surat Seminar</title>
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
            <div class="card-header"><h3>Surat Seminar Mahasiswa</h3></div>
            <div class="card-body">
            	@if (count($seminars) > 0)
						    <form action="/tu/ta1/seminar/cetak_surat_seminar" method="post">
						        <div class="row">
						            <div class="col-sm-3">
						                <div class="form-group">
						                <input type="number" name="no_kop_inc" placeholder="Start Increment" class="form-control">
						                </div>
						            </div>
						            <div class="col-sm-3">
						                <div class="form-group">
						                <input type="text" name="no_kop" placeholder="Nomor Kop Surat" class="form-control">
						                </div>
						            </div>
						            <div class="col-sm-6">
						                <div class="form-group">
						                <input type="text" name="tanggal_terbit" placeholder="Tanggal Terbit Surat" class="form-control">
						            </div>
						            </div>
						        </div>
						        <table class="table table-striped" id="surat-seminar-mahasiswa-table">
						            <thead>
						                <tr>
						                    <th>NIM</th>
						                    <th>Nama</th>
						                    <th>Ruangan</th>
						                    <th>Waktu</th>
						                    <th><input type="checkbox" onClick="toggle(this)">All</th>
						                </tr>
							            </thead>
						            <tbody>
						                @foreach ($seminars as $seminar)
						                    <tr>
						                        <td>{{$seminar->nim}}</td>
						                        <td>{{$seminar->nama}}</td>
						                        <td>{{$seminar->ruangan}}</td>
						                        <td>{{App\Http\Controllers\DateID::formatDateTime($seminar->waktu, true)}}</td>
						                        <td>
						                            <input type="checkbox" name="surat[]" value="{{$seminar->id}}">
						                        </td>
						                    </tr>
						                @endforeach
						            </tbody>
						        </table>
						        {{csrf_field()}}
						        <button type="submit" class="btn btn-primary">Cetak SK Seminar</button>
						        </div>
						    </div>
						    </form>
						  @else
						  	<p>Belum ada seminar.</p>
						 	@endif
					  </div>
    <script language="JavaScript">
        function toggle(source) {
          checkboxes = document.getElementsByName('surat[]');
          for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
          }
        }
    </script>
@endsection
@section('scripts')
	<script>
        $(document).ready(function() {
            $('#surat-seminar-mahasiswa-table').dynatable();
        });
        $.when($('#surat-seminar-mahasiswa-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection