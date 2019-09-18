@extends('layouts.ta1.tu')
<style>
    #ListSuratTugas {
        border: solid 1px;
        overflow: auto;
        max-height: 500px;
        padding: 8px 20px;
    }
</style>
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Cetak Surat Tugas</title>
@endsection
@section('content')
    <div class="container">
        @if (isset($tahun) && isset($semester))
            <h3>Tugas Akhir 1 Semester {{$semester}} Tahun Ajaran {{$tahun}}</h3>
        @endif
        <h3>Cetak Surat Tugas</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="ListSuratTugas">
            <form method="post" action="/tu/ta1/administrasi/a/all_surat_tugas">
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <input type="number" name="no_kop_inc" placeholder="Start Increment" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <input type="text" name="no_kop" placeholder="Nomor Kop Surat" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <input type="text" name="tanggal_terbit" placeholder="Tanggal Terbit Surat" class="form-control">
                    </div>
                    </div>
                </div>
                <br>
            <table class="table">
                <thead>
                    <tr>
                        <td><input class="form-control" type="checkbox" onClick="toggle(this)">All</td>
                        <td> NIM</td>
                        <td>Mahasiswa</td>
                        <td>Topik</td>
                        <td>Pembimbing</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tas as $ta)
                    <tr>
                        <td><input type="checkbox" class="form-control" value="{{$ta->id}}" name="surat[]"></td>
                        <td>{{$ta->mahasiswa->nim}}</td>
                        <td>{{$ta->mahasiswa->nama}}</td>
                        <td>{{$ta->nama_topik}}</td>  
                        <td>
                            <ol>
                            @foreach ($ta->pembimbing as $dosbing)
                                <li> {{$dosbing->nama}} </li>
                            @endforeach
                            </ol>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary">Cetak</button>
            </form>
        </div>
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