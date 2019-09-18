@extends('layouts.ta1.tu')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Berita Acara Seminar</title>
@endsection
@section('content')
    <div class="container col-md-10">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header"><h3>Daftar seminar</h3></div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (count($seminars) > 0)
                            <table class="table table-striped" id="bap-seminar-TU-table">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Tempat</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($seminars as $seminar)
                                        <tr>
                                            <td>{{$seminar->nim}}</td>
                                            <td>{{$seminar->nama}}</td>
                                            <td>{{$seminar->ruangan}}</td>
                                            <td>{{App\Http\Controllers\DateID::formatDateTime($seminar->waktu, true)}}</td>
                                            <td>
                                                @if($seminar->berkas_seminar == null)
                                                    <i>No BAP Uploaded</i>
                                                @else
                                                    <a href="/tu/ta1/seminar/downloadBAP/{{$seminar->id}}">See BAP</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Belum ada seminar.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="card">
                        <div class="card-header"><h3>Unggah BAP dan Nilai Seminar</h3></div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="/tu/ta1/seminar/saveBAP" method="POST">
                                <div class="row" style="margin-bottom: 8px;">
                                    <div class="col-sm-4">NIM Mahasiswa</div>
                                    <div class="col-sm-8">
                                        <input type="text" name="nim" class="form-control">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 8px;">
                                    <div class="col-sm-4">File BAP</div>
                                    <div class="col-sm-8">
                                        <input type="file" name="BAP" class="form-control">
                                    </div>
                                </div>
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-header"><h4>Unduh Formulir BAP</h4></div>
                        <div class="card-body">
                            <p><a href="/tu/ta1/seminar/downloadFormBAP">Download Form BAP Seminar Tugas Akhir I</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#bap-seminar-TU-table').dynatable();
        });
        $.when($('#bap-seminar-TU-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection