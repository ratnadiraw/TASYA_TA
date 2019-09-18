{{--32--}}
@extends('layouts.ta1.timta')
@section('title')
    <title>TA1 | Finalisasi Nilai Akhir</title>
@endsection
@section('content')
    @if (count($listOfNilaiAkhir) > 0)
        <div class="container col-md-10">
            <div class="card">
                <div class="card-header"><h3>Finalisasi Nilai Akhir</h3></div>
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
                    <form onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data nilai tersebut?');"  action="/tim_ta/ta1/administrasi/finalisasi_nilai_akhir" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="table table-striped" id="finalisasi-nilai-akhir-table">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nama Topik</th>
                                    <th>Jumlah Kehadiran Kelas</th>
                                    <th>Jumlah Tugas</th>
                                    <th>Jumlah Kehadiran Seminar</th>
                                    <th>Jumlah Bimbingan</th>
                                    <th>Nilai Pembimbing</th>
                                    <th>Nilai Penguji</th>
                                    <th>Nilai</th>
                                    <th style="text-align: center">Finalisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($listOfNilaiAkhir as $nilai)
                                <tr>
                                    <td>{{$nilai->nim}}</td>
                                    <td>{{$nilai->nama}}</td>
                                    <td>{{$nilai->nama_topik}}</td>
                                    <td>
                                        <input type="hidden" name="jumlah-kehadiran[]" value="{{$nilai->jumlah_kehadiran_kelas}}">
                                        {{$nilai->jumlah_kehadiran_kelas}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="jumlah-tugas[]" value="{{(${'tugas_'.$nilai->progress_id})}}">
                                        {{(${'tugas_'.$nilai->progress_id})}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="jumlah-seminar[]" value="{{$nilai->jumlah_kehadiran_seminar}}">
                                        {{$nilai->jumlah_kehadiran_seminar}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="jumlah-bimbingan[]" value="{{$nilai->jumlah_bimbingan}}">
                                        {{$nilai->jumlah_bimbingan}}
                                    </td>
                                    <td><input type="text" class="form-control" name="pembimbing-score[]" value="{{$nilai->nilai_pembimbing}}"></td>
                                    <td><input type="text" class="form-control" name="penguji-score[]" value="{{$nilai->nilai_penguji}}"></td>
                                    <td><input type="text" class="form-control" name="score[]" value="{{$nilai->nilai}}"></td>
                                    <td style="text-align: center">
                                        <input type="hidden" name="progress-id[]" value="{{$nilai->progress_id}}">
                                        <input type="hidden" name="seminar-id[]" value="{{$nilai->seminar_id}}">
                                        <input type="hidden" name="ta-id[]" value="{{$nilai->ta_id}}">
                                        @if ($nilai->status_checkout != 0)
                                            <input type="checkbox" name="checkout-{{$nilai->seminar_id}}" checked onchange="cTrig({{$nilai->nama}})">
                                        @else
                                            <input type="checkbox" name="checkout-{{$nilai->seminar_id}}" onchange="cTrig({{$nilai->nim}})">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="card">
                <div class="card-header"><h3>Finalisasi Nilai Akhir</h3></div>
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
                    <p>Belum ada mahasiswa untuk dinilai.</p>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).ready(function()
            {
                $("#finalisasi-nilai-akhir-table").dynatable();
            }
        );
        $.when($('#finalisasi-nilai-akhir-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection