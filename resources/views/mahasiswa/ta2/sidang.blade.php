@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Sidang | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-8 edit-mom">
                <div class="card-header"><h3>Sidang</h3></div>
                    <div class="add-bimbingan-content">
                        <div class="add-bimbingan-content-field font-weight-bold">
                            NIM/NAMA: {{$mahasiswa->nim}}/{{$mahasiswa->nama}}
                        </div>

                        <div class="row">
                            <div class="col-md-3 add-bimbingan-content-field font-weight-bold">
                                Ruangan:
                            </div>
                            <div class="col-md-5">
                                {{$data_sidang->ruangan}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 add-bimbingan-content-field font-weight-bold">
                                Waktu:
                            </div>
                            <div class="col-md-5">
                                {{$data_sidang->tanggal}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection