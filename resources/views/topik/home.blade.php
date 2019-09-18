
{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: Ratnadira Widyasari--}}
 {{--* Date: 7/4/2018--}}
 {{--* Time: 9:33 PM--}}
 {{--*/--}}
@extends('layouts.app')
@section('title')
    <title>Input Topik</title>
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
                    <div class="card-header">Input Topik</div>

                    <div class="card-body">
                        {{--action="/dosen/ta1/administrasi/add_new_topic"--}}
                        <form method="POST" action="/dosen/ta1/addtopik" onsubmit="return confirm('Apakah Anda yakin ingin menambahkan topik tersebut?');">
                            @csrf
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-4 col-form-label text-md-right">Tahun Ajaran</label>
                                <div class="col-md-2">
                                    <div class="input-append date" id="datepicker" data-date="02-2018"
                                         data-date-format="yyyy">
                                        <input  type="text" name="date" class="form-control" id="tahun" value="{{ old('date') }}" required>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                </div>
                                <label for="semester" class="col-sm-2 col-form-label text-md-right">Semester</label>
                                <div class="col-md-2">
                                    <select name="semester" class="form-control" id="semester" required>
                                        <option value="" disabled selected>-</option>
                                        <option value="1"
                                                {{ (old('semester') == 1) ? 'selected': '' }}>I</option>
                                        <option value="2" {{ (old('semester') == 2) ? 'selected': '' }}>II</option>
                                        <option value="3" {{ (old('semester') == 3) ? 'selected': '' }}>III</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="topik" class="col-sm-4 col-form-label text-md-right">Tema/Topik</label>
                                <div class="col-md-6">
                                    <input name="topik" type="text" class="form-control" id="topik" value="{{ old('topik') }}" required>

                                </div>
                                <div class="col-sm-4">
                                </div>
                                <div class="col-md-6" style="font-size: smaller; color: #AA0101">

                                    @foreach ($errors->all() as $error)
                                            <strong> {!! $errors->first() !!}</strong>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label text-md-right">Deskripsi Umum</label>
                                <div class="col-md-6">
                                    <textarea name="description" type="text" class="form-control" id="description" required>{{ old('description') }}</textarea>
                                    {{--<input name="description" type="text" class="form-control" id="description">--}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project" class="col-sm-4 col-form-label text-md-right">Jenis TA</label>
                                <div class="col-md-6">
                                    <select name="project" class="form-control" id="project" required>
                                        <option value="" disabled selected>Jenis TA</option>
                                        <option value="non project" {{ (old('project') == 'non project') ? 'selected': '' }}>Non-Project</option>
                                        <option value="project" {{ (old('project') == 'project') ? 'selected': '' }}>Project</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="addingtoping">
                                <label for="subtopic" class="col-sm-4 col-form-label text-md-right">Sub-Topik</label>
                                <div class="input-group col-md-6">
                                    <input name="subtopic" style="width: 80%" type="text" class="form-control" id="subtopic" placeholder="Opsional" value="{{ old('subtopic') }}">
                                    <span class="input-group-btn">
                                    <button onclick="addDiv()" class="btn btn-primary" type="button">
                                        +
                                    </button>
                                    </span>
                                </div>
                                @for ($i = 0; $i < 10; $i++)
                                    <?php $j = 1; ?>
                                    @if(old('subtopic'.$i, null) != null)
                                        <?php $rows = $j; ?>
                                        <div class="input-group col-sm-4"></div>

                                        <div class="input-group col-md-6">
                                            <input name="subtopic{{$i}}" style="width: 100%; margin-top: 2%" type="text" class="form-control" id="subtopic{{$i}}" value="{{ old('subtopic'.$i) }}" placeholder="Opsional">
                                        </div>
                                    @endif
                                    <?php $j++; ?>
                                @endfor
                                @for ($i = 10; $i < 40; $i++)
                                    <?php $j = 1; ?>
                                    @if(old('subtopic'.$i, null) != null)
                                        <?php $rows = $j; ?>
                                            <div class="input-group col-sm-4"></div>

                                            <div class="input-group col-md-6">
                                            <input name="subtopic{{$i-10}}" style="width: 100%; margin-top: 2%" type="text" class="form-control" id="subtopic{{$i-10}}" value="{{ old('subtopic'.$i) }}" placeholder="Opsional">
                                        </div>
                                    @endif
                                    <?php $j++; ?>
                                @endfor
                            </div>
                            <script>
                                var iteration = 10;
                                function addDiv(){
                                    var div = document.createElement('div');
                                    div.className = "col-sm-4";
                                    document.getElementById('addingtoping').appendChild(div);
                                    div = document.createElement('div');
                                    div.className = "col-md-6";
                                    div.innerHTML = "<input name=\"subtopic"+ iteration +"\" style=\"width: 100%;  margin-top: 2%\" type=\"text\" class=\"form-control\" id=\"subtopic"+ iteration +"\" placeholder=\"Opsional\">\n";
                                    document.getElementById('addingtoping').appendChild(div);
                                    iteration++;
                                }
                            </script>
                            <div class="form-group row">
                                <label for="quota" class="col-sm-4 col-form-label text-md-right">Jumlah Mahasiswa yang Dibutuhkan</label>
                                <div class="col-md-6">
                                    <input name="quota" onKeyUp="numericOnly(this)" type="text" class="form-control" id="quota" required  value={{ old('quota') }}>
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
                                    <select id="pembimbing1" class="form-control" name="pembimbing1"
                                            @if ($wewenang === 1)
                                                @if (old('pembimbing1',null) !== null)
                                                    {{( (old('pembimbing1',null) !== null) or (old('pembimbing2',null) !== null)) ? '': 'required' }}
                                                @else
                                                    required
                                                @endif
                                            @endif
                                    >
                                        <option value="" disabled selected>Pembimbing I</option>
                                        <option value="lalala">-</option>
                                        @if ($wewenang === 1)
                                            @if (old('pembimbing1',null) !== null)
                                                @if (count($listOfDosen) > 0)
                                                    @foreach($listOfDosen as $dosen)
                                                        @if ($dosen->wewenang_pembimbing == 1)
                                                            <option value="{{$dosen->user_id}}" {{ (old('pembimbing1') == $dosen->user_id) ? 'selected': '' }}>{{$dosen->nama}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @else
                                                @if (count($listOfDosen) > 0)
                                                    @foreach($listOfDosen as $dosen)
                                                        @if ($dosen->wewenang_pembimbing == 1)
                                                            <option value="{{$dosen->user_id}}" {{ ($nama == $dosen->user_id) ? 'selected': '' }}>{{$dosen->nama}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                        @else
                                            @if (count($listOfDosen) > 0)
                                                @foreach($listOfDosen as $dosen)
                                                    @if ($dosen->wewenang_pembimbing == 1)
                                                        <option value="{{$dosen->user_id}}" {{ (old('pembimbing1') == $dosen->user_id) ? 'selected': '' }}>{{$dosen->nama}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pembimbing2" class="col-sm-4 col-form-label text-md-right">Calon Pembimbing II</label>
                                <div class="col-md-6">
                                    <select id="pembimbing2" class="form-control" name="pembimbing2"

                                    @if ($wewenang === 2)
                                            @if (old('pembimbing2',null) !== null)
                                            {{( (old('pembimbing1',null) !== null) or (old('pembimbing2',null) !== null)) ? '': 'required' }}
                                            @else
                                             required
                                            @endif
                                    @endif

                                    >
                                        <option value="" disabled selected>Pembimbing II</option>
                                        <option value="lalala">-</option>
                                        @if ($wewenang === 2)
                                            @if (old('pembimbing2',null) !== null)
                                                @if (count($listOfDosen) > 0)
                                                    @foreach($listOfDosen as $dosen)
                                                        @if ($dosen->wewenang_pembimbing == 1 || $dosen->wewenang_pembimbing == 2)
                                                            <option value="{{$dosen->user_id}}" {{ (old('pembimbing2') == $dosen->user_id) ? 'selected': '' }}>{{$dosen->nama}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @else
                                                @if (count($listOfDosen) > 0)
                                                    @foreach($listOfDosen as $dosen)
                                                        @if ($dosen->wewenang_pembimbing == 1 || $dosen->wewenang_pembimbing == 2)
                                                            <option value="{{$dosen->user_id}}" {{ ($nama == $dosen->user_id) ? 'selected': '' }}>{{$dosen->nama}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                        @else
                                            @if (count($listOfDosen) > 0)
                                                @foreach($listOfDosen as $dosen)
                                                    @if ($dosen->wewenang_pembimbing == 1 || $dosen->wewenang_pembimbing == 2)
                                                        <option value="{{$dosen->user_id}}" {{ ($nama == $dosen->user_id) ? 'disabled': '' }} {{ (old('pembimbing2') == $dosen->user_id) ? 'selected': '' }}>{{$dosen->nama}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
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
                                        if (field2 !== '{{$nama}}'){
                                            $('#pembimbing1').find("option[value=\""+ {{$nama}} + "\"]").removeAttr('disabled');
                                        }
                                        if (field2 === 'lalala'){
                                            $('#pembimbing1').find("option[value=\""+ field2 + "\"]").attr('disabled', true);
                                            $('#pembimbing1').prop("required",true);
                                            $('#pembimbing2').removeAttr('required');

                                        } else if (field2 !== '') {
                                            $('#pembimbing1').find("option[value=\""+ field2 + "\"]").attr('disabled', true);
                                            $('#pembimbing1').removeAttr('required');

                                        }

                                    });
                                    $('#pembimbing1').on('change',function(){
                                        if (field1!==''){
                                            $('#pembimbing2').find("option[value=\""+ field1 + "\"]").removeAttr('disabled');
                                        }
                                        field1 = $(this).val();
                                        if (field1 !== '{{$nama}}'){
                                            $('#pembimbing2').find("option[value=\""+ {{$nama}} + "\"]").removeAttr('disabled');
                                        }
                                        if (field1 === 'lalala') {
                                            $('#pembimbing2').prop("required",true);
                                            $('#pembimbing2').find("option[value=\""+ field1 + "\"]").attr('disabled', true);
                                            $('#pembimbing1').removeAttr('required');
                                        } else if (field1 !== ''){
                                            $('#pembimbing2').find("option[value=\""+ field1 + "\"]").attr('disabled', true);
                                            $('#pembimbing2').removeAttr('required');
                                        }
                                    });
                                });
                            </script>

                            <div class="form-group row">
                                <label for="knowledge-field" class="col-sm-4 col-form-label text-md-right">Area Keilmuan Utama</label>
                                <div class="col-md-6">
                                    {{--<select name="knowledge-field" class="form-control" id="knowledge-field" required>--}}
                                        {{--<option value="" disabled selected>Area Keilmuan</option>--}}
                                    <div class="checkbox-group">
                                        @if (count($listOfKodeKeilmuan) > 0)
                                            @foreach($listOfKodeKeilmuan as $kode)
                                                <input type="checkbox" value="{{$kode->areakeilmuan}}" {{ (is_array(old('checkbox_name')) and in_array($kode->areakeilmuan, old('checkbox_name'))) ? ' checked' : '' }} id="{{$kode->id}}" name="checkbox_name[]" onclick="myFunction()" {{ (is_array(old('checkbox_name')) or old('externalkeilmuan',null) !== null) ? '' : 'required' }} >
                                                <label for="{{$kode->id}}">{{$kode->areakeilmuan}}</label>
                                                <br>
                                            @endforeach
                                        @endif
                                        <input name="externalkeilmuan" value="{{ old('externalkeilmuan') }}" type="text" class="form-control" id="externalkeilmuan" {{ (is_array(old('checkbox_name')) or old('externalkeilmuan') !== "") ? '' : 'required' }}  onkeyup="myFunction()" placeholder="Opsional apabila area keilmuan tidak ada dalam checkbox">
                                    </div>
                                    <script>
                                        function myFunction() {
                                            var tempforcheck = 0;
                                            @foreach($listOfKodeKeilmuan as $kode)
                                                var checkBox = document.getElementById("{{$kode->id}}");
                                                if (checkBox.checked === true){
                                                    checkBox.removeAttribute("required");
                                                    var input = document.getElementById("externalkeilmuan");
                                                    input.removeAttribute("required");
                                                    @foreach($listOfKodeKeilmuan as $kodenext)
                                                        var checkBox1 = document.getElementById("{{$kodenext->id}}");
                                                        checkBox1.removeAttribute("required");
                                                    @endforeach
                                                    tempforcheck = 1;
                                                } else if (checkBox.checked !== true && tempforcheck === 0) {
                                                    checkBox.setAttribute("required",true);
                                                }
                                            @endforeach
                                            var input = document.getElementById("externalkeilmuan");
                                            if (input.value !== ""){
                                                checkBox.removeAttribute("required");
                                                var input = document.getElementById("externalkeilmuan");
                                                input.removeAttribute("required");
                                                        @foreach($listOfKodeKeilmuan as $kodenext)
                                                var checkBox1 = document.getElementById("{{$kodenext->id}}");
                                                checkBox1.removeAttribute("required");
                                                @endforeach
                                                    tempforcheck = 1;
                                            } else if (input.value === "" && tempforcheck === 0) {
                                                input.setAttribute("required",true);
                                            }
                                        }

                                    </script>
                                        {{--<option value="Algorithm and Complexity">Algorithm and Complexity</option>--}}
                                        {{--<option value="Computer Architecture and Organization">Computer Architecture and Organization</option>--}}
                                        {{--<option value="Computational Science">Computational Science</option>--}}
                                        {{--<option value="Discrete Structure">Discrete Structure</option>--}}
                                        {{--<option value="Human-Computer Interaction">Human-Computer Interaction</option>--}}
                                        {{--<option value="Information Assurance and Security">Information Assurance and Security</option>--}}
                                        {{--<option value="Information Management">Information Management</option>--}}
                                        {{--<option value="Intelligent Systems">Intelligent Systems</option>--}}
                                        {{--<option value="Networking and Communication">Networking and Communication</option>--}}
                                        {{--<option value="Operating Systems">Operating Systems</option>--}}
                                        {{--<option value="Platform-Based Development">Platform-Based Development</option>--}}
                                        {{--<option value="Parallel and Distributed Computing">Parallel and Distributed Computing</option>--}}
                                        {{--<option value="Programming Languages">Programming Languages</option>--}}
                                        {{--<option value="Software Development Fundamentals">Software Development Fundamentals</option>--}}
                                        {{--<option value="Software Engineering">Software Engineering</option>--}}
                                        {{--<option value="Systems Fundamentals">Systems Fundamentals</option>--}}
                                        {{--<option value="Social Issues and Professional Practice">Social Issues and Professional Practice</option>--}}
                                    {{--</select>--}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specific-knowledge-field" class="col-sm-4 col-form-label text-md-right">Area Keilmuan Spesifik</label>
                                <div class="col-md-6">
                                    <input name="specific-knowledge-field" type="text"  value="{{ old('specific-knowledge-field') }}" class="form-control" id="specific-knowledge-field" placeholder="Opsional">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="other-topic" class="col-sm-4 col-form-label text-md-right">Kaitan dengan Bidang Ilmu Selain Computing</label>
                                <div class="col-md-6">
                                    <input name="other-topic" type="text" class="form-control" value="{{ old('other-topic') }}" id="other-topic" placeholder="Opsional">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exp-lab" class="col-sm-4 col-form-label text-md-right">Laboratorium Keahlian</label>
                                <div class="col-md-6">
                                    <select name="exp-lab" class="form-control" id="exp-lab" required>
                                        <option value="" disabled selected>Laboratorium Keahlian</option>
                                        <option value="Ilmu dan Rekayasa Komputasi" {{ (old('exp-lab') == "Ilmu dan Rekayasa Komputasi") ? 'selected': '' }} >Ilmu dan Rekayasa Komputasi</option>
                                        <option value="Grafika dan Intelejensia Buatan" {{ (old('exp-lab') == "Grafika dan Intelejensia Buatan") ? 'selected': '' }} >Grafika dan Intelejensia Buatan</option>
                                        <option value="Sistem Terdistribusi" {{ (old('exp-lab') == "Sistem Terdistribusi") ? 'selected': '' }} >Sistem Terdistribusi</option>
                                        <option value="Sistem Informasi" {{ (old('exp-lab') == "Sistem Informasi") ? 'selected': '' }} >Sistem Informasi</option>
                                        <option value="Pemrograman" {{ (old('exp-lab') == "Pemrograman") ? 'selected': '' }} >Pemrograman</option>
                                        <option value="Rekayasa Perangkat Lunak" {{ (old('exp-lab') == "Rekayasa Perangkat Lunak") ? 'selected': '' }} >Rekayasa Perangkat Lunak</option>
                                        <option value="Basisdata" {{ (old('exp-lab') == "Basisdata") ? 'selected': '' }} >Basisdata</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Masukan Topik
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script src="{{ asset('js/app.js') }}"></script>
    {{--<script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment.min.js"></script>--}}
    {{--<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' />--}}
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>--}}
    {{--{!! $calendar->script() !!}--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker(
                {viewMode: 'years',
                    format: 'yyyy',
                    minViewMode: 'years'
                });
//            $('#datepicker').datepicker({format: " yyyy", // Notice the Extra space at the beginning
//                viewMode: "years",
//                minViewMode: "years"});
        });
//        $.when($('#datetimepicker').datetimepicker()).done(function() {
//            // code to be ran after plugin has initialized
//        });
    </script>
    {{--<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('js/jquery.dynatable.js')}}"></script>--}}
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>--}}

@endsection
