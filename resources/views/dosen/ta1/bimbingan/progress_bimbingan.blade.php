{{--12--}}
@extends('layouts.ta1.dosen')
@section('title')
    <title>TA1 | Progress Bimbingan</title>
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
            <div class="card-header"><h3>Perkembangan Bimbingan</h3></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h4>Data Mahasiswa</h4>
                        <div class="row">
                            <div class="col-md-4"><h6>Nama</h6></div>
                            <div class="col-md-5"><h6>{{$mahasiswa->nama}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><h6>NIM</h6></div>
                            <div class="col-md-5"><h6>{{$mahasiswa->nim}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><h6>Topik</h6></div>
                            <div class="col-md-5"><h6>{{$TA->nama_topik}}</h6></div>
                        </div>
                    </div>
                </div>
                <div class="row report-heading">
                    <div class="col-md-10">
                        <h4>Daftar MoM</h4>
                        @if (count($listOfBimbingan) > 0)
                            <table class="table table-hover" id="daftar-mom">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No</th>
                                        <th style="width: 35%">Tanggal</th>
                                        <th style="width: 20%">Status</th>
                                        <th style="width: 35%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($listOfBimbingan as $key => $bimbingan)
                                    <tr>
                                        <td>{{$counter++}}</td>
                                        <td>{{App\Http\Controllers\DateID::formatDate($bimbingan->tanggal, true)}}</td>
                                        <td>
                                            @if ($bimbingan->MoM['status_persetujuan'] === null)
                                                <span style="color:dodgerblue">Belum ditanggapi</span>
                                            @elseif ($bimbingan->MoM['status_persetujuan'] === 0)
                                                <span style="color:red">Ditolak</span>
                                            @else
                                                <span style="color:green">Disetujui</span>
                                            @endif
                                        <td>
                                            @if (!isset($bimbingan->MoM))
                                                MoM belum diisi
                                            @else
                                                @if ($bimbingan->MoM['status_persetujuan'] === null)
                                                    <form action="/dosen/ta1/bimbingan/edit_mom_bimbingan" method="GET">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="ta-id" value="{{$TA->id}}">
                                                        <input type="hidden" name="mom-id" value="{{$bimbingan->MoM['id']}}">
                                                        <button type="submit" class="btn btn-primary">Lihat/Beri Komentar</button>
                                                    </form>
                                                @else
                                                    <form action="/dosen/ta1/bimbingan/view_mom_bimbingan" method="GET">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="ta-id" value="{{$TA->id}}">
                                                        <input type="hidden" name="mom-id" value="{{$bimbingan->MoM['id']}}">
                                                        <button type="submit" class="btn btn-primary">Lihat</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            Belum ada MoM dari mahasiswa ini.
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
                $("#daftar-mom").dynatable();
            }
        );
        $.when($('#daftar-mom').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection