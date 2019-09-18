
{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: Ratnadira Widyasari--}}
{{--* Date: 7/4/2018--}}
{{--* Time: 9:33 PM--}}
{{--*/--}}
@extends('layouts.app')
@section('title')
    <title>Daftar Topik</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dosen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dynatable.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

@endsection
@section('navbar')
    <nav class="navbar-mahasiswa navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="row">
                <ul class="navbar-nav" style="padding-left: 15px;">
                    <li class="nav-item"><a class="nav-link" href="/dosen/ta1/topik">Input Topik</a></li>
                    <li class="nav-item"><a class="nav-link" href="/dosen/ta1/alltopik">Topik Saya</a></li>
                    <li class="nav-item"><a class="nav-link" href="/dosen/ta1/topikdosen">Seluruh Topik</a></li>
                    @if ($me === true)
                        <li class="nav-item"><a class="nav-link" href="/dosen/ta1/alltopikdosen">Finalisasi Topik</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Daftar Topik</h3>
            </div>
            <div class="card-body">
                <center>

                    <div class="col-md-12">
                        <table>
                            @if ($timta === 'timta')
                                <tr>
                                    <form action="/dosen/ta1/generate">
                                        <button type="submit" class="btn btn-danger align-self-center">Generate Excel</button>
                                    </form>
                                </tr>
                            @elseif ($timta === 'dosen')
                                <tr>
                                    <form action="/dosen/ta1/topik">
                                        <button type="submit" class="btn btn-info align-self-center">Input Topik</button>
                                    </form>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <br>
                </center>
                <br>
                @if (count($listOfTopics) > 0)
                    @if(isset($message))
                        <div class="alert alert-info">
                            {{$message}}
                        </div>
                    @endif
                    <table class="table table-striped" id="topik-dosen-table">
                        <thead>
                        <tr>
                            <th>Topik</th>
                            <th>Sub Topik</th>
                            <th>Jumlah Mahasiswa Dibutuhkan</th>
                            @if ($timta !== "dosenall")
                                <th>Aksi</th>
                                <th>Keterangan</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listOfTopics as $topic)
                            <tr>
                                <td style="word-wrap: break-word; word-break: break-all; white-space: normal;">{{$topic->topik}} @if ($timta !== 'timta')
                                        <input type="hidden" name="id" value="{{$topic->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @endif</td>
                                <td style="word-wrap: break-word; word-break: break-all; white-space: normal;">

                                    @foreach ($listOfSub as $sub)
                                        @if ($sub->id_topik === $topic->id)
                                            {{$sub->subtopik}}
                                        @endif
                                    @endforeach
                                </td>
                                <td colspan="3">
                                    <div class="row">
                                        @if ($topic->status === 0 || $topic->status === 2)
                                            <div class="col-sm-4 gap">
                                                <form action="/dosen/ta1/decrease_topic_quota" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengurangi jumlah kuota?');">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{$topic->id}}">
                                                    <button type="submit" class="btn btn-warning">-</button>
                                                </form>
                                            </div>
                                        @endif
                                        <div class="col-sm-3">
                                            {{$topic->quota}}
                                            @if ($timta === 'timta')
                                                    <input type="hidden" name="id" value="{{$topic->id}}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                             @endif
                                        </div>
                                        @if ($topic->status === 0 || $topic->status === 2)
                                            <div class="col-sm-1">
                                                <form action="/dosen/ta1/increase_topic_quota" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin manambah jumlah kuota?');">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{$topic->id}}">
                                                    <button type="submit" class="btn btn-warning">+</button>
                                                </form>
                                            </div>
                                        @endif
                                        <div class="col-sm-1"></div>
                                    </div>

                                    <div class="col-md-9">
                                    </div>
                                </td>

                                @if ($timta !== "dosenall")
                                @if ($timta !== 'timta')
                                <td>

                                    <div class="row">
                                    @if ($topic->status === 0 || $topic->status === 2)

                                            <div style="margin-bottom: 2%; margin-left: 2%; margin-right: 2%">
                                        <form action="/dosen/ta1/hapus_topik" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus topik tersebut?');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{$topic->id}}">
                                            <button type="submit" class="btn btn-danger align-self-center"><span class="fa fa-trash"></span></button>
                                        </form>
                                            </div>
                                            <div style="margin-bottom: 2%; margin-left: 2%; margin-right: 2%">
                                        <form action="/dosen/ta1/edit_topik" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengedit topik tersebut?');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{$topic->id}}">
                                            <button type="submit" class="btn btn-info align-self-center"><span class="fa fa-pencil"></span></button>
                                        </form>
                                            </div>
                                    @endif
                                        {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
                                        {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
                                        {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
                                        <div style="margin-bottom: 2%; margin-left: 2%; margin-right: 2%">
                                        <form action="/dosen/ta1/copy_topik" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyalin topik tersebut?');">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{$topic->id}}">
                                        <button type="submit" class="btn btn-primary align-self-center"><span class="fa fa-clone"></span></button>
                                    </form>
                                        </div>
                                    @if ($topic->status === 0 || $topic->status === 2)
                                            <div style="margin-left: 2%; margin-right: 2%; margin-bottom: 2%">
                                        <form action="/dosen/ta1/submit_topik" method="POST" onsubmit="return confirm('Apakah Anda yakin untuk submit topik tersebut? Setelah Anda submit data tidak dapat diubah maupun dihapus');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{$topic->id}}">
                                            <button type="submit" class="btn btn-success align-self-center"><span class="fa fa-upload"></span></button>
                                        </form>
                                            </div>

                                    @endif

                                        <div class="col-md-14">
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </td>
                                @else
                                    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
                                    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
                                    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

                                    <td>
                                        <div class="row">
                                            <div style="margin-bottom: 2%; margin-left: 2%; margin-right: 2%">
                                                <form action="/dosen/ta1/lengkapi_topik" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin topik tersebut dilengkapi terlebih dahulu?')">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{$topic->id}}">
                                                    <button type="submit" class="btn btn-danger align-self-center">Revise</button>
                                                </form>
                                            </div>
                                            @if ($topic->status !== 3 )
                                            <div style="margin-bottom: 2%; margin-left: 2%; margin-right: 2%">
                                                <form action="/dosen/ta1/terima_topik" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mem-publish topik tersebut?');">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{$topic->id}}">
                                                    <button type="submit" class="btn btn-success align-self-center">Publish</button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                                <td>
                                    <b>
                                    @if ($topic->status === 0)
                                        Belum Submit
                                    @elseif ($topic->status === 1)
                                        Submit
                                    @elseif ($topic->status === 2)
                                        Data Belum Lengkap
                                    @elseif ($topic->status === 3)
                                        Final
                                    @endif
                                    </b>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Belum Ada Topik</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.dynatable.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--$('#topik-dosen-table').datetimepicker();--}}
        {{--});--}}
        {{--$.when($('#topik-dosen-table').datetimepicker()).done(function() {--}}
            {{--// code to be ran after plugin has initialized--}}
        {{--});--}}
    {{--</script>--}}
    <script>
        $(document).ready(function()
            {
                $("#topik-dosen-table").dynatable();
            }
        );
        $.when($('#topik-dosen-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
        $('#topik-dosen-table').dynatable().on('click', 'tr', function () {
            var data = [];
            $(this).find('td').each(function (i, el) {
                data.push($(el).html());
            });
            console.log(data[3]);
            @if ($timta === 'timta')
                var start = data[2].search("<input type=\"hidden\" name=\"id\" value=\"");
                var end = data[2].search("<input type=\"hidden\" name=\"_token\" value=\"");
                var goTo = data[2].substring(start+38, end-2);
            @else
                  var start = data[0].search("<input type=\"hidden\" name=\"id\" value=\"");
                  var end = data[0].search("<input type=\"hidden\" name=\"_token\" value=\"");
                  var goTo = data[0].substring(start+38, end-2);
//                var start = data[3].search("<input type=\"hidden\" name=\"id\" value=\"");
//                var end = data[3].search("button type=\"submit\" class=\"btn btn-danger align-self-center\"><span class=\"glyphicon glyphicon-duplicate");
//                var goTo = data[3].substring(start+38, end-3);
            @endif

            console.log(goTo);
            window.location.href = 'http://127.0.0.1:8000/dosen/ta1/read/'+goTo;
        });
    </script>
@endsection