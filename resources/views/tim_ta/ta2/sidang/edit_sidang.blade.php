@extends('layouts.ta2.timta')
@section('title')
    <title>Ubah Lampiran Berita Acara Sidang | Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-8 edit-mom">
                <div class="card-header">Sidang</div>
                <div class="card-body">
                    <form action="/tim_ta/ta2/sidang/edit_sidang_individual_submit" enctype="multipart/form-data" method="POST" class="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="sidang_id" value="{{$data_sidang->sidang_id}}">
                        <div class="add-bimbingan-content">
                            <div class="add-bimbingan-content-field font-weight-bold">
                                NIM/NAMA: {{$data_sidang->nim}}/{{$data_sidang->nama}}
                            </div>

                            <div class="row">
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    Penguji 1:
                                </div>
                                    <div class="dropdown">
                                        <select name="dosen1">
                                            <div class="dropdown-menu">
                                                @foreach($dosen_penguji as $dosen)
                                                    <option class="dropdown-item" value="{{$dosen['nip']}}">{{$dosen['nama'] . "  "}}</option>
                                                @endforeach
                                            </div>
                                        </select>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    Penguji 2:
                                </div>
                                <div class="dropdown">
                                    <select name="dosen2">
                                        <div class="dropdown-menu">
                                            @foreach($dosen_penguji as $dosen)
                                                <option class="dropdown-item" value="{{$dosen['nip']}}">{{$dosen['nama'] . "  "}}</option>
                                            @endforeach
                                        </div>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input class="form-control btn-md btn-primary" type="submit" required >
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection