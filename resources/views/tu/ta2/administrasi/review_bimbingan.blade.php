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

        <div class="card edit-mom">
            <div class="card-header">Minutes of Meeting Bimbingan Tugas Akhir</div>
            <div class="card-body">
                <div class="add-bimbingan-content">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td width="20%;"><b>Tanggal</b></td>
                                <td>{{App\Http\Controllers\DateID::formatDate($bimbingan->tanggal, false)}}</td>
                            </tr>
                            <tr>
                                <td><b>Hasil Diskusi</b></td>
                                <td>{{$bimbingan->hasil_diskusi}}</td>
                            </tr>
                            <tr>
                                <td><b>Rencana Tindak Lanjut</b></td>
                                <td>{{$bimbingan->rencana_tindak_lanjut}}</td>
                            </tr>
                            <tr>
                                <td><b>Komentar</b></td>
                                <td>{{$bimbingan->komentar}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection