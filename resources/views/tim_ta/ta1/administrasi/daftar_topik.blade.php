{{--31--}}
@extends('layouts.ta1.timta')
@section('title')
    <title>TA1 | Daftar Final Topik</title>
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
        <div class="card">
            <div class="card-header"><h3>Daftar Topik Tugas Akhir</h3></div>
            <div class="card-body">
                @if (count($listOfTopics) > 0)
                    @php
                    $counter = 1;
                    @endphp
                    <table class="table table-striped" id="topik-mahasiswa-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Nama Topik</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($listOfTopics as $topic)
                                @if (isset(${'mahasiswa'.$topic->topik_id}) && count(${'mahasiswa'.$topic->topik_id}) > 0)
                                    @foreach(${'mahasiswa'.$topic->topik_id} as $mahasiswa)
                                        <tr>
                                            <td>{{$counter++}}</td>
                                            <td>{{$mahasiswa->nim_mahasiswa}}</td>
                                            <td>{{$mahasiswa->nama_mahasiswa}}</td>
                                            <td>{{$topic->nama_topik}}</td>
                                            <td>{{$topic->nama_dosen1}}</td>
                                            <td>{{$topic->nama_dosen2}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Belum ada topik.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).ready(function()
            {
                $("#topik-mahasiswa-table").dynatable();
            }
        );
        $.when($('#topik-mahasiswa-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection