@extends('layouts.ta2.timta')
@section('title')
    <title>Sidang | Tim TA</title>
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
                    <th>Waktu (Year-Month-Date Hour:Minute)</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listOfSidang as $sidang)
                    <tr>
                        <td>{{$sidang->nim}}</td>
                        <td>{{$sidang->nama}}</td>
                        <td>{{$sidang->topik}}</td>
                        <td>
                            @if(!empty($sidang->ruangan))
                                {{ $sidang->ruangan }}
                            @else
                                Belum dijadwalkan.
                            @endif
                        </td>
                        <td>
                            @if(!empty($sidang->tanggal))
                                {{ $sidang->tanggal }}
                            @else
                                Belum dijadwalkan.
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else

        @endif
    </div>

@endsection