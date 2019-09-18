@extends('layouts.ta2.dosen')
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
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Ruangan</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listOfSidang as $sidang  )
                    <tr>
                        <td>{{$sidang->nim}}</td>
                        <td>{{$sidang->nama}}</td>
                        <td>{{$sidang->judul}}</td>
                        <td>{{substr($sidang->tanggal,0,10)}}</td>
                        <td>{{substr($sidang->tanggal,10)}}</td>
                        <td>{{$sidang->ruangan}}</td>
                        <td> <a href="/dosen/ta2/sidang/view_sidang_penguji/{{$sidang->sidang_id}}"> View </a> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else

        @endif
    </div>

@endsection