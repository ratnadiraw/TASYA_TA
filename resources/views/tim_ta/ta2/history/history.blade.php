@extends('layouts.ta2.timta')
@section('title')
    <title>History | Tim TA</title>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>History Tugas Akhir 2 </h3></div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th> No </th>
                        <th> NIM </th>
                        <th> Mahasiswa </th>
                        <th> Topik </th>
                        <th> Tahun Ajaran </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
					<?php $no = 1 ?>
                    @foreach($all_progress_summary as $progress_summary)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$progress_summary->nim}}</td>
                            <td>{{$progress_summary->nama}}</td>
                            <td>{{$progress_summary->topik}}</td>
                            <td>{{$progress_summary->tahun}}/{{$progress_summary->semester}}</td>
                            <td>
                                <form action="/tim_ta/ta2/history/show_progress_summary/{{$progress_summary->id}}" method="get">
                                    <button class="btn btn-primary">View</button>
                                </form>
                            </td>
                        </tr>
						<?php $no++ ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection