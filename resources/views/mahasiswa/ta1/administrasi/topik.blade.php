{{--1--}}
@extends('layouts.ta1.mahasiswa')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Pemilihan Topik</title>
@endsection
@section('content')
    <div class="container col-md-11">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
{{--        {{$listOfTopics}}--}}
        <div class="row">
            <div class="col-md-3">
                <div class="card sidebar-card">
                    <div class="card-header">
                        <h3 id="test">Prioritas Topik</h3>
                        </div>
                    <div class="card-body">
                        @if (!isset($currentTA) || $currentTA->topik_id === null)
                            <div class="row">
                                <div class="col-sm-4">
                                    Prioritas 1:
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        @if ($topicChoice[0] != null)
                                            <b>{{$topicChoice[0]->nama}}</b>
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <div class="row">
                                        @if ($topicChoice[0] != null)
                                             Pembimbing:
                                            <div class="col-sm-8">
                                                @if ($topicChoice[0]->pembimbing2 == -1)
                                                    @php
                                                        $pembimbing1 = $listOfDosen->find($topicChoice[0]->pembimbing1);
                                                    @endphp
                                                    <div class="row">
                                                        {{$pembimbing1->nama}}
                                                    </div>
                                                @else
                                                    @php
                                                        $pembimbing1 = $listOfDosen->find($topicChoice[0]->pembimbing1);
                                                        $pembimbing2 = $listOfDosen->find($topicChoice[0]->pembimbing2);
                                                    @endphp
                                                    <div class="row">
                                                        1. {{$pembimbing1->nama}}
                                                    </div>
                                                    <div class="row">
                                                        2. {{$pembimbing2->nama}}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    Prioritas 2:
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        @if ($topicChoice[1] != null)
                                            <b>{{$topicChoice[1]->nama}}</b>
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <div class="row">
                                        @if ($topicChoice[1] != null)
                                            Pembimbing:
                                            <div class="col-sm-8">
                                                @if ($topicChoice[1]->pembimbing2 == -1)
                                                    @php
                                                        $pembimbing1 = $listOfDosen->find($topicChoice[1]->pembimbing1);
                                                    @endphp
                                                    <div class="row">
                                                        {{$pembimbing1->nama}}
                                                    </div>
                                                @else
                                                    @php
                                                        $pembimbing1 = $listOfDosen->find($topicChoice[1]->pembimbing1);
                                                        $pembimbing2 = $listOfDosen->find($topicChoice[1]->pembimbing2);
                                                    @endphp
                                                    <div class="row">
                                                        1. {{$pembimbing1->nama}}
                                                    </div>
                                                    <div class="row">
                                                        2. {{$pembimbing2->nama}}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    Prioritas 3:
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        @if ($topicChoice[2] != null)
                                            <b>{{$topicChoice[2]->nama}}</b>
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <div class="row">
                                        @if ($topicChoice[2] != null)
                                            Pembimbing:
                                            <div class="col-sm-8">
                                                @if ($topicChoice[2]->pembimbing2 == -1)
                                                    @php
                                                        $pembimbing1 = $listOfDosen->find($topicChoice[2]->pembimbing1);
                                                    @endphp
                                                    <div class="row">
                                                        {{$pembimbing1->nama}}
                                                    </div>
                                                @else
                                                    @php
                                                        $pembimbing1 = $listOfDosen->find($topicChoice[2]->pembimbing1);
                                                        $pembimbing2 = $listOfDosen->find($topicChoice[2]->pembimbing2);
                                                    @endphp
                                                    <div class="row">
                                                        1. {{$pembimbing1->nama}}
                                                    </div>
                                                    <div class="row">
                                                        2. {{$pembimbing2->nama}}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group col-auto gap">
                                <div class="row">
                                    Topik Disetujui:
                                </div>
                                <div class="row">
                                    {{$currentTA->nama_topik}}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3>Daftar Topik Dosen dan Usulan Anda</h3>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="row alert alert-danger">{{ Session::get('message') }}</div>
                        @endif
                        @if (count($listOfTopics) > 0)
                        <form action="/mahasiswa/ta1/administrasi/save_pilihan_topik" method="POST" id="topic-preferences" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan pilihan topik Anda?');">
                            <table class="table table-striped" cellpadding="50" id="topik-dosen-mahasiswa-table">
                                <thead>
                                <tr>
                                    <th>Topik</th>
                                    <th>Area Keilmuan</th>
                                    <th>Area Keilmuan Spesifik</th>
                                    <th>Laboratorium Keahlian</th>
                                    <th>Pembimbing</th>
                                    <th>Jumlah Mahasiswa Dibutuhkan</th>
                                    <th style="width: 15%;">Pilih</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listOfTopics as $topic)
                                        @if ($topic->status === 3)
                                            <tr>
                                                <td>{{$topic->topik}}</td>
                                                <td>{{$topic->areakeilmuan}}</td>
                                                @if ($topic->areakeilmuanspesifik !== null)
                                                    <td>{{$topic->areakeilmuanspesifik}}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>{{$topic->laboratorium}}</td>
                                                <td>
                                                    @if ($topic->pembimbing2 == -1)
                                                        @php
                                                            $pembimbing1 = $listOfDosen->find($topic->pembimbing1);
                                                        @endphp
                                                        {{$pembimbing1->nama}}
                                                    @else
                                                        @php
                                                            $pembimbing1 = $listOfDosen->find($topic->pembimbing1);
                                                            $pembimbing2 = $listOfDosen->find($topic->pembimbing2);
                                                        @endphp
                                                        <div class="row">
                                                            1. {{$pembimbing1->nama}}
                                                        </div>
                                                        <div class="row">
                                                            2. {{$pembimbing2->nama}}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{$topic->quota}}</td>
                                                <td>
                                                	<div class="form-group">
													  	<select name="topic-choices[{{$topic->id}}]" class="form-control">
													  		<option value="" disabled selected>Pilih Prioritas</option>
													    	<option value="1">Prioritas 1</option>
													    	<option value="2">Prioritas 2</option>
													    	<option value="3">Prioritas 3</option>
													  	</select>
                                                        <input type="hidden" class="form-control" name="topic-id[]" value="{{$topic->id}}">
													</div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @if (!isset($currentTA))
                                <div class="row alert alert-info col-sm-12">
                                    Anda belum terdaftar sebagai peserta Tugas Akhir 1. Anda tidak dapat memilih topik. Silahkan hubungi tata usaha.
                                </div>
                            @elseif (isset($currentTA) && $currentTA->topik_id === null)
                                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                <input type="hidden" name="ta-id" value="{{$currentTA->id}}">
                                <div class="row col-sm-12">
                                    <button type="submit" class="btn btn-primary align-self-center">Simpan</button>
                                </div>
                                <span style="color:red;">
                                    *) Setiap kali menyimpan, Anda harus menyimpan semua pilihan Anda.
                                </span>
                            @elseif (isset($currentTA) && $currentTA->topik_id !== null)
                                <div class="row alert alert-info col-sm-12">
                                    Topik Anda sudah disetujui. Anda tidak dapat memilih topik.
                                </div>
                            @endif
                        </form>
                        @else
                            <p>Belum ada topik yang diajukan dosen.</p>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Usul Topik Baru</h3>
                    </div>
                    <div class="card-body">
                    <form action="/mahasiswa/ta1/administrasi/usulan_topik" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group col-xs-6 gap">
                            <label for="topic">Topik</label>
                            <input name="topic" type="text" class="form-control" id="topic">
                        </div>
                        <div class="form-group col-xs-6 gap">
                            <label for="knowledge-field">Area Keilmuan:</label>
                            <select name="knowledge-field" class="form-control" id="knowledge-field">
                                <option value="" disabled selected>Area Keilmuan</option>
                                <option value="Algorithm and Complexity">Algorithm and Complexity</option>
                                <option value="Computer Architecture and Organization">Computer Architecture and Organization</option>
                                <option value="Computational Science">Computational Science</option>
                                <option value="Discrete Structure">Discrete Structure</option>
                                <option value="Human-Computer Interaction">Human-Computer Interaction</option>
                                <option value="Information Assurance and Security">Information Assurance and Security</option>
                                <option value="Information Management">Information Management</option>
                                <option value="Intelligent Systems">Intelligent Systems</option>
                                <option value="Networking and Communication">Networking and Communication</option>
                                <option value="Operating Systems">Operating Systems</option>
                                <option value="Platform-Based Development">Platform-Based Development</option>
                                <option value="Parallel and Distributed Computing">Parallel and Distributed Computing</option>
                                <option value="Programming Languages">Programming Languages</option>
                                <option value="Software Development Fundamentals">Software Development Fundamentals</option>
                                <option value="Software Engineering">Software Engineering</option>
                                <option value="Systems Fundamentals">Systems Fundamentals</option>
                                <option value="Social Issues and Professional Practice">Social Issues and Professional Practice</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-6 gap">
                            <label for="specific-knowledge-field">Area Keilmuan Spesifik:</label>
                            <input name="specific-knowledge-field" type="text" class="form-control" id="specific-knowledge-field" placeholder="Opsional">
                        </div>
                        <div class="form-group col-xs-6 gap">
                            <label for="exp-lab">Laboratorium Keahlian:</label>
                            <select name="exp-lab" class="form-control" id="exp-lab">
                                <option value="" disabled selected>Laboratorium Keahlian</option>
                                <option value="Ilmu dan Rekayasa Komputasi">Ilmu dan Rekayasa Komputasi</option>
                                <option value="Grafika dan Intelejensia Buatan">Grafika dan Intelejensia Buatan</option>
                                <option value="Sistem Terdistribusi">Sistem Terdistribusi</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Pemrograman">Pemrograman</option>
                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                <option value="Basisdata">Basisdata</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-6 gap">
                            <label for="pembimbing1">Pembimbing 1</label>
                            <select name="pembimbing1" class="form-control" id="pembimbing1">
                                <option value="" disabled selected>Pembimbing 1</option>
                                @if (count($listOfDosen) > 0)
                                    @foreach ($listOfDosen as $dosen)
                                        <option value="{{$dosen->user_id}}">{{$dosen->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-xs-6 gap">
                            <label for="pembimbing2">Pembimbing 2</label>
                            <select name="pembimbing2" class="form-control" id="pembimbing2">
                                <option value="" disabled selected>Pembimbing 2 (Opsional)</option>
                                @if (count($listOfDosen) > 0)
                                    @foreach ($listOfDosen as $dosen)
                                        <option value="{{$dosen->user_id}}">{{$dosen->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @if (!isset($currentTA))
                            <div class="row alert alert-info">
                                Anda belum terdaftar sebagai peserta Tugas Akhir 1. Anda tidak dapat mengusulkan topik baru. Silahkan hubungi tata usaha.
                            </div>
                        @elseif (isset($currentTA) && $currentTA->topik_id === null)
                            <div class="form-group col-xs-6">
                                <button type="submit" class="btn btn-primary align-self-center">Tambah Topik Baru</button>
                            </div>
                        @elseif (isset($currentTA) && $currentTA->topik_id !== null)
                            <div class="row alert alert-info">
                                Topik Anda sudah disetujui. Anda tidak dapat mengusulkan topik baru.
                            </div>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).ready(function()
            {
                $("#topik-dosen-mahasiswa-table").dynatable();
            }
        );
        $.when($('#topik-dosen-mahasiswa-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection