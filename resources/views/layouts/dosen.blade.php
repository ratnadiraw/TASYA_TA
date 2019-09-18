<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dosen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dynatable.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
<div id="app">
    <nav class="navbar-itb navbar navbar-expand-md navbar-dark">
        <div class="container">
            <div class="row bottom-gap-12p">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img style="height: 50px;" src="{{ asset('img/logo_itb_navbar.png') }}" />
                </a>
                <div class="navbar-title">
                    <div class="navbar-title-itb">
                        Institut Teknologi Bandung
                    </div>
                    <div class="navbar-title-ta">
                        TA Program Studi Teknik Informatika
                        @php
                            if (null !== session('tahun_semester')) {
                                $semester = session('tahun_semester')->semester;
                                $tahun = session('tahun_semester')->tahun;
                            }
                        @endphp
                    </div>
                    <div class="navbar-title-ta">
                        @if (isset($tahun) && isset($semester))
                            Semester {{$semester}} Tahun Ajaran {{$tahun}}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row ml-auto">
                <div class="col-sm-12">
                    <div class="navbar-title-ta">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/edit_profile">
                                            Ubah Profil
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                            Keluar
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @guest
    @else
        @yield('navbar')
    @endguest
    <main class="py-4">
        @yield('pengajuan')
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dynatable.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
@yield('scripts')
</body>
</html>
