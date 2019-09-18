@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Riwayat | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-10 edit-mom">
                <div class="card-header"><h3>Riwayat Seminar</h3></div>
                <div class="card-body">
                        @if(count($seminar) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Ruangan</th>
                                    <th>Waktu</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Link Berita Acara</th>
                                </tr>
                            @foreach($seminar as $seminar_data)
                                <tr>
                                    <td>{{$seminar_data->ruangan}}</td>
                                    <td>{{$seminar_data->tanggal}}</td>
                                    <td>{{$seminar_data->judul}}</td>
                                    <td>
                                        @if($seminar_data->status_pendaftaran == 0)
                                            Lolos Cek Progress Summary
                                        @elseif($seminar_data->status_pendaftaran == 1)
                                            Tanggal telah diberikan oleh dosen
                                        @elseif($seminar_data->status_pendaftaran == 2)
                                            Ruangan telah diberikan oleh TU
                                        @elseif($seminar_data->status_pendaftaran == 3)
                                            Seminar telah selesai
                                        @elseif($seminar_data->status_pendaftaran == 4)
                                            Tidak Rekomendasi Sidang
                                        @endif
                                    </td>
                                    <td><a href="/mahasiswa/ta2/berita_acara/{{$seminar_data->seminar_id}}">Lampiran Berita Acara</a></td>
                                </tr>
                            @endforeach
                            </table>
                        @else
                            <div>Belum ada riwayat seminar</div>
                        @endif

                </div>
            </div>
            <div class="card col-md-10 edit-mom">
                <div class="card-header"><h3>Riwayat Sidang</h3></div>
                        @if(count($sidang) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Ruangan</th>
                                    <th>Waktu</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Link Berita Acara</th>
                                </tr>
                            @foreach($sidang as $sidang_data)
                                <tr>
                                    <td>{{$sidang_data->ruangan}}</td>
                                    <td>{{$sidang_data->tanggal}}</td>
                                    <td>{{$sidang_data->judul}}</td>
                                    <td>
                                        @if($sidang_data->status_pendaftaran == 0)
                                            Lolos Cek Progress Summary
                                        @elseif($sidang_data->status_pendaftaran == 1)
                                            Tim TA telah menentukan dosen penguji
                                        @elseif($sidang_data->status_pendaftaran == 2)
                                            Tanggal telah diberikan oleh dosen
                                        @elseif($sidang_data->status_pendaftaran == 3)
                                            Ruangan telah diberikan oleh TU
                                        @elseif($sidang_data->status_pendaftaran == 4)
                                            Sidang telah selesai
                                        @elseif($sidang_data->status_pendaftaran == 5)
                                            TU telah mengisi berita acara sidang
                                        @elseif($sidang_data->status_pendaftaran == 6)
                                            Lulus
                                        @elseif($sidang_data->status_pendaftaran == 100)
                                            Tidak lulus
                                        @endif
                                    </td>
                                    <td><a href="/mahasiswa/ta2/view_berita_acara_individual/{{$sidang_data->sidang_id}}">Lampiran Berita Acara</a></td>
                                </tr>
                            @endforeach
                            </table>
                        @else
                    <div>Belum ada riwayat sidang</div>
                        @endif
                    </table>
            </div>
        </div>
    </div>
@endsection