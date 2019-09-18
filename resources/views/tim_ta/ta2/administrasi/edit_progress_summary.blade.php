@extends('layouts.ta2.timta')
@section('title')
    <title>Ubah Progress Mahasiswa | Tim TA</title>
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
        <form action="/tim_ta/ta2/administrasi/edit_progress_summary_submit" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="ps_id" value="{{$data_summary->ps_id}}">
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
                            <td>
                                {{count($bimbingans)}}
                                @if(count($bimbingans) != 0)
                                    <?php for($i = 1; $i <=8; $i++) echo "&nbsp;" ?>
                                    <a href="/tim_ta/ta2/administrasi/bimbingan/{{$data_summary->ta_id}}">
                                        Lihat bimbingan
                                    </a>
                                @endif
                            </td>
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
                        <h6>Riwayat: <a href="/tim_ta/ta2/administrasi/view_riwayat/{{$data_summary->ta_id}}">Lihat Riwayat</a></h6>
                    </div>
                    @if($lulus_seminar)
                        <table class="table">
                            <tr>
                                <td>Seminar : </td>
                                <td><b>Telah lulus seminar</b></td>
                            </tr>
                            <tr>
                                <td> Hasil Seminar : </td>
                                <td> <a href="/tim_ta/ta2/seminar/view_berita_acara_individual/{{$seminar_done->seminar_id}}"> View berita acara seminar</a></td>
                            </tr>
                        </table>
                    @elseif($ada_seminar == true)
                        <table class="table">
                            <tr>
                                <td>Seminar : </td>
                                <td><b>Sudah terdaftar seminar</b></td>
                                <td> <a href="/tim_ta/ta2/seminar/edit_seminar_individual/{{$seminar_pending->seminar_id}}"> Edit jadwal</a></td>
                            </tr>
                        </table>

                    @elseif($ada_seminar == false && $mahasiswa_daftar_seminar == true)
                        <table class="table">
                            <tr>
                                <td>Seminar : </td>
                                <td><b>Sedang mendaftar seminar</b></td>
                            </tr>
                        </table>
                    @else
                        <table class="table">
                            <tr>
                                <td>Seminar : </td>
                                <td>
                                    mahasiswa belum mendaftar
                                </td>
                            </tr>
                        </table>
                    @endif

                    @if($lulus_seminar)
                        <table class="table">
                            @if($lulus)
                                <tr>
                                    <td>Sidang : </td>
                                    <td><b>Telah Dinilai Tim TA</b></td>
                                </tr>
                                <tr>
                                    <td>Finalisasi : </td>
                                    <td> Nilai sudah final</td>
                                    <td> <a href="/tim_ta/ta2/sidang/view_berita_acara_final/{{$sidang_lulus->sidang_id}}"> View Finalisasi</a></td>
                                </tr>
                            @elseif($lulus_sidang)
                                <tr>
                                    <td>Sidang : </td>
                                    <td><b>Telah Dinilai Tim TA</b></td>
                                </tr>
                                <tr>
                                    <td>Finalisasi : </td>
                                    <td> Sudah dinilai, bisa diubah</td>
                                    <td> <a href="/tim_ta/ta2/sidang/view_berita_acara/{{$sidang_lulus->sidang_id}}"> View Finalisasi</a></td>
                                </tr>
                            @elseif($sidang_selesai)
                                <tr>
                                    <td>Sidang : </td>
                                    <td><b> Sidang telah selesai</b></td>
                                </tr>
                                <tr>
                                    <td>Finalisasi : </td>
                                    <td> Menunggu penilaian Tim TA</td>
                                    <td> <a href="/tim_ta/ta2/sidang/view_berita_acara/{{$sidang_selesai->sidang_id}}"> Nilai Dokumen Finalisasi TA 2</a></td>
                                </tr>
                            @elseif($ada_sidang == true)
                                <tr>
                                    <td>Sidang : </td>
                                    <td><b>Sudah terdaftar sidang</b></td>
                                    <td> <a href="/tim_ta/ta2/sidang/edit_sidang_individual/{{$sidang_pending->sidang_id}}"> Edit Sidang </a></td>
                                </tr>
                            @elseif($ada_sidang == false && $mahasiswa_daftar_sidang == true)
                                <tr>
                                    <td>Sidang : </td>
                                    <td><b>Mahasiswa sedang mendaftar sidang</b></td>
                                </tr>
                            @else
                                <tr>
                                    <td>Sidang : </td>
                                    <td>
                                        mahasiswa belum mendaftar
                                    </td>
                                </tr>
                            @endif
                        </table>
                    @endif
                </div>

                {{--Tugas Kelas--}}
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
                    <label>Cek pada checkbox jika mahasiswa sudah mengumpulkan tugas</label>
                    <table class="table">
                        <thead>
                        <th>Kelas</th>
                        <th>Tugas</th>
                        <th>Judul Tugas</th>
                        <th class="text-center">Sudah Dinilai</th>
                        </thead>

                        @foreach($all_tugas_mahasiswa as $cnt => $tugas)
                            <tbody>
                            <tr>
                                <td>{{$tugas->tahun}}/{{$tugas->semester}}</td>
                                <td>Tugas {{$cnt + 1}}</td>
                                <td>
                                    <label>{{$tugas->judul}}</label>
                                </td>
                                <td class="text-center">
                                    @if ($tugas->sudah_dinilai == 1)
                                        <input type="checkbox" class="form-check-input" value="{{$tugas->tugas_id}}" name="sudah_dinilai[]" checked>
                                    @else
                                        <input type="checkbox" class="form-check-input" value="{{$tugas->tugas_id}}" name="sudah_dinilai[]">
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="row justify-content-center form-group py-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection