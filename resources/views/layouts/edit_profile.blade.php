@extends('layouts.app')
@section('title')
    <title>Ubah Profil</title>
@endsection
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Ubah Profil</h3></div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form action="/save_profile" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group col-md-4">
                            <label for="name">Nama</label>
                            <input class="form-control" id="name" type="text" name="name" value="{{$user->name}}" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">E-mail</label>
                            <input class="form-control" id="email" type="text" name="email" value="{{$user->email}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="current-password">Password Saat Ini</label>
                            <input class="form-control" id="current-password" type="password" name="current-password">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="new-password">Password Baru</label>
                            <input class="form-control" id="new-password" type="password" name="new-password">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="repeat-password">Masukkan Kembali Password Baru</label>
                            <input class="form-control" id="repeat-password" type="password" name="repeat-password">
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection