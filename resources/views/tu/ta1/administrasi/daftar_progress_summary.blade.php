@extends('layouts.ta1.tu')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Daftar Progress Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Progress Mahasiswa Tugas Akhir 1</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (count($summarys) > 0)
                    <table class="table table-striped" id="progress-summmary-TU-table">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> NIM </th>
                                <th> Mahasiswa </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach($summarys as $summary)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$summary->nim}}</td>
                                <td>{{$summary->nama}}</td>
                                <td>
                                    <form action="/tu/ta1/administrasi/edit_progress_summary/{{$summary->id}}" method="get">
                                        <button class="btn btn-primary">Ubah</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $no++ ?>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Belum ada progress mahasiswa.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#progress-summmary-TU-table").dynatable();
            }
        );
        $.when($("#progress-summmary-TU-table").dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection