@extends('layouts.ta2.timta')
@section('title')
    <title>Daftar Tugas | Tim TA</title>
@endsection
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="card  col-md-10 gap-bottom">
                <div class="card-header"><h3>List Tugas</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tugas</th>
                                <th>Deadline</th>
                            </tr>
                        </thead>
                        @foreach($all_tugas as $tugas)
                            <tbody>
                                <tr>
                                    <td> <a href="/tim_ta/ta2/kelas/tugas/{{$tahun}}/{{$semester}}/{{$tugas->id}}/{{basename($tugas->path)}}"> {{$tugas->judul}} </a></td>
                                    <td>{{$tugas->deadline}}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card col-md-10 gap-bottom">
                <div class="card-header"><h3>Unggah Tugas</h3></div>
                <div class="card-body overflow-visible">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="bottom-gap-8p">
                            <td class="tu-table-td-form"><label for="pdf">Spesifikasi Tugas</td>
                            <td class="tu-table-td-form"><input name="pdf" type="file"></td>
                        </div>
                        <div class="bottom-gap-8p">
                            <td class="tu-table-td-form"><label for="tugas" >Tugas</label></td>
                            <td class="tu-table-td-form"><input name="tugas" type="text" class="form-control" id="tugas" placeholder="Judul Tugas"></td>
                        </div>
                        <div class="bottom-gap-8p">
                            <td class="tu-table-td-form"><label for="deadline">Deadline Tugas</label></td>
                            <td>
                                <div class="input-group date" id="tanggal-selesai-pengumuman" data-target-input="nearest">
                                    <input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#tanggal-selesai-pengumuman">
                                    <div class="input-group-append" data-target="#tanggal-selesai-pengumuman" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </td>
                        </div>
                        <div>
                            <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Unggah</button></td>
                        </div>
                    </form>
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