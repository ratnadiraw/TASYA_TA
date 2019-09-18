{{--3--}}
@extends('layouts.ta1.mahasiswa')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Progress Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card sidebar-card">
                    <div class="card-header"><h3>Profile</h3></div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{$mahasiswa->nama}}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>{{$mahasiswa->nim}}</td>
                                </tr>
                                <tr>
                                    <td>Angkatan</td>
                                    <td>{{$mahasiswa->angkatan}}</td>
                                </tr>
                                <tr>
                                    <td>Topik</td>
                                    <td>
                                        @if (isset($currentTA->topik_id))
                                            {{$currentTA->nama_topik}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pembimbing</td>
                                    <td>
                                        @if(count($listOfPembimbing) == 0)
                                            -
                                        @elseif(count($listOfPembimbing) == 1)
                                            {{$listOfPembimbing[0]->nama}}
                                        @else
                                            1. {{$listOfPembimbing[0]->nama}}
                                            <br/>
                                            2. {{$listOfPembimbing[1]->nama}}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Progress Mahasiswa</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (isset($currentTA))
                            <h4>Administrasi</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Jumlah Kehadiran Kelas</td>
                                        <td>{{$progressSummary->jumlah_kehadiran_kelas}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Bimbingan</td>
                                        <td>{{$progressSummary->jumlah_bimbingan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Kehadiran Seminar</td>
                                        <td>{{$progressSummary->jumlah_kehadiran_seminar}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Seminar</td>
                                        <td>
                                            @if($progressSummary->terdaftar_seminar)
                                                Terdaftar
                                            @else
                                                Belum Terdaftar
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4 class="report-heading">Daftar Tugas</h4>
                            @if (count($listOfTugas) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tugas</th>
                                        <th>Tenggat Waktu</th>
                                        <th style="text-align: center;">Pengumpulan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach($listOfTugas as $tugas)
                                        <tr>
                                            <td>{{$counter++}}</td>
                                            <td>{{$tugas->judul}}</td>
                                            <td>{{App\Http\Controllers\DateID::formatDateTime($tugas->tenggat_waktu, true)}}</td>
                                            <td>
                                                @if ($tugas->pivot->status_pengumpulan == 0)
                                                    <input type="checkbox" class="form-control" name="submit-task-status-{{$tugas->id}}" style="text-align: center;" disabled>
                                                @else
                                                    <input type="checkbox" class="form-control" name="submit-task-status-{{$tugas->id}}" style="text-align: center;" checked disabled>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h6>Belum ada tugas.</h6>
                            @endif
                            <h4 class="report-heading">Seminar</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Berkas Seminar</td>
                                        <td>
                                            @if((isset($seminar) && $seminar->berkas_seminar == null) || !(isset($seminar)))
                                                BAP belum diunggah
                                            @else
                                                <a href="/mahasiswa/ta1/administrasi/downloadBAP/{{$seminar->id}}">Unduh</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai Seminar</td>
                                        <td>
                                            @if (isset($seminar->nilai))
                                                {{$seminar->nilai}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">
                                Anda belum terdaftar sebagai peserta Tugas Akhir 1.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>  
    </div>
@endsection
