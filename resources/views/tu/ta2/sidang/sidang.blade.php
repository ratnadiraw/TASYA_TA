@extends('layouts.ta2.tu')
@section('title')
    <title>Sidang | TU</title>
@endsection
@section('content')
    <div class="container">
        <h3>Terdaftar Sidang</h3>
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
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Judul</th>
                        <th>Edit Sidang Info</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($listOfSidang as $sidang  )
                        <tr>
                            <td>{{$sidang->nim}}</td>
                            <td>{{$sidang->nama}}</td>
                            <td>{{$sidang->ruangan}}</td>
                            <td>{{substr($sidang->tanggal,0,10)}}</td>
                            <td>{{substr($sidang->tanggal,10)}}</td>
                            <td>{{$sidang->judul}}</td>
                            <td>
                                <form action="/tu/ta2/progress_summary/edit_progress_summary/{{$sidang->ps_id}}" method="get">
                                    <button class="btn btn-primary">View Progress Summary</button>
                                </form>
                            </td>
                            {{--<td> <a href="/tu/ta2/sidang/edit_sidang/{{$sidang->sidang_id}}">View</a> </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        @else

        @endif
    </div>

@endsection