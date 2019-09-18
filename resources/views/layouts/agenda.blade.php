@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Agenda Tugas Akhir</h3></div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (count($listOfEvent) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Agenda Kegiatan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($listOfEvent as $key => $event)
                                <tr>
                                    <td>{{++$key}}</td>
                                    @if ($event->start_date === $event->end_date)
                                        <td>{{date('d-m-Y', strtotime($event->start_date))}}</td>
                                    @else
                                        <td>{{date('d-m-Y', strtotime($event->start_date))}} - {{date('d-m-Y', strtotime($event->end_date))}}</td>
                                    @endif
                                    <td>{{$event->title}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection