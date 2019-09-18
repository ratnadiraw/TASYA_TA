@extends('layouts.ta2.timta')
@section('title')
    <title>Seminar | Tim TA</title>
@endsection
@section('content')
    <div class="container">
        <h3>Terdaftar Seminar</h3>
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
            {{--<form action="/tim_ta/ta2/seminar/edit_seminar_submit" method="POST">--}}
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Judul</th>
                        <th>Edit Jadwal</th>
                        {{--<th>Save</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($listOfSeminar as $seminar)
                        <tr>
                            <td>{{$seminar->nim}}</td>
                            <td>{{$seminar->nama}}</td>
                            <td>{{$seminar->ruangan}}</td>
                            <td>{{substr($seminar->tanggal, 0, 10)}}</td>
                            <td>{{substr($seminar->tanggal, 10)}}</td>
                            <td>{{$seminar->judul}}</td>
                            <td>
                                <form action="/tim_ta/ta2/administrasi/edit_progress_summary/{{$seminar->ps_id}}" method="get">
                                    <button class="btn btn-primary">View Progress Summary</button>
                                </form>
                            </td>
                            {{--<td><input type="checkbox" class="form-check-inline" name="seminar_ids[]" value="{{$seminar->seminar_id}}"></td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--<button type="submit" class="btn btn-primary">Save</button>--}}
            {{--</form>--}}
        @else

        @endif
    </div>

@endsection