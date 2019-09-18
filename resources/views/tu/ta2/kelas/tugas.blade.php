@extends('layouts.ta2.tu')
@section('title')
    <title>Daftar Tugas | TU</title>
@endsection
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="card  col-md-10 gap-bottom">
                <div class="card-header"><h3>List Tugas</h3></div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Tugas</th>
                            <th>Deadline</th>
                        </tr>
                        </thead>
                        @foreach($all_tugas as $tugas)
                            <tbody>
                            <tr>
                                <td> <a href="/tu/ta2/kelas/tugas/{{$tahun}}/{{$semester}}/{{$tugas->id}}"> {{$tugas->judul}} </a></td>
                                <td>{{App\Http\Controllers\DateID::formatDate($tugas->deadline, false)}}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection