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
            <div class="card-header"><h3>Ubah Data Tim TA</h3></div>
            <div class="card-body">
                <form action="/tu/pendaftaran/updatetimta/{{$timta->user_id}}" method="POST">
                    <div class="row">     
                        <div class="col-md-7">      
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           
                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{$timta->nama}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{$timta->email}}">
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary align-self-center">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
