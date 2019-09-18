{{--4--}}
@extends('layouts.ta1.mahasiswa')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Bimbingan</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>Daftar Bimbingan</h3></div>
                    <div class="card-body">
                        @if (isset($currentTA) && ($currentTA->topik_id !== null))
                            @if (count($listOfBimbingan) > 0)
                                <table id="daftar-bimbingan-table" class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>MoM</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listOfBimbingan as $key => $bimbingan)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{App\Http\Controllers\DateID::formatDate($bimbingan->tanggal, true)}}</td>
                                                <td>
                                                    @if (!isset($bimbingan->MoM['id']))
                                                        <form action="/mahasiswa/ta1/bimbingan/new_mom" method="POST">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="bimbingan-id" value="{{$bimbingan->id}}">
                                                            <button type="submit" class="btn btn-link"><u>Isi</u></button>
                                                        </form>
                                                    @else
                                                        @if($bimbingan->MoM['status_persetujuan'] === null)
                                                            <form action="/mahasiswa/ta1/bimbingan/edit_mom" method="GET">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="mom-id" value="{{$bimbingan->MoM['id']}}">
                                                                <button type="submit" class="btn btn-link"><u>Edit</u></button>
                                                            </form>
                                                        @else
                                                            <form action="/mahasiswa/ta1/bimbingan/view_mom" method="GET">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="mom-id" value="{{$bimbingan->MoM['id']}}">
                                                                <button type="submit" class="btn btn-link"><u>Lihat</u></button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($bimbingan->MoM['status_persetujuan'] === null)
                                                        Menunggu
                                                    @endif
                                                    @if($bimbingan->MoM['status_persetujuan'] === 1)
                                                        Diterima
                                                    @endif
                                                    @if($bimbingan->MoM['status_persetujuan'] === 0)
                                                        Ditolak
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Belum ada bimbingan.</p>
                            @endif
                        <a href="/mahasiswa/ta1/bimbingan/add_bimbingan">
                            <button class="btn btn-primary middle-button">Tambah Bimbingan</button>
                        </a>
                        @elseif (isset($currentTA) && ($currentTA->topik_id === null))
                            <div class="alert alert-info">
                                Anda belum medapatkan topik dan pebimbing. Tidak dapat membuat bimbingan baru.
                            </div>
                        @else
                        	<div class="alert alert-info">
		                        Anda belum terdaftar sebagai peserta Tugas Akhir 1.
		                    </div>
		                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#daftar-bimbingan-table").dynatable();
            }
        );
        $.when($('#daftar-bimbingan-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection
