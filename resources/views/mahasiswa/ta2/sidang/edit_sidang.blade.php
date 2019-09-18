@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Ubah Informasi Sidang | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-8 edit-mom">
                <div class="card-header">Sidang</div>
                <div class="card-body">
                    <form action="/mahasiswa/ta2/sidang/edit_sidang_submit" enctype="multipart/form-data" method="POST" class="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="sidang_id" value="{{$data_sidang->sidang_id}}">
                        <div class="add-bimbingan-content">
                            <div class="add-bimbingan-content-field font-weight-bold">
                                NIM / NAMA: {{$data_sidang->nim}} / {{$data_sidang->nama}}
                            </div>

                            <div class="row">
                                <div class="col-md-3 add-bimbingan-content-field font-weight-bold">
                                    Penguji:
                                </div>
                                @foreach($dosen_penguji as $dosen)
                                    <div class="col-md-3">{{$dosen->nama . "  "}}</div>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    Ruangan:
                                </div>
                                <input type="text" class="form-control" name="ruangan" value="{{$data_sidang->ruangan}}">
                            </div>

                            <div class="row">
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    Waktu:
                                </div>
                                <input id="datepicker" type="datet" class="form-control" name="tanggal" value="{{$data_sidang->tanggal}}">
                            </div>
                        </div>
                        <input class="form-control btn-md btn-primary" type="submit" required >
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection