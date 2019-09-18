@extends('layouts.app')
@section('title')
    <title>Generate</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mahasiswa</div>

                    <div class="card-body">
                        <p>Unggah file zip yang berisi file excel untuk generate prioritas topik dosen.</p>
                        <form action="/generate/input" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table>
                                <tr>
                                    <td class="tu-table-td-form"><input name="excel" type="file"></td>
                                    <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Unggah</button></td>
                                </tr>
                            </table>
                        </form>
                        <br>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Dosen</div>

                    <div class="card-body">
                        <p>Unggah file  excel untuk generate topik dosen.</p>
                        <form action="/generate/topik" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table>
                                <tr>
                                    <td class="tu-table-td-form"><input name="excel" type="file"></td>
                                    <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Unggah</button></td>
                                </tr>
                            </table>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Pengumuman Tugas Akhir 1
                    </div>
                    <div class="card-body scrollable">
                        @if (count($listOfPengumumanTA1) > 0)
                            @foreach($listOfPengumumanTA1 as $pengumuman)
                                <a href="/ta1/pengumuman/{{$pengumuman->id}}"><h5>{{$pengumuman->judul}}</h5></a>
                                <p>On: <i>{{App\Http\Controllers\DateID::formatDate($pengumuman->tanggal_mulai, true)}}</i></p>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Pengumuman Tugas Akhir 2
                    </div>
                    <div class="card-body scrollable">
                        @if (count($listOfPengumumanTA2) > 0)
                            @foreach($listOfPengumumanTA2 as $pengumuman)
                                <a href="/ta2/pengumuman/{{$pengumuman->id}}"><h5>{{$pengumuman->judul}}</h5></a>
                                <p>On: <i>{{App\Http\Controllers\DateID::formatDate($pengumuman->tanggal_mulai, true)}}</i></p>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Kalender
                    </div>
                    <div class="card-body">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    {!! $calendar->script() !!}
@endsection
