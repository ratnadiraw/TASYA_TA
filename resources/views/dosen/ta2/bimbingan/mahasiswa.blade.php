@extends('layouts.ta2.dosen')
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
            <div class="card-header">List Mahasiswa</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>MoM</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $index = 1;
                    foreach($all_mahasiswa as $mahasiswa)
                    {
                    ?>
                    <tr>
                        <td> {{$index}} </td>
                        <td> {{$mahasiswa->nim}} </td>
                        <td> {{$mahasiswa->nama}} </td>

                        <td> <a href="/dosen/ta2/bimbingan/approve/{{$mahasiswa->nim}}">List MoM</a> </td>
                    </tr>
                    <?php
                    $index++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection