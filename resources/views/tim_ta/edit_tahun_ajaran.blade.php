@extends('layouts.timta')
@section('title')
    <title>Ubah Tahun Ajaran</title>
@endsection
@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header"><h3>Ubah Tahun Ajaran</h3></div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/tim_ta/update_tahun_ajaran" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" value="{{$tahunAjaran->id}}">
                    <div class="form-group col-md-4">
                        <label for="semester">Semester</label>
                        <select name="semester" class="form-control" id="semester">
                            @if($tahunAjaran->semester === 1)
                                <option value="1" selected>I</option>
                                <option value="2">II</option>
                                <option value="3">III</option>
                            @elseif ($tahunAjaran->semester === 2)
                                <option value="1">I</option>
                                <option value="2"  selected>II</option>
                                <option value="3">III</option>
                            @elseif ($tahunAjaran->semester === 3)
                                <option value="1">I</option>
                                <option value="2">II</option>
                                <option value="3" selected>III</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="year">Tahun</label>
                        <input class="form-control" id="year" type="text" name="year" value="{{$tahunAjaran->tahun}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="start-date">Tanggal Mulai</label>
                        <input class="form-control" id="start-date" type="date" name="start-date" value="{{$tahunAjaran->tanggal_mulai}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="end-date">Tanggal Selesai</label>
                        <input class="form-control" id="end-date" type="date" name="end-date" value="{{$tahunAjaran->tanggal_selesai}}">
                    </div>
                    <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection