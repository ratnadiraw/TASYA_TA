@extends('layouts.ta1.timta')
@section('title')
    <title>TA1 | Ubah Progress Mahasiswa</title>
@endsection
@section('content')
    <div class="container col-sm-9">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-4">
                <div class="card sidebar-card">
                    <div class="card-header"><h3>Profile</h3></div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{$summary->nama}}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>{{$summary->nim}}</td>
                                </tr>
                                <tr>
                                    <td>Topik</td>
                                    <td>{{$summary->nama_topik}}</td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing</td>
                                    <td>
                                        @if (count($dosens) > 0)
                                            @foreach ($dosens as $dosen)
                                                {{$dosen->nama}}<br/>
                                            @endforeach
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
                    <div class="card-header"><h3>Edit Progress Mahasiswa</h3></div>
                    <div class="card-body">
                        <h4>Progress</h4>
                        <table class="table">
                            <tbody>  
                                <tr>
                                    <td>Jumlah Kehadiran Kelas</td>
                                    <td>{{$summary->jumlah_kehadiran_kelas}}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Kehadiran Seminar</td>
                                    <td>{{$summary->jumlah_kehadiran_seminar}}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Bimbingan</td>
                                    <td>{{$summary->jumlah_bimbingan}}</td>
                                </tr>
                                <tr>
                                    <td>Laporan Seminar</td>
                                    <td>
                                        @if ($summary->status_pengumpulan == 1)
                                            Sudah dikumpulkan
                                        @else
                                            Belum dikumpulkan
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="report-heading">Status Finalisasi Seminar</h4>
                        @if (isset($seminar) && $seminar->final == 0)
                            <p>Belum difinalisasi</p>
                        @elseif (isset($seminar) && $seminar->final != 0)
                            <p>Sudah difinalisasi</p>
                        @else
                            <p>Belum terdaftar seminar</p>
                        @endif
                        <h4 class="report-heading">Daftar Tugas</h4>
                        @if (count($tugass) > 0)
                            <form action="/tim_ta/ta1/administrasi/change_tugas_status" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengubah progress summary mahasiswa?');">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tugas</th>
                                        <th>Tanggal, Waktu</th>
                                        <th>Pengumpulan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach($tugass as $tugas)
                                        <tr>
                                            <td>{{$counter++}}</td>
                                            <td>{{$tugas->judul}}</td>
                                            <td>{{App\Http\Controllers\DateID::formatDateTime($tugas->tenggat_waktu, true)}}</td>
                                            <td>
                                                @if ($tugas->status_pengumpulan == 0)
                                                    <input type="checkbox" class="form-control" name="submit-task-status-{{$tugas->id}}">
                                                @else
                                                    <input type="checkbox" class="form-control" name="submit-task-status-{{$tugas->id}}" checked>
                                                @endif
                                                <input type="hidden" class="form-control" name="task-id[]" value="{{$tugas->id}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" class="form-control" name="progress-id" value="{{$summary->progress_id}}">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        @else
                            <p>Belum ada tugas dalam perkuliahan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection