{{--11--}}
@extends('layouts.ta1.dosen')
@section('title')
    <title>TA1 | Daftar Bimbingan</title>
@endsection
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header"><h3>Daftar MoM Bimbingan</h3></div>
            <div class="card-body">
                @if (count($listOfTopikBimbingan) > 0)
                    @foreach($listOfTopikBimbingan as $topikBimbingan)
                        <h4 class="bold">{{$topikBimbingan->nama}}</h4>
                        @php
                            $listOfTA = $topikBimbingan->ongoing_TA1_Tugas_Akhir;
                        @endphp
                        @if (count($listOfTA) > 0)
                            <table class="table table-striped tabel-pemilihan-mahasiswa" id="bimbingan-mahasiswa-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listOfTA as $key => $TA)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$TA->mahasiswa['nama']}}</td>
                                            <td>{{$TA->mahasiswa['nim']}}</td>
                                            <td>
                                                <a href="/dosen/ta1/bimbingan/perkembangan_bimbingan/{{$TA->id}}" class="btn btn-primary">Lihat daftar MoM</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada mahaswiswa pada topik ini.</p>
                        @endif
                    @endforeach
                @else
                    <p>Anda belum memiliki mahasiswa bimbingan.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
@endsection