@extends('layouts.ta2.timta')
@section('title')
    <title>Daftar Progress Mahasiswa | Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <h3>Daftar Progress Tugas Akhir 2 </h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th> No </th>
                    <th> NIM </th>
                    <th> Mahasiswa </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                @foreach($list_summary as $summary)
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$summary->nim}}</td>
                    <td>{{$summary->nama}}</td>
                    <td>
                        <form action="/tim_ta/ta2/administrasi/edit_progress_summary/{{$summary->ps_id}}" method="get">
                            <button class="btn btn-primary">View</button>
                        </form>
                    </td>
                </tr>
                <?php $no++ ?>
                @endforeach
            </tbody>
        </table>
        {{$list_summary->links()}}
    </div>
@endsection