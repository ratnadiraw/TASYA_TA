@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>Bimbingan | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header"><h3>Bimbingan</h3></div>
                    <div class="card-body row">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>MoM</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($bimbingans) > 0)
                                @foreach($bimbingans as $key => $bimbingan)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td> {{App\Http\Controllers\DateID::formatDate($bimbingan->tanggal, false)}}</td>
                                        <td> <a href="/mahasiswa/ta2/isi_bimbingan/{{$bimbingan->bimbingan_id}}"> Isi MoM</a> </td>
                                        <td>
                                            @if($bimbingan->approved == 0)
                                                <span style="color:dodgerblue">Pending ⏱</span>
                                            @endif
                                            @if($bimbingan->approved == 1)
                                                <span style="color:green">Approved 🗸</span>
                                            @endif
                                            @if($bimbingan->approved == 2)
                                                <span style="color:red">Rejected ✕</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($bimbingan->approved != 1)
                                                <a href="/mahasiswa/ta2/edit_bimbingan/{{$bimbingan->bimbingan_id}}">Edit</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($bimbingan->approved != 1)
                                                <a href="/mahasiswa/ta2/delete_bimbingan/{{$bimbingan->bimbingan_id}}">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center bimbingan">
                    <a href="/mahasiswa/ta2/add_bimbingan">
                        <button class="btn-md btn-primary">Add bimbingan</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
