@extends('layouts.ta2.timta')
@section('title')
    <title>Daftar Sidang | Tim TA</title>
@endsection
@section('content')
    <div class="container">

        <h3>Jadwal Sidang</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (count($listOfSidang) > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Topik</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($listOfSidang as $sidang  )
                        <tr>
                            <td>{{$sidang->nim}}</td>
                            <td>{{$sidang->nama}}</td>
                            <td>{{$sidang->topik}}</td>
                            <td>{{$sidang->ruangan}}</td>
                            <td>{{substr($sidang->tanggal, 0, 10)}}</td>
                            <td>{{substr($sidang->tanggal, 10)}}</td>
                            <td> <a href="/tim_ta/ta2/administrasi/edit_progress_summary/{{$sidang->ps_id}}"> View </a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        @else

        @endif
    </div>

@endsection