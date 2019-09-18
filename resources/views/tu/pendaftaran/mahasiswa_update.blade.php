@extends('layouts.tu')
@section('title')
    <title>Ubah Mahasiswa</title>
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
            <div class="card-header"><h3>Ubah Data Mahasiswa</h3></div>
            <div class="card-body">
                <form action="/tu/pendaftaran/updatemahasiswa/{{$mahasiswa->user_id}}" method="POST">
                    <div class="row">     
                        <div class="col-md-7">      
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="NIM">NIM:</label>
                                <input name="NIM" type="text" class="form-control" id="NIM" value="{{$mahasiswa->nim}}">
                            </div>
                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{$mahasiswa->nama}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{$mahasiswa->email}}">
                            </div>
                            <div class="form-group">
                                <label for="generation">Angkatan:</label>
                                <input name="generation" type="text" class="form-control" id="generation" value="{{$mahasiswa->angkatan}}">
                            </div>
                            <div class="form-group">
                                <label for="sks_lulus">Jumlah SKS Lulus:</label>
                                <input name="sks_lulus" type="text" class="form-control" id="sks_lulus" value="{{$mahasiswa->jumlah_sks_lulus}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary align-self-center">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
