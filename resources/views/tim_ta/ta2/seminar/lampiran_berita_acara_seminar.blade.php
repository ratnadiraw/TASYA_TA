@extends('layouts.ta2.timta')
@section('title')
    <title>Lampiran Berita Acara Seminar | Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <h3>Lampiran Berita Acara Seminar</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (count($listOfSeminar) > 0)
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Berita Acara Seminar</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listOfSeminar as $seminar)
                    <tr>
                        <td>{{$seminar->nim}}</td>
                        <td>{{$seminar->nama}}</td>
                        <td>{{$seminar->judul}}</td>
                        <td>
                            {{substr($seminar->tanggal,0,10)}}
                        </td>
                        <td>
                            <a href="/tim_ta/ta2/administrasi/edit_progress_summary/{{$seminar->ps_id}}"> View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else

        @endif
    </div>

@endsection