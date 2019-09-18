@extends('layouts.ta2.timta')
@section('title')
    <title>Pendaftar Sidang | Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <h3>Pendaftar Sidang</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (count($listOfPendaftar) > 0)
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Daftarkan</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listOfPendaftar as $pendaftar)
                    <tr>
                        <td>{{$pendaftar->nim}}</td>
                        <td>{{$pendaftar->nama}}</td>
                        <td>
                            <form action="/tim_ta/ta2/progress_summary/edit_progress_summary/{{$pendaftar->ps_id}}" method="get">
                                <button class="btn btn-primary">View Progress Summary</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else

        @endif
    </div>

@endsection