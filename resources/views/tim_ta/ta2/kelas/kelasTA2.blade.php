@extends('layouts.ta2.timta')
@section('title')
    <title>Daftar Kelas | Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Kelas</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Tugas</th>
                            </tr>
                            </thead>
                            @foreach($all_kelas as $kelas)
                                <tbody>
                                <td>{{$kelas->tahun}}</td>
                                <td>{{$kelas->semester}}</td>
                                <td> <a href="/tim_ta/ta2/kelas/tugas/{{$kelas->tahun}}/{{$kelas->semester}}">List Tugas</td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection