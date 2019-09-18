@extends('layouts.ta2.dosen')

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
                        <tr>
                            <td>Judul:</td>
                            <td>
                                {{$data_summary->judul}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
                    <h6>Riwayat: <a href="/dosen/ta2/progress_summary/view_riwayat/{{$data_summary->ta_id}}">Lihat Riwayat</a></h6>
                </div>
                @if($lulus_seminar)
                    <table class="table table-striped">
                        <tr>
                            <td>Seminar : </td>
                            <td><b>Telah lulus seminar</b></td>
                        </tr>
                        <tr>
                            <td> Berita acara seminar : </td>
                            <td> <a href="/dosen/ta2/seminar/view_berita_acara/{{$seminar_done->seminar_id}}"> View berita acara seminar</a></td>
                        </tr>
                    </table>
                @elseif($ada_seminar == true)
                    <table class="table table-striped">
                        <tr>
                            <td>Seminar : </td>
                            <td><b>Sudah terdaftar seminar</b></td>
                            <td> <a href="/dosen/ta2/seminar/edit_seminar_individual/{{$seminar_pending->seminar_id}}"> Edit jadwal</a></td>
                        </tr>
                    </table>

                @elseif($ada_seminar == false && $mahasiswa_daftar_seminar == true)
                    <table class="table table-striped">
                        <tr>
                            <td>Seminar : </td>
                            <td><b>Sedang mendaftar seminar</b></td>
                        </tr>
                    </table>
                @else
                    <table class="table table-striped">
                        <tr>
                            <td>Seminar : </td>
                            <td>
                                Mahasiswa belum mendaftar
                            </td>
                        </tr>
                    </table>
                @endif

                @if($lulus_seminar)
                    <table class="table table-striped">
                        @if ($sidang_lulus)
                            <tr>
                                <td>Sidang : </td>
                                <td><b>Telah lulus sidang</b></td>
                            </tr>
                            <tr>
                                <td>Dokumen Finalisasi</td>
                                <td> <a href="/dosen/ta2/sidang/view_berita_acara_individual/{{$sidang_lulus->sidang_id}}"> View Dokumen Finalisasi </a></td>
                            </tr>
                        @elseif($sidang_selesai)
                            <tr>
                                <td>Sidang : </td>
                                <td><b>Telah selesai sidang</b></td>
                            </tr>
                            <tr>
                                <td>Dokumen Finalisasi</td>
                                <td> <a href="/dosen/ta2/sidang/view_berita_acara_individual/{{$sidang_selesai->sidang_id}}"> View Dokumen Finalisasi</a></td>
                            </tr>
                        @elseif($ada_sidang == true)
                            <tr>
                                <td>Sidang : </td>
                                <td><b>Sudah terdaftar sidang</b></td>

                                <td> <a href="/dosen/ta2/sidang/edit_sidang/{{$sidang_pending->sidang_id}}"> View Jadwal</a></td>
                            </tr>
                        @elseif($ada_sidang == false && $mahasiswa_daftar_sidang == true)
                            <tr>
                                <td>Sidang : </td>
                                <td><b>Sedang mendaftar sidang</b></td>
                            </tr>
                        @else
                            <tr>
                                <td>Sidang : </td>
                                <td>
                                    Mahasiswa belum mendaftar
                                </td>
                            </tr>
                        @endif
                    </table>
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
    </div>
@endsection