{{--15--}}
@extends('layouts.dosen')
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
        <h3>Pengumuman Tugas</h3>
        <form action="/dosen/ta1/administrasi/add_new_pengumuman_kelas" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="form-group col-xs-6 gap">
                    <label for="title">Judul:</label>
                    <input name="title" type="text" class="form-control" id="title">
                </div>
                <div class="form-group col-xs-6 gap">
                    <label for="content">Isi:</label>
                    <textarea name="content" class="form-control" id="content"></textarea>
                </div>
                <div class="form-group col-xs-6 gap">
                    <label for="datetime">Tanggal dan Waktu:</label>
                    <input name="datetime" type="text" class="form-control" id="datetime">
                </div>
                <div class="form-group col-xs-6">
                    <button type="submit" class="btn btn-primary align-self-center">POST</button>
                </div>
            </div>
        </form>
    </div>
@endsection