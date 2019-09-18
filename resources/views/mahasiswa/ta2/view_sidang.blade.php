@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Ubah Informasi Sidang | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-8 edit-mom">
                <div class="card-header"><h3>Sidang</h3></div>
                <div class="card-body">
                    <div class="add-bimbingan-content">
                        <div class="add-bimbingan-content-field font-weight-bold">
                            NIM / NAMA: {{$data_sidang->nim}} / {{$data_sidang->nama}}
                        </div>

                        @foreach($dosen_penguji as $dosen)
                            <div class="row">
                                <div class="col-md-9 ">
                                    Penguji : {{$dosen->nama}}
                                </div>
                            </div>
                        @endforeach

                        <div class="row">
                            <div class="add-bimbingan-content-field font-weight-bold">
                                Ruangan:
                            </div>
                            {{$data_sidang->ruangan}}
                        </div>

                        <div class="row">
                            <div class="add-bimbingan-content-field font-weight-bold">
                                Waktu:
                            </div>
                            {{$data_sidang->tanggal}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection