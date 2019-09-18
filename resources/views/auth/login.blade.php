@extends('layouts.app')
@section('title')
    <title>Login</title>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Alamat E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ingat Saya
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Masuk
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <span style="font-size: small">Jika Anda menemukan kesulitan, keluhan ataupun saran anda dapat mengirimkan email di <a href="mailto:tasya@informatika.org?subject=Feedback Tasya">tasya@informatika.org</a>
                    </span>
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
