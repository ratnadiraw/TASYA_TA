@extends('layouts.ta2.timta')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp

@section('title')
    <title>Pengumuman Umum | Tim TA</title>
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

        @if (isset($tahun) && isset($semester))
            <h3>Tugas Akhir 2 Semester {{$semester}} Tahun Ajaran {{$tahun}}</h3>
        @endif

        <div class="card mt-4">
            <div class="card-header"><h3>Pengumuman Umum</h3></div>
            <div class="card-body">
                <form action="/tim_ta/ta2/administrasi/add_pengumuman" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" name="title" id="title" style="margin-bottom: 8px">
                    <label for="content">Isi</label>
                    <textarea type="text" class="form-control" name="content" id="content" rows="5" style="margin-bottom: 8px"></textarea>
                    <label for="start-date">Tanggal Mulai</label>
                    <div class="input-group date" id="tanggal-mulai-pengumuman" data-target-input="nearest" style="margin-bottom: 8px">
                        <input type="text" name="start-date" class="form-control datetimepicker-input" data-target="#tanggal-mulai-pengumuman"/>
                        <div class="input-group-append" data-target="#tanggal-mulai-pengumuman" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <label for="end-date">Tanggal Selesai</label>
                    <div class="input-group date" id="tanggal-selesai-pengumuman" data-target-input="nearest" style="margin-bottom: 8px">
                        <input type="text" name="end-date" class="form-control datetimepicker-input" data-target="#tanggal-selesai-pengumuman"/>
                        <div class="input-group-append" data-target="#tanggal-selesai-pengumuman" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="py-4 align-content-center">
                        <button type="submit" class="btn btn-primary align-self-center" style="margin-bottom: 8px">Umumkan</button>
                    </div>
                </form>
            </div>
        </div>
        <br/>
        <div class="card">
            <div class="card-header"><h3>Daftar Pengumuman</h3></div>
            <div class="card-body">
                @php
                    $counter = 1;
                @endphp
                @if (count($listOfPengumuman) > 0)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listOfPengumuman as $pengumuman)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$pengumuman->judul}}</td>
                                <td>{{$pengumuman->konten}}</td>
                                <td>{{$pengumuman->tanggal_mulai}}</td>
                                <td>{{$pengumuman->tanggal_berakhir}}</td>
                                <td>
                                    <form action="/tim_ta/ta2/administrasi/delete_pengumuman" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="announcement-id" value="{{$pengumuman->id}}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Belum ada pengumuman.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datetimepicker').datetimepicker();
        });
        $.when($('#datetimepicker').datetimepicker()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
    <script>
        $(document).ready(function()
            {
                $("#pengumuman-umum-table").dynatable();
            }
        );
        $.when($('#pengumuman-umum-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection