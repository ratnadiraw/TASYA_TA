@extends('layouts.ta2.timta')
@section('title')
    <title>Ubah Informasi Seminar | Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-8 edit-mom">
                <div class="card-header"><h3>Edit Jadwal dan Ruangan Seminar</h3></div>
                <div class="card-body overflow-visible">
                    <form action="/tim_ta/ta2/seminar/edit_seminar_individual_submit" enctype="multipart/form-data" method="POST" class="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="seminar_id" value="{{$data_seminar->seminar_id}}">
                        <div class="add-bimbingan-content">
                            <table>
                                <tr>
                                    <td>
                                        <div class="add-bimbingan-content-field font-weight-bold">
                                            NIM / NAMA:
                                        </div>
                                    </td>
                                    <td>
                                        <div class="add-bimbingan-content-field font-weight-bold">
                                            {{$data_seminar->nim}} / {{$data_seminar->nama}}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="add-bimbingan-content-field font-weight-bold">
                                            Ruangan:
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control datetimepicker-input left-gap-8p" name="ruangan" value="{{$data_seminar->ruangan}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="add-bimbingan-content-field font-weight-bold">
                                            Tanggal dan Waktu:
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group date bottom-gap-8p" id="tanggal-selesai-pengumuman" data-target-input="nearest">
                                            <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#tanggal-selesai-pengumuman" value="{{$data_seminar->tanggal}}">
                                            <div class="input-group-append" data-target="#tanggal-selesai-pengumuman" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <input class="form-control btn-md btn-primary" type="submit" required >
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