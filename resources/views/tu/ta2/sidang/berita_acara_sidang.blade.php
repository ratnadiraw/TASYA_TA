@extends('layouts.ta2.tu')
@section('title')
    <title>Daftar Berita Acara Sidang | TU</title>
@endsection
@section('content')
    <div class="container">
        <h3>Finalisasi Sidang</h3>

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
            <div class="col-md-12 scrollable">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Ruangan</th>
                        <th>Waktu</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($listOfSidang as $sidang)
                        <tr>
                            <td>{{$sidang->nim}}</td>
                            <td>{{$sidang->nama}}</td>
                            <td>{{$sidang->ruangan}}</td>
                            <td>
                                {{$sidang->tanggal}}
                            </td>
                            <td>
                                <form action="/tu/ta2/administrasi/edit_progress_summary/{{$sidang->ps_id}}" method="get">
                                    <button class="btn btn-primary"> View </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else

        @endif
    </div>

@endsection