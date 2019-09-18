{{--29--}}
@extends('layouts.app')
@section('title')
    <title>TA1 | Daftar Pengumuman</title>
@endsection
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header"><h3>{{$pengumuman->judul}}</h3></div>
                    <div class="card-body">
                        {{$pengumuman->konten}}
                    </div>
                    <div class="card-footer">
                        <p style="margin-top: 8px; margin-bottom: 8px;">Start <i>{{App\Http\Controllers\DateID::formatDate($pengumuman->tanggal_mulai, true)}}</i></p>
                        <p style="margin-top: 8px; margin-bottom: 8px;">End <i>{{App\Http\Controllers\DateID::formatDate($pengumuman->tanggal_berakhir, true)}}</i></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Pengumuman Tugas Akhir I
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