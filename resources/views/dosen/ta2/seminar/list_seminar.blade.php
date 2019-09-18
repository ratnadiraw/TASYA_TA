@extends('layouts.ta2.dosen')
@section('content')
    <div class="container">
        <h3>Jadwal Seminar</h3>
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
            <form action="/dosen/ta2/seminar/edit_seminar_submit" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th> Edit </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($listOfSeminar as $seminar)
                        <tr>
                            <td>{{$seminar->nim}}</td>
                            <td>{{$seminar->nama}}</td>
                            @if($seminar->ruangan != null)
                                <td>{{$seminar->ruangan}}</td>
                            @else
                                <td> Belum ditentukan </td>
                            @endif
                            {{--<td>--}}
                                {{--<input id="datepicker" type="datetime" class="form-control" name="tanggals[]" value="{{$seminar->tanggal}}">--}}
                                {{--<input type="hidden" class="form-control" name="seminar_ids[]" value="{{$seminar->seminar_id}}">--}}
                            {{--</td>--}}
                            @if($seminar->tanggal != null)
                                <td>{{App\Http\Controllers\DateID::formatDate(substr($seminar->tanggal,0,10), false)}}</td>
                            @else
                                <td> Belum ditentukan </td>
                            @endif

                            @if($seminar->tanggal != null)
                                <td>{{App\Http\Controllers\DateID::formatTime(substr($seminar->tanggal,10))}}</td>
                            @else
                                <td> Belum ditentukan </td>
                            @endif
                            <td><a href="/dosen/ta2/progress_summary/view_progress_summary/{{$seminar->ps_id}}"> View Progress Summary</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        @else

        @endif
    </div>

@endsection