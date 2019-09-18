@extends('layouts.ta2.dosen')

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
            <div class="scrollable-x">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Ruangan</th>
                        <th>Waktu</th>
                        <th>Berita Acara Seminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($listOfSeminar as $seminar)
                        <tr>
                            <td>{{$seminar->nim}}</td>
                            <td>{{$seminar->nama}}</td>
                            <td>{{$seminar->ruangan}}</td>
                            <td>
                                {{$seminar->tanggal}}
                            </td>
                            <td>
                                <a href="/dosen/ta2/progress_summary/view_progress_summary/{{$seminar->ps_id}}"> View Progress Summary</a>
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