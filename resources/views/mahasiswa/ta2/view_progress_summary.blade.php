@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Progress Summary | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <h3>Progress Summary Mahasiswa</h3>
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
            {{--Profile--}}
            <div class="col-md-6">
                <h3>Profile</h3>
                <form class="form-group" action="/mahasiswa/ta2/rubah_judul" method="POST">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Nama:</td>
                            <td>{{$data_summary->nama}}</td>
                        </tr>
                        <tr>
                            <td>NIM:</td>
                            <td>{{$data_summary->nim}}</td>
                        </tr>
                        <tr>
                            <td>Topik:</td>
                            <td>{{$data_summary->topik}}</td>
                        </tr>
                        @if (count($dosens) > 0)
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td>Dosen Pembimbing:</td>
                                    <td>{{$dosen->nama}}</td>
                                </tr>
                            @endforeach
                        @endif

                        @if($ada_seminar == false && $mahasiswa_daftar_seminar == true)
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="ta_id" value="{{$data_summary->ta_id}}">
                            <tr>
                                <td>Judul:</td>
                                <td>
                                    <input type="text" class="form-control" name="judul" value="{{$data_summary->judul}}">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </td>
                            </tr>
                        @elseif($lulus_seminar && $ada_sidang == false && $mahasiswa_daftar_sidang == true)
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="ta_id" value="{{$data_summary->ta_id}}">
                            <tr>
                                <td>Judul:</td>
                                <td>
                                    <input type="text" class="form-control" name="judul" value="{{$data_summary->judul}}">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>Judul:</td>
                                <td>{{$data_summary->judul}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </form>
            </div>

            {{--Progress--}}
            <div class="col-md-6">
                <h3>Progress</h3>
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>Kehadiran Kelas:</td>
                        <td>{{$data_summary->jumlah_kehadiran_kelas}}</td>
                    </tr>
                    <tr>
                        <td>Kehadiran Seminar:</td>
                        <td>{{$data_summary->jumlah_kehadiran_seminar}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Bimbingan:</td>
                        <td>{{count($bimbingans)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            {{--Seminar&Sidang--}}
            <div class="col-md-6">
                <div class="riwayat bottom-gap-8p">
                    <h3>Administrasi</h3>
                    <h6>Riwayat: <a href="/mahasiswa/ta2/view_riwayat/{{$data_summary->ta_id}}">Lihat Riwayat</a></h6>
                </div>

                @if($lulus_seminar)
                    <table class="table table-striped">
                        <tr>
                            <td>Seminar: </td>
                            <td><b>Telah lulus seminar</b></td>
                        </tr>
                        <tr>
                            <td> Berita acara seminar </td>
                            <td> <a href="/mahasiswa/ta2/berita_acara/{{$seminar_done->seminar_id}}"> View berita acara seminar</a></td>
                        </tr>
                    </table>
                @elseif($ada_seminar == true)
                    <table class="table table-striped">
                        <tr>
                            <td>Seminar: </td>
                            <td><b>Sudah terdaftar seminar</b></td>
                            <td> <a href="/mahasiswa/ta2/view_seminar/{{$seminar_pending->seminar_id}}"> Lihat jadwal</a></td>
                        </tr>
                    </table>

                @elseif($ada_seminar == false && $mahasiswa_daftar_seminar == true)
                    <table class="table table-striped">
                        <tr>
                            <td>Seminar: </td>
                            <td><b>Sedang mendaftar seminar</b></td>
                        </tr>
                    </table>
                @else
                    <form action="/mahasiswa/ta2/daftar_seminar" method="POST">
                        <table class="table table-striped">
                            <tr>
                                <td>Seminar: </td>
                                <td>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="nim_mahasiswa" value="{{$data_summary->nim}}">
                                    <input type="hidden" class="form-control" name="ta_id" value="{{$data_summary->ta_id}}">
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                @endif

                @if($lulus_seminar)
                    <form action="/mahasiswa/ta2/daftar_sidang" method="POST">
                        <table class="table">
                            @if ($sidang_lulus)
                                <tr>
                                    <td>Sidang: </td>
                                    <td><b>Telah lulus sidang</b></td>
                                </tr>
                                <tr>
                                    <td>Dokumen Finalisasi</td>
                                    <td> <a href="/mahasiswa/ta2/view_berita_acara_individual/{{$sidang_lulus->sidang_id}}"> View Dokumen Finalisasi </a></td>
                                </tr>
                            @elseif($sidang_selesai)
                                <tr>
                                    <td>Sidang : </td>
                                    <td><b>Telah selesai sidang</b></td>
                                </tr>
                            @elseif($ada_sidang == true)
                                <td>Sidang : </td>
                                <td><b>Sudah terdaftar sidang</b></td>
                                <td> <a href="/mahasiswa/ta2/view_sidang/{{$sidang_pending->sidang_id}}"> View Jadwal</a></td>
                            @elseif($ada_sidang == false && $mahasiswa_daftar_sidang == true)
                                <td>Sidang : </td>
                                <td><b>Sedang mendaftar sidang</b></td>
                            @else
                                <td>Sidang : </td>
                                <td>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="nim_mahasiswa" value="{{$data_summary->nim}}">
                                    <input type="hidden" class="form-control" name="ta_id" value="{{$data_summary->ta_id}}">
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                </td>
                            @endif
                        </table>
                    </form>
                @endif
            </div>

            {{--Tugas--}}
            <div class="col-md-6">
                <h3>Kelas Mahasiswa</h3>
                <table class="table table-striped">
                    <tbody>
                    <div class="form-group">
                        @foreach($all_kelas_mahasiswa as $kelas)
                            <tr>
                                <td>{{$kelas->tahun}}/{{$kelas->semester}}</td>
                                <td>
                                    {{$kelas->jumlah_kehadiran_kelas}}
                                </td>
                            </tr>
                        @endforeach
                    </div>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                    <th>Kelas</th>
                    <th>Tugas</th>
                    <th>Judul Tugas</th>
                    <th class="text-center">Sudah Dinilai</th>
                    </thead>

                    @foreach($all_tugas as $cnt => $tugas)
                        <tbody>
                        <tr>
                            <td>{{$tugas->tahun}}/{{$tugas->semester}}</td>
                            <td>Tugas {{$cnt + 1}}</td>
                            <td><a href="/dosen/ta2/kelas/{{$tugas->tugas_id}}/{{basename($tugas->path)}}">{{$tugas->judul}}</a></td>
                            <td>
                                @if($tugas->sudah_dinilai == 1)
                                    <span style="color: green">Sudah Dinilai 🗸</span>
                                @else
                                    <span style="color: red">Belum Dinilai ✕</span>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection