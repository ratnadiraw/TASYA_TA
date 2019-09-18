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
            <div class="card-header">List of MoM</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>MoM</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        foreach($all_bimbingan as $bimbingan)
                        {
                        ?>
                        <tr>
                            <td> {{$index}} </td>
                            <td> {{App\Http\Controllers\DateID::formatDate($bimbingan->tanggal, false)}} </td>
                            <td> <a href="/dosen/ta2/bimbingan/review_bimbingan/{{$nim}}?id={{$bimbingan->bimbingan_id}}"> Isi MoM</a> </td>
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