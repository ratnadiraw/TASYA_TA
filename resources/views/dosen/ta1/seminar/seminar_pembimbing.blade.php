@extends('layouts.ta1.dosen')
@section('title')
    <title>TA1 | Seminar Pembimbing</title>
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
            <div class="card-header"><h3>Jadwal Seminar Pembimbing</h3></div>
            <div class="card-body">
                @if ((count($listOfMahasiswa1) + count($listOfMahasiswa2)) > 0)
                    <form action="/dosen/ta1/seminar/edit_jadwal_seminar" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data seminar?');">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="table table-striped" id="seminar-pembimbing-table">
                            <thead>
                                <th>Kelompok</th>
                                <th>Shift</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Ruang</th>
                            </thead>
                            <tbody>
                                @if (count($listOfMahasiswa1) > 0)
                                    @foreach($listOfMahasiswa1 as $mahasiswa)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="seminar-id[]" value="{{$mahasiswa->seminar_id}}">
                                                {{$mahasiswa->kloter}}
                                            </td>
                                            <td>{{$mahasiswa->shift}}</td>
                                            <td>{{$mahasiswa->nim}}</td>
                                            <td>{{$mahasiswa->nama}}</td>
                                            <td>
                                                <div class="input-group date" id="waktu-seminar-{{$mahasiswa->seminar_id}}" data-target-input="nearest">
                                                    <input placeholder="YYYY-MM-DD HH:MM:SS" type="text" name="datetime[]" value="{{$mahasiswa->waktu}}" class="form-control datetimepicker-input" data-target="#waktu-seminar-{{$mahasiswa->seminar_id}}"/>
                                                    <div class="input-group-append" data-target="#waktu-seminar-{{$mahasiswa->seminar_id}}" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $time = new DateTime($mahasiswa->waktu);
                                                    $time->add(new DateInterval('PT' . config('constants.ta1.waktu_seminar') . 'M'));
                                                    $waktu_selesai = $time->format('Y-m-d H:i:s');
                                                @endphp
                                                <input type="text" class="form-control" value="{{$waktu_selesai}}" disabled>
                                            </td>
                                            <td>{{$mahasiswa->ruangan}}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if (count($listOfMahasiswa2) > 0)
                                    @foreach($listOfMahasiswa2 as $mahasiswa)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="seminar-id[]" value="{{$mahasiswa->seminar_id}}">
                                                {{$mahasiswa->kloter}}
                                            </td>
                                            <td>{{$mahasiswa->shift}}</td>
                                            <td>{{$mahasiswa->nim}}</td>
                                            <td>{{$mahasiswa->nama}}</td>
                                            <td>
                                                <div class="input-group date" id="waktu-seminar-{{$mahasiswa->seminar_id}}" data-target-input="nearest">
                                                    <input placeholder="YYYY-MM-DD HH:MM:SS" type="text" name="datetime[]" value="{{$mahasiswa->waktu}}" class="form-control datetimepicker-input" data-target="#waktu-seminar-{{$mahasiswa->seminar_id}}"/>
                                                    <div class="input-group-append" data-target="#waktu-seminar-{{$mahasiswa->seminar_id}}" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $time = new DateTime($mahasiswa->waktu);
                                                    $time->add(new DateInterval('PT' . config('constants.ta1.waktu_seminar') . 'M'));
                                                    $waktu_selesai = $time->format('Y-m-d H:i:s');
                                                @endphp
                                                <input type="text" value="{{$waktu_selesai}}" disabled>
                                            </td>
                                            <td>{{$mahasiswa->ruangan}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                @else
                    <p>Belum ada seminar.</p>
                @endif  
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#seminar-pembimbing-table").dynatable();
            }
        );
        $.when($('#seminar-pembimbing-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection
