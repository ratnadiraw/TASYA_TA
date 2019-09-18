@extends('layouts.ta2.dosen')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Sidang</h3></div>
                    <div class="card-body">
                        <form action="/dosen/ta2/sidang/sidang_penguji_submit" enctype="multipart/form-data" method="POST" class="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="sidang_id" value="{{$data_sidang->sidang_id}}">
                            <div class="add-bimbingan-content">
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    NIM / NAMA: {{$data_sidang->nim}} / {{$data_sidang->nama}}
                                </div>

                                <div class="row">
                                    <div class="col-md-3 add-bimbingan-content-field font-weight-bold">
                                        Penguji:
                                    </div>
                                    @foreach($dosen_penguji as $dosen)
                                        <div class="col-md-3 add-bimbingan-content-field">{{$dosen->nama . "  "}}</div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="add-bimbingan-content-field font-weight-bold">
                                        Ruangan:
                                    </div>
                                    @if ($data_sidang->ruangan != null)
                                        <div class="add-bimbingan-content-field font-weight-bold">
                                            {{$data_sidang->ruangan}}
                                        </div>
                                    @else
                                        <div class="add-bimbingan-content-field font-weight-bold">
                                            Ruangan belum ditentukan
                                        </div>
                                    @endif
                                    <input type="hidden" class="form-control" name="ruangan" value="{{$data_sidang->ruangan}}">
                                </div>

                                <div class="row">
                                    <div class="add-bimbingan-content-field font-weight-bold">
                                        Tanggal/Waktu:
                                    </div>
                                    <div class="input-group date bottom-gap-8p" id="tanggal-selesai-pengumuman" data-target-input="nearest">
                                        <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#tanggal-selesai-pengumuman" value="{{$data_sidang->tanggal}}">
                                        <div class="input-group-append" data-target="#tanggal-selesai-pengumuman" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <input class="form-control btn-md btn-primary" type="submit" required >
                        </form>
                    </div>
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