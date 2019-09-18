@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Tugas | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card gap-bottom">
                    <div class="card-header"><h3>Tugas</h3></div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <th>Tugas</th>
                            <th>Judul Tugas</th>
                            <th>Status</th>
                            </thead>
                            <tbody>
                            <?php
                                $cnt = 1;
                                foreach($all_tugas as $tugas)
                                {
                                ?>
                                    <tr>
                                        <td>Tugas {{$cnt}}</td>
                                        <td><a href="/mahasiswa/ta2/kelas/{{$tugas->tugas_id}}/{{basename($tugas->path)}}">{{$tugas->judul}}</a></td>
                                        <td>
                                        @if($tugas->sudah_dinilai == 1)
                                            <span style="color: green">Sudah Dinilai 🗸</span>
                                        @else
                                            <span style="color: red">Belum Dinilai ✕</span>
                                        @endif
                                        </td>
                                    </tr>
                                <?php
                                $cnt++;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
