@extends('layouts.ta2.timta')
@section('title')
    <title>Lampiran Berita Acara Sidang | Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <h3>Finalisasi</h3>

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
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Judul TA 2</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listOfSidang as $sidang)
                    <tr>
                        <td>{{$sidang->nim}}</td>
                        <td>{{$sidang->nama}}</td>
                        <td>{{$sidang->judul}}</td>
                        @if($sidang->status_pendaftaran == 6)
                            <td> Sudah dinilai</td>
                        @else
                            <td> Belum dinilai </td>
                        @endif
                        <td>
                            <a href="/tim_ta/ta2/administrasi/edit_progress_summary/{{$sidang->ps_id}}"> View </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else

        @endif
    </div>

@endsection