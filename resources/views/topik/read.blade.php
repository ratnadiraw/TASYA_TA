
{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: Ratnadira Widyasari--}}
 {{--* Date: 7/4/2018--}}
 {{--* Time: 9:33 PM--}}
 {{--*/--}}
@extends('layouts.app')
@section('title')
    <title>Baca Topik</title>
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
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><div onclick="goBack()" class="fa fa-long-arrow-left" style="font-size: large; margin-right: 1%"></div> Detail Topik</div>
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="tahun" class="col-sm-4 col-form-label text-md-right">Tahun Ajaran</label>
                            <div class="col-md-2">
                                <div class="input-append date" id="datepicker" data-date="02-2018"
                                     data-date-format="yyyy">
                                    <input  type="text" name="date" class="form-control" id="tahun" value="{{$topic->tahun}}" disabled required>
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                            <label for="semester" class="col-sm-2 col-form-label text-md-right">Semester</label>
                            <div class="col-md-2">
                                <select name="semester" class="form-control" id="semester" disabled required>
                                    <option value="" disabled selected>-</option>
                                    <option value="1"
                                            {{ ($topic->semester == 1) ? 'selected': '' }}>I</option>
                                    <option value="2" {{ ($topic->semester == 2) ? 'selected': '' }}>II</option>
                                    <option value="3" {{ ($topic->semester == 3) ? 'selected': '' }}>III</option>
                                </select>
                            </div>
                        </div>
                            <div class="form-group row">
                                <label for="topic" class="col-sm-4 col-form-label text-md-right">Tema/Topik</label>
                                <div class="col-md-6">
                                    <input name="topic" type="text" class="form-control" id="topic" value="{{$topic->topik}}" disabled="disabled" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label text-md-right">Deskripsi Umum</label>
                                <div class="col-md-6">
                                    <textarea name="description" type="text" class="form-control" id="description" disabled="disabled" required>{{$topic->deskripsi}}</textarea>
                                    {{--<input name="description" type="text" class="form-control" id="description">--}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project" class="col-sm-4 col-form-label text-md-right">Jenis TA</label>
                                <div class="col-md-6">
                                    <select name="project" class="form-control" id="project" disabled>
                                        <option value="" disabled>Jenis TA</option>
                                        <option value="non project"
                                        @if ($topic->keterangan == 'non project')
                                            selected
                                        @endif
                                        >Non-Project</option>
                                        <option value="project"
                                        @if ($topic->keterangan == 'project')
                                            selected
                                        @endif
                                        >Project</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sub-topic" class="col-sm-4 col-form-label text-md-right">Sub-Topik</label>

                                @if (count($listOfSub) > 0)
                                    @foreach ($listOfSub as $index => $sub)
                                        @if ($index === 0)

                                            <div class="input-group col-md-6">
                                                <input name="subtopic" style="width: 100%" type="text" class="form-control" value="{{ $sub->subtopik}}" placeholder="Opsional" disabled="disabled">
                                            </div>
                                        @else

                                            <div class="input-group col-sm-4"></div>
                                            <div class="input-group col-md-6">
                                                <input name="subtopic" style="width: 100%; margin-top: 2%" type="text" class="form-control" value="{{ $sub->subtopik}}" placeholder="Opsional" disabled="disabled">
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="col-md-6">
                                    <input name="subtopic" type="text" class="form-control" id="subtopic" placeholder="Opsional" disabled="disabled">
                                    </div>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="quota" class="col-sm-4 col-form-label text-md-right">Jumlah Mahasiswa yang Dibutuhkan</label>
                                <div class="col-md-6">
                                    <input name="quota" type="text" class="form-control" id="quota" value="{{$topic->quota}}" disabled="disabled" required>
                                </div>
                            </div>
                            <script>
                                function numericOnly(e)
                                {
                                    var val = e.value.replace(/[^\d]/g, "");
                                    if(val != e.value)
                                        e.value = val;
                                }
                            </script>
                            <div class="form-group row">
                                <label for="pembimbing1" class="col-sm-4 col-form-label text-md-right">Calon Pembimbing I</label>
                                <div class="col-md-6">
                                    <select id="pembimbing1" class="form-control" name="pembimbing1" disabled required>
                                        <option value="" disabled selected>Pembimbing I</option>
                                        @if (count($listOfDosen) > 0)
                                            @foreach($listOfDosen as $dosen)
                                                @if ($dosen->wewenang_pembimbing == 1)
                                                    <option value="{{$dosen->user_id}}"
                                                    @if ($dosen->user_id === $topic->pembimbing1)
                                                        selected
                                                    @endif
                                                    >{{$dosen->nama}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pembimbing2" class="col-sm-4 col-form-label text-md-right">Calon Pembimbing II</label>
                                <div class="col-md-6">
                                    <select id="pembimbing2" class="form-control" name="pembimbing2" disabled required>
                                        <option value="" disabled selected>Pembimbing II</option>
                                        @if (count($listOfDosen) > 0)
                                            @foreach($listOfDosen as $dosen)
                                                @if ($dosen->wewenang_pembimbing == 1 || $dosen->wewenang_pembimbing == 2)
                                                    <option value="{{$dosen->user_id}}"
                                                    @if ($dosen->user_id === $topic->pembimbing2)
                                                        selected
                                                    @endif
                                                    >{{$dosen->nama}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function(){
//                                    $("select").change(function() {
//                                        $("select").not(this).find("option[value=\""+ $(this).val() + "\"]").attr('disabled', true);
//                                    });
                                    var field2 = '';
                                    var field1 = '';
                                    $('#pembimbing2').on('change',function(){
                                        if (field2!==''){
                                            $('#pembimbing1').find("option[value=\""+ field2 + "\"]").removeAttr('disabled');
                                        }
                                        field2 = $(this).val();
                                        $('#pembimbing1').find("option[value=\""+ field2 + "\"]").attr('disabled', true);
                                        $('#pembimbing1').removeAttr('required');
                                    });
                                    $('#pembimbing1').on('change',function(){
                                        if (field1!==''){
                                            $('#pembimbing2').find("option[value=\""+ field1 + "\"]").removeAttr('disabled');
                                        }
                                        field1 = $(this).val();
                                        $('#pembimbing2').find("option[value=\""+ field1 + "\"]").attr('disabled', true);
                                        $('#pembimbing2').removeAttr('required');
                                    });
                                });
                            </script>

                            <div class="form-group row">
                                <label for="knowledge-field" class="col-sm-4 col-form-label text-md-right">Area Keilmuan Utama</label>
                                <div class="col-md-6">
                                    <div class="checkbox-group">
                                        @if (count($listOfKodeKeilmuan) > 0)
                                            @foreach($listOfKodeKeilmuan as $kode)
                                                <input type="checkbox" value="{{$kode->areakeilmuan}}" id="{{$kode->id}}" name="checkbox_name[]"
                                                       @foreach ($listOfKeilmuan as $ilmu)
                                                           @if ($kode->areakeilmuan === $ilmu)
                                                                   checked
                                                           @endif
                                                       @endforeach
                                                        onclick="myFunction()" disabled>
                                                <label for="{{$kode->id}}">{{$kode->areakeilmuan}}</label>
                                                <br>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specific-knowledge-field" class="col-sm-4 col-form-label text-md-right">Area Keilmuan Spesifik</label>
                                <div class="col-md-6">
                                    <input name="specific-knowledge-field" type="text" class="form-control" id="specific-knowledge-field" placeholder="Opsional"  value="{{$topic->areakeilmuanspesifik}}" disabled="disabled" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="other-topic" class="col-sm-4 col-form-label text-md-right">Kaitan dengan Bidang Ilmu Selain Computing</label>
                                <div class="col-md-6">
                                    <input name="other-topic" type="text" class="form-control" id="other-topic" placeholder="Opsional"  value="{{$topic->bidanglain}}" disabled="disabled" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exp-lab" class="col-sm-4 col-form-label text-md-right">Laboratorium Keahlian</label>
                                <div class="col-md-6">
                                    <select name="exp-lab" class="form-control" id="exp-lab" disabled required>
                                        <option value="" disabled selected>Laboratorium Keahlian</option>
                                        <option value="Ilmu dan Rekayasa Komputasi"
                                                @if ($topic->laboratorium === 'Ilmu dan Rekayasa Komputasi')
                                                    selected
                                                @endif
                                        >Ilmu dan Rekayasa Komputasi</option>
                                        <option value="Grafika dan Intelejensia Buatan"
                                                @if ($topic->laboratorium === 'Grafika dan Intelejensia Buatan')
                                                selected
                                                @endif
                                        >Grafika dan Intelejensia Buatan</option>
                                        <option value="Sistem Terdistribusi"
                                                @if ($topic->laboratorium === 'Sistem Terdistribusi')
                                                selected
                                                @endif
                                        >Sistem Terdistribusi</option>
                                        <option value="Sistem Informasi"
                                                @if ($topic->laboratorium === 'Sistem Informasi')
                                                selected
                                                @endif
                                        >Sistem Informasi</option>
                                        <option value="Pemrograman"
                                                @if ($topic->laboratorium === 'Pemrograman')
                                                selected
                                                @endif
                                        >Pemrograman</option>
                                        <option value="Rekayasa Perangkat Lunak"
                                                @if ($topic->laboratorium === 'Rekayasa Perangkat Lunak')
                                                selected
                                                @endif
                                        >Rekayasa Perangkat Lunak</option>
                                        <option value="Basisdata"
                                                @if ($topic->laboratorium === 'Basisdata')
                                                selected
                                                @endif
                                        >Basisdata</option>
                                    </select>
                                </div>
                            </div>
                            {{--<div class="form-group row">--}}
                                {{--<label for="inputdosen" class="col-sm-4 col-form-label text-md-right">Pengisi</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<input name="inputdosen" type="text" class="form-control" id="inputdosen" placeholder="Opsional"  value="{{$namaDosenInput}}" disabled="disabled" >--}}
                                {{--</div>--}}
                            {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    {!! $calendar->script() !!}
@endsection
