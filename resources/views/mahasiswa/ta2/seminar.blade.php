@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Seminar | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">Jadwal Seminar</div>
                    <div class="card-body">
                        <div class="add-bimbingan-content">
                            <div class="row">
                                <div class="col-md-3">
                                    NIM / Nama:
                                </div>
                                <div class="font-weight-bold col-md-9">
                                    {{$data_mahasiswa->nim}} / {{$data_mahasiswa->nama}}
                                </div>
                            </div>
                            @if($data_seminar != null)
                                <div class="row">
                                    <div class="col-md-3">
                                        Ruangan:
                                    </div>
                                    <div class="font-weight-bold col-md-9">
                                        {{$data_seminar->ruangan}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        Waktu:
                                    </div>
                                    <div class="font-weight-bold col-md-9">
                                        {{App\Http\Controllers\DateID::formatDateTime($data_seminar->tanggal, false)}}
                                    </div>
                                </div>
                            @else
                                <div class="col-md-8">
                                    <h4>Jadwal Seminar belum ditetapkan</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection