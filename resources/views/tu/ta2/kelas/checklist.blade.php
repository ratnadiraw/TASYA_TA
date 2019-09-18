@extends('layouts.ta2.tu')
@section('title')
    <title>Checklist Tugas | TU</title>
@endsection
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="card  col-md-10 gap-bottom">
                <div class="card-header"><h3>{{$tugas->judul}}</h3></div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Mahasiswa</th>
                                <th>Sudah dinilai?</th>
                            </tr>
                            </thead>
                            @foreach($all_tugas_mahasiswa as $tugas_mahasiswa)
                                <tbody>
                                <tr>
                                    <td>{{$tugas_mahasiswa->nim}}</td>
                                    <td>{{$tugas_mahasiswa->nama}}</td>
                                    <td>
                                        @if($tugas_mahasiswa->sudah_dinilai)
                                            <input type="checkbox" name="sudah_dinilai[]" value="{{$tugas_mahasiswa->id}}" checked>
                                        @else
                                            <input type="checkbox" name="sudah_dinilai[]" value="{{$tugas_mahasiswa->id}}">
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <div class="justify-content-center text-center">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection