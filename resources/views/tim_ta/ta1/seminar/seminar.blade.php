@extends('layouts.ta1.timta')
@section('title')
    <title>TA1 | Seminar</title>
@endsection
@section('content')
    @if (count($listOfSeminar) > 0)
        <div class="container col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><h3>Jadwal Seminar Tugas Akhir</h3></div>
                        <div class="card-body">
                            <form action="/tim_ta/ta1/seminar/edit_seminar" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <table class="table table-striped" id="timta-seminar-table">
                                    <thead>
                                        <tr>
                                            <th width="7%">Nama</th>
                                            <th width="6%">NIM</th>
                                            <th width="10%">Topik</th>
                                            <th width="12%">Laboratorium Keahlian</th>
                                            <th width="7%">Pembimbing 1</th>
                                            <th width="7%">Pembimbing 2</th>
                                            <th width="7%">Penguji</th>
                                            <th width="10%">Ruangan</th>
                                            <th width="12%">Waktu Mulai</th>
                                            <th width="12%">Waktu Selesai</th>
                                            <th width="5%">Kelompok</th>
                                            <th width="5%">Shift</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($listOfSeminar as $seminar)
                                        <tr>
                                            <td>{{$seminar->nama_mahasiswa}}</td>
                                            <td>{{$seminar->nim}}</td>
                                            <td>
                                                <input type="hidden" name="seminar-id[]" value="{{$seminar->seminar_id}}">
                                                {{$seminar->nama_topik}}
                                            </td>
                                            <td>{{$seminar->laboratorium_keahlian}}</td>
                                            @php $counterPembimbing = 1; @endphp
                                            @foreach(${'listOfPembimbing'.$seminar->seminar_id} as $pembimbing)
                                                <td>
                                                    {{$pembimbing->nama}}
                                                    <input type="hidden" name="pembimbing-{{$counterPembimbing++}}[]" value="{{$pembimbing->user_id}}">
                                                </td>
                                            @endforeach
                                            @if (count(${'listOfPembimbing'.$seminar->seminar_id}) == 1)
                                                  <td>
                                                      <input type="hidden" name="pembimbing-2[]" value="">
                                                  </td>
                                            @endif
                                            <td>
                                                @php
                                                    if (count(${'listOfPenguji'.$seminar->seminar_id}) > 0) {
                                                        $penguji = ${'listOfPenguji'.$seminar->seminar_id}[0];
                                                    } else {
                                                        $penguji = null;
                                                    }
                                                @endphp

                                                <select class="form-control" name="penguji-1[]">
                                                    @if (isset($penguji) && $penguji->penguji1_id != null)
                                                        <option value="{{$penguji->penguji1_id}}">{{$penguji->penguji1_nama}}</option>
                                                    @else
                                                        <option value="" selected>Penguji 1</option>
                                                    @endif
                                                    @if (count($listOfDosen) > 0)
                                                        @foreach($listOfDosen as $dosen)
                                                            @if (isset($penguji) && $penguji->penguji1_id != null && $penguji->penguji1_id != $dosen->user_id)
                                                                <option value="{{$dosen->user_id}}">{{$dosen->nama}}</option>
                                                            @else
                                                                <option value="{{$dosen->user_id}}">{{$dosen->nama}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td><input name="room[]" type="text" class="form-control" value="{{$seminar->ruangan}}"></td>
                                            <td>
                                                <div class="input-group date" id="waktu-seminar-{{$seminar->seminar_id}}" data-target-input="nearest">
                                                    <input placeholder="YYYY-MM-DD HH:MM:SS" type="text" name="datetime[]" value="{{$seminar->waktu}}" class="form-control datetimepicker-input" data-target="#waktu-seminar-{{$seminar->seminar_id}}"/>
                                                    <div class="input-group-append" data-target="#waktu-seminar-{{$seminar->seminar_id}}" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $time = new DateTime($seminar->waktu);
                                                    $time->add(new DateInterval('PT' . config('constants.ta1.waktu_seminar') . 'M'));
                                                    $waktu_selesai = $time->format('Y-m-d H:i:s');
                                                @endphp
                                                <input type="text" class="form-control" value="{{$waktu_selesai}}" disabled>
                                            </td>
                                            <td><input name="kloter[]" type="text" class="form-control" value="{{$seminar->kloter}}"></td>
                                            <td><input name="shift[]" type="text" class="form-control" value="{{$seminar->shift}}"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><h3>Jadwal Seminar Tugas Akhir</h3></div>
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
                            <p>Belum ada seminar untuk disesikan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datetimepicker').datetimepicker();
        });
        $.when($('#datetimepicker').datetimepicker()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#timta-seminar-table').dynatable();
        });
        $.when($('#timta-seminar-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection