@extends('layouts.ta2.mahasiswa')
@section('title')
    <title>MoM Bimbingan | Mahasiswa</title>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-8 edit-mom">
                <div class="card-header"><h3>Minutes of Meeting Bimbingan Tugas Akhir</h3></div>
                <div class="card-body">
                    <div class="add-bimbingan-content">
                            <div class="add-bimbingan-content-field font-weight-bold">
                                NIM/NAMA: {{$mahasiswa->nim}}/{{$mahasiswa->nama}}
                            </div>
                            <div class="row">
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    Pembimbing: {{$dosen_pembimbing->nama}}
                                </div>
                                @if($dosen_pembimbing_2 != null)
                                    <div class="add-bimbingan-content-field font-weight-bold">
                                        Pembimbing 2: {{$dosen_pembimbing_2->nama}}
                                    </div>
                                @endif
                                {{--<div class="dropdown">--}}
                                    {{--<select name="dosen_pembimbing_id">--}}
                                        {{--@if(count($dosen_pembimbings) > 0)--}}
                                            {{--@foreach($dosen_pembimbings as $dosen_pembimbing)--}}
                                                {{--<option class = "dropdown-item" value={{$dosen_pembimbing->user_id}}> {{$dosen_pembimbing->nama}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            </div>
                            <div class="row">
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    Tanggal: {{App\Http\Controllers\DateID::formatDate($bimbingan->tanggal, false)}}
                                </div>
                            </div>
                            <div class="add-bimbingan-content-field font-weight-bold">
                                Hasil Diskusi : {{$bimbingan->hasil_diskusi}}
                            </div>
                            <div class="add-bimbingan-content-field font-weight-bold">
                                Rencana Tindak Lanjut : {{$bimbingan->rencana_tindak_lanjut}}
                            </div>
                            @if($bimbingan->approved == 1)
                                <div class="add-bimbingan-content-field font-weight-bold">
                                    Komentar: {{$bimbingan->komentar}}
                                </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection