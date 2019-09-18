@extends('layouts.ta2.tu')

@section('title')
    <title>Ubah Progress Mahasiswa | TU</title>
@endsection
@section('content')
    <div class="container">
        <h3>Data Mahasiswa</h3>
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
                    <tr>
                        <td>Judul:</td>
                        <td>{{$data_summary->judul}}</td>
                    </tr>
                    @if (count($dosens) > 0)
                        @foreach ($dosens as $dosen)
                            <tr>
                                <td>Dosen Pembimbing:</td>
                                <td>{{$dosen->nama}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

            {{--Progress--}}
            <div class="col-md-6">
                <form action="/tu/ta2/progress_summary/edit_progress_summary_submit" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="ps_id" value="{{$data_summary->ps_id}}">
                    <h3>Progress</h3>
                    <table class="table table-striped">
                        <tbody>
                        <div class="form-group">
                            <tr>
                                <td>Jumlah Kehadiran Kelas:</td>
                                <td>
                                    <input type="text" name="jumlah_kehadiran_kelas" class="form-control" value="{{$data_summary->jumlah_kehadiran_kelas}}">
                                </td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <tr>
                                <td>Jumlah Kehadiran Seminar:</td>
                                <td>
                                    <input type="text" name="jumlah_kehadiran_seminar" class="form-control" value="{{$data_summary->jumlah_kehadiran_seminar}}">
                                </td>
                            </tr>
                        </div>
                        <tr>
                            <td>Jumlah Bimbingan:</td>
                            <td>
                                {{count($bimbingans)}}
                                @if(count($bimbingans) != 0)
                                    <?php for($i = 1; $i <=8; $i++) echo "&nbsp;" ?>
                                    <a href="/tu/ta2/progress_summary/bimbingan/{{$data_summary->ta_id}}">
                                        Lihat bimbingan
                                    </a>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row justify-content-center form-group py-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
        {{--Seminar--}}
        <div class="col-md-6">
            <div class="riwayat bottom-gap-8p">
                <h3>Administrasi</h3>
                <h6>Riwayat: <a href="/tu/ta2/administrasi/view_riwayat/{{$data_summary->ta_id}}">Lihat Riwayat</a></h6>
            </div>
            @if($lulus_seminar)
                <table class="table">
                    <tr>
                        <td>Seminar:</td>
                        <td><b>Sudah lulus seminar</b></td>
                    </tr>
                    <tr>
                        <td>Berita Acara Seminar:</td>
                        <td><b><a href="/tu/ta2/seminar/view_lampiran_berita_acara_seminar/{{$seminar_done->seminar_id}}">View berita acara seminar</a></b></td>
                    </tr>
                </table>
            @elseif($ada_seminar == true)
                <table class="table">
                    <tr>
                        <td>Seminar:</td>
                        <td><b><a href="/tu/ta2/seminar/edit_seminar_individual/{{$seminar_pending->seminar_id}}">Edit seminar pending</a></b></td>
                    </tr>

                    @if ($seminar_pending->ruangan != null && $seminar_pending->tanggal != null)
                        <tr>
                            <td>Hasil Seminar:</td>
                            <td><b><a href="/tu/ta2/seminar/add_lampiran_berita_acara_seminar/{{$seminar_pending->seminar_id}}">Isi berita acara seminar</a></b></td>
                        </tr>
                    @endif
                </table>
            @elseif($mahasiswa_daftar_seminar == true && $ada_seminar == false)
                <form action="/tu/ta2/seminar/add_seminar_submit" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="nim_mahasiswa" value="{{$data_summary->nim}}">
                    <input type="hidden" name="jumlah_bimbingan" value="{{count($bimbingans)}}">
                    <input type="hidden" name="jumlah_kehadiran_kelas" value="{{$data_summary->jumlah_kehadiran_kelas}}">
                    <input type="hidden" name="jumlah_kehadiran_seminar" value="{{$data_summary->jumlah_kehadiran_seminar}}">
                    <input type="hidden" class="form-control" name="ta_id" value="{{$data_summary->ta_id}}">
                    <table class="table">
                        <tr>
                            <td>Seminar:</td>
                            <td>
                                <button type="submit" class="btn btn-primary">Daftarkan</button>
                            </td>
                        </tr>
                    </table>
                </form>
            @else
                <table class="table">
                    <tr>
                        <td>Seminar:</td>
                        <td><b>Mahasiswa belum mendaftar</b></td>
                    </tr>
                </table>
            @endif

            @if($lulus_seminar == true)
                @if($lulus_sidang)
                    <form action="/tu/ta2/administrasi/finalisasi_ta" method="POST">
                        <table class="table">
                            <tr>
                                <td>Sidang : </td>
                                <td><b>Sidang telah selesai</b></td>
                            </tr>
                            <tr>
                                <td>Nilai akhir : </td>
                                <td>telah dinilai oleh tim TA</td>
                                <td><b><a href="/tu/ta2/sidang/view_berita_acara_individual/{{$sidang_lulus->sidang_id}}">View nilai akhir</a></b></td>
                            </tr>
                            <tr>
                                <td>Finalisasi matkul</td>
                                <td>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" class="form-control" name="ta_id" value="{{$data_summary->ta_id}}">
                                    <button type="submit" class="btn btn-primary"> Finalisasi </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                @elseif($selesai_sidang)
                    <table class="table">
                        <tr>
                            <td>Sidang:</td>
                            <td><b> Sidang telah selesai</b></td>
                        </tr>
                        <tr>
                            <td>Finalisasi TA 2:</td>
                            <td><b><a href="/tu/ta2/sidang/add_berita_acara_individual/{{$sidang_selesai->sidang_id}}">Edit dokumen finalisasi</a></b></td>
                        </tr>
                    </table>
                @elseif($ada_sidang == true)
                    <table class="table">
                        <tr>
                            <td>Sidang:</td>
                            <td><b><a href="/tu/ta2/sidang/edit_sidang/{{$sidang_pending->sidang_id}}">Edit sidang pending</a></b></td>
                        </tr>

                        @if ($sidang_pending->ruangan != null && $sidang_pending->tanggal != null)
                            <tr>
                                <td>Isi dokumen finalisasi:</td>

                                <td><b><a href="/tu/ta2/sidang/add_berita_acara_individual/{{$sidang_pending->sidang_id}}"> Isi dokumen finalisasi</a></b></td>
                            </tr>
                        @endif
                    </table>
                @elseif($mahasiswa_daftar_sidang == true && $ada_sidang == false)
                    <form action="/tu/ta2/sidang/add_sidang_submit" method="POST">
                        <table class="table">
                            <tr>
                                <td>Sidang:</td>
                                <td>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="nim_mahasiswa" value="{{$data_summary->nim}}">
                                    <input type="hidden" name="jumlah_bimbingan" value="{{count($bimbingans)}}">
                                    <input type="hidden" name="jumlah_kehadiran_kelas" value="{{$data_summary->jumlah_kehadiran_kelas}}">
                                    <input type="hidden" name="jumlah_kehadiran_seminar" value="{{$data_summary->jumlah_kehadiran_seminar}}">
                                    <input type="hidden" class="form-control" name="ta_id" value="{{$data_summary->ta_id}}">
                                    <button type="submit" class="btn btn-primary">Daftarkan</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                @else
                    <table class="table">
                        <tr>
                            <td>Sidang:</td>
                            <td><b>Mahasiswa belum mendaftar sidang</b></td>
                        </tr>
                    </table>
                @endif
            @endif
        </div>


        {{--Tugas--}}
        <div class="col-md-6">
            <form action="/tu/ta2/progress_summary/edit_tugas_submit" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="ps_id" value="{{$data_summary->ps_id}}">
                <h3>Kelas Mahasiswa</h3>
                <label>Jumlah Kehadiran Kelas</label>
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
            </form>
        </div>
    </div>
    </form>
</div>
@endsection