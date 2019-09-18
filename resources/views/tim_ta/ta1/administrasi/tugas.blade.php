@extends('layouts.ta1.timta')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Tugas</title>
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
            <div class="card-header"><h3>Tambah Tugas</h3></div>
            <div class="card-body">
                <form onsubmit="return confirm('Apakah anda yakin ingin menambah tugas?');"  action="/tim_ta/ta1/administrasi/add_new_tugas" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <table>
                    	<tr>
                    		<td class="tu-table-td-form"><label for="title">Judul</label></td>
                    		<td class="tu-table-td-form"><label for="deadline">Tenggat Waktu</label></td>
                    		<td class="tu-table-td-form"></td>
                    	</tr>
                    	<tr>
                    		<td class="tu-table-td-form"><input type="text" name="title" class="form-control" id="title"></td>
                    		<td class="tu-table-td-form">
                                <div class="input-group date" id="waktu-deadline" data-target-input="nearest">
                                    <input placeholder="YYYY-MM-DD HH:MM:SS" type="text" name="deadline" class="form-control datetimepicker-input" data-target="#waktu-deadline"/>
                                    <div class="input-group-append" data-target="#waktu-deadline" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </td>
                    		<td class="tu-table-td-form"><button type="submit" name="add" class="form-control btn btn-primary">Tambah</button></td>
                    	</tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3>Daftar Tugas</h3></div>
            <div class="card-body">
                @if (count($listOfTugas) > 0)
                <table class="table table-striped" id="tugas-TU-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tenggat Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($listOfTugas as $tugas)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$tugas->judul}}</td>
                                <td>{{App\Http\Controllers\DateID::formatDateTime($tugas->tenggat_waktu, true)}}</td>
                                <td>
                                    <form action="/tim_ta/ta1/administrasi/delete_tugas" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas tersebut?');">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="task-id" value="{{$tugas->id}}">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>Belum ada tugas.</p>
                @endif
            </div>
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
        $(document).ready(function() {
            $('#tugas-TU-table').dynatable();
        });
        $.when($('#tugas-TU-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection