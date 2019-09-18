{{--30--}}
@extends('layouts.ta1.timta')
@section('title')
    <title>TA1 | Finalisasi Topik</title>
@endsection
@section('content')
<div class="container col-md-10">
        <div class="row">
            <div class="col-sm-3">
                <div class="card sidebar-card">
                    <div class="card-header"><h3>Daftar Mahasiswa Bimbingan</h3></div>
                    <div class="card-body">
                        <table class="sidebar-table">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Nama Dosen</th>
                                    <th style="width: 50%;">Jumlah Mahasiswa Bimbingan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($listOfDosen) > 0)
                                    @foreach ($listOfDosen as $dosen)
                                        <tr>
                                            <td>{{$dosen->nama}}</td>
                                            <td><div id="dosen-quota-{{$dosen->user_id}}">{{$dosen->kuota_bimbingan}}</div></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header"><h3>Daftar Calon Mahasiswa Bimbingan</h3></div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="row alert alert-danger">{{ Session::get('message') }}</div>
                            @endif
                            @if (count($listOfDosen) > 0)
                                <form onsubmit="return confirm('Apakah Anda yakin ingin memfinalisasi daftar calon mahasiswa bimbingan?');"
                                action="/tim_ta/ta1/administrasi/finalisasi_mahasiswa_bimbingan" method="POST">
                                    <table class="table table-striped" id="finalisasi-mahasiswa-dosen-table">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Nama Dosen</th>
                                                <th>Calon Mahasiswa Bimbingan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($listOfDosen as $dosen)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>
                                                        {{$dosen->nama}}
                                                        <input type="hidden" name="dosen-id[]" value="{{$dosen->user_id}}">
                                                    </td>
                                                    <td>
                                                        @php
                                                            $listOfChosenMahasiswa = $dosen->listOfChosenMahasiswa;
                                                        @endphp
                                                        @if (count($listOfChosenMahasiswa) > 0)
                                                            @foreach ($listOfChosenMahasiswa as $chosenMahasiswa)
                                                                @php
                                                                    $mahasiswa = $chosenMahasiswa->mahasiswa;
                                                                @endphp
                                                                @if ($mahasiswa->currentTA1->topik_id !== null && $mahasiswa->currentTA1->topik_id === $chosenMahasiswa->topik_id)
                                                                    <div class="radio-button">
                                                                        <label class="radio-inline control-label"><input type="radio" name="approved-topic[{{$mahasiswa->currentTA1->id}}]" value="{{$chosenMahasiswa->topik_id}}" onclick="uploadApprovedTATopic(this);" checked>{{$mahasiswa->nama}}-{{$mahasiswa->nim}} ({{$chosenMahasiswa->topik->nama}})</label>
                                                                    </div>
                                                                @else
                                                                    <div class="radio-button">
                                                                        <label class="radio-inline control-label"><input type="radio" name="approved-topic[{{$mahasiswa->currentTA1->id}}]" value="{{$chosenMahasiswa->topik_id}}" onclick="uploadApprovedTATopic(this);">{{$mahasiswa->nama}}-{{$mahasiswa->nim}} ({{$chosenMahasiswa->topik->nama}})</label>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            Tidak terdapat calon mahasiswa bimbingan
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-primary">Finalisasi</button>
                                </form>
                            @else
                                <p>Tidak terdapat dosen yang terdaftar</p>
                            @endif
                        </div>
                    </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        function uploadApprovedTATopic(radioButton) {
            var buttonName = radioButton.name;
            var topicID = radioButton.value;
            var taID = buttonName.substring(buttonName.lastIndexOf("[")+1,buttonName.lastIndexOf("]"));
            $.ajax({
                type:'POST',
                url:'/tim_ta/ta1/administrasi/set_ta_topic',
                data:'_token={{csrf_token()}}&ta-id='+taID+'&topic-id='+topicID,
                success:function(data){
                    var listOfDosen = JSON.parse(data.listOfDosen);
                    $.each(listOfDosen, function(index, dosen) {
                        var quotaViewID = 'dosen-quota-'+ dosen.user_id;
                        console.log(quotaViewID);
                        $(document.getElementById(quotaViewID)).html(dosen.kuotaBimbingan);
                    });
                }
            });
        }
    </script>
    <script>
        $(document).ready(function()
            {
                $("#finalisasi-mahasiswa-dosen-table").dynatable();
            }
        );
        $.when($('#finalisasi-mahasiswa-dosen-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection