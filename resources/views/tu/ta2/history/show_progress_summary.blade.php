@extends('layouts.ta2.tu')

@section('title')
    <title>Progress Summary Mahasiswa | TU</title>
@endsection
@section('content')
    <div class="container">
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
                <h3>Progress</h3>
                <table class="table table-striped">
                    <tbody>
                    <div class="form-group">
                        <tr>
                            <td>Jumlah Kehadiran Kelas:</td>
                            <td>{{$data_summary->jumlah_kehadiran_kelas}}</td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <td>Jumlah Kehadiran Seminar:</td>
                            <td>{{$data_summary->jumlah_kehadiran_seminar}}</td>
                        </tr>
                    </div>
                    <tr>
                        <td>Jumlah Bimbingan:</td>
                        <td>{{count($bimbingans)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
        {{--Seminar--}}
        <div class="col-md-6">
            <h3> Administrasi </h3>
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
            @elseif($ada_seminar == true or $mahasiswa_daftar_seminar == true && $ada_seminar == false)
                <table class="table">
                    <tr>
                        <td>Seminar:</td>
                        <td><b>Belum lulus seminar</b></td>
                    </tr>
                </table>
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
                    <table class="table">
                        <tr>
                            <td>Sidang : </td>
                            <td><b>Sudah lulus sidang</b></td>
                        </tr>
                        <tr>
                            <td>Nilai akhir : </td>
                            <td>Sudah dinilai oleh tim TA</td>
                            <td><b><a href="/tu/ta2/sidang/view_berita_acara_individual/{{$sidang_lulus->sidang_id}}">View nilai akhir</a></b></td>
                        </tr>
                    </table>
                @elseif($selesai_sidang or $ada_sidang == true or $mahasiswa_daftar_sidang == true && $ada_sidang == false)
                    <table class="table">
                        <tr>
                            <td>Sidang:</td>
                            <td><b>Belum lulus sidang</b></td>
                        </tr>
                    </table>
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
            <h3>Tugas Mahasiswa</h3>
            <table class="table">
                <thead>
                <th>Tugas</th>
                <th>Judul Tugas</th>
                <th class="text-center">Sudah Dinilai</th>
                </thead>

                @foreach($all_tugas_mahasiswa as $cnt => $tugas)
                    <tbody>
                    <tr>
                        <td>Tugas {{$cnt + 1}}</td>
                        <td>
                            <label>{{$tugas->judul}}</label>
                        </td>
                        <td class="text-center">
                            @if ($tugas->sudah_dinilai == 1)
                                <span style="color: green">Sudah dinilai 🗸</span>
                            @else
                                <span style="color: red">Belum dinilai ✕</span>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
    </form>
</div>
@endsection