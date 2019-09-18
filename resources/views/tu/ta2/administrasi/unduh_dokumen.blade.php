@extends('layouts.ta2.tu')
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

        <div class="card">
            <div class="card-header"><h3>Dokumen Seminar</h3></div>
            <div class="card-body">
                <ul>
                    <li>
                        <a href="downloadFormSeminar">Form Seminar TA II</a>
                    </li>
                </ul>

            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3>Dokumen Sidang</h3></div>
            <div class="card-body">
                <ul>
                    <li><a href="downloadFormSidang">Form Sidang TA II</a></li>
                    <li><a href="downloadFormPembatalanSidang">Form Pembatalan Sidang TA II</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection