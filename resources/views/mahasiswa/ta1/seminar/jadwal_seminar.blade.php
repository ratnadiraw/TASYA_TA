{{--6--}}
@extends('layouts.ta1.mahasiswa')
@php
    if (null !== session('tahun_semester')) {
        $semester = session('tahun_semester')->semester;
        $tahun = session('tahun_semester')->tahun;
    }
@endphp
@section('title')
    <title>TA1 | Jadwal Seminar</title>
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
            <div class="card-header">
                <h3>Pengajuan Seminar</h3>
            </div>
            <div class="card-body">
                @if (isset($taData))
                    <form action="/mahasiswa/ta1/seminar/pendaftaran_seminar" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengajukan judul tersebut?');">
                        {{csrf_field()}}
                        <input type="hidden" name="ta-id" value="{{$taData->id}}">
                        <table>
                            <thead>
                                <tr>
                                    <th class="tu-table-td-form" style="width: 80%;">Judul TA</th>
                                    <th class="tu-table-td-form" style="width: 20%;">Aksi</th>
                                </tr>
                                <tr>
                                    <td class="tu-table-td-form">
                                        <input type="text" name="ta-title" class="form-control">
                                    </td>
                                    <td class="tu-table-td-form">
                                        <button type="submit" class="btn btn-primary">Ajukan</button>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </form>
                @else
                    <div class="alert alert-info">
                        Anda belum terdaftar sebagai peserta Tugas Akhir 1.
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Informasi Seminar</h3>
            </div>
            <div class="card-body">
                @if ($seminarSchedule != null)
                    <form action="/mahasiswa/ta1/seminar/update_seminar" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengubah judul tugas akhir Anda?');">
                        {{csrf_field()}}
                        <input type="hidden" name="ta-id" value="{{$taData->id}}">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Judul</td>
                                    <td >
                                        @if ($seminarSchedule->final == 0)
                                            <input type="text" name="ta-title-update" class="form-control tu-table-td-form" value="{{$seminarSchedule->judul}}">
                                            
                                        @else
                                            {{$seminarSchedule->judul}}
                                        @endif
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu Mulai</td>
                                    <td colspan="2">
                                        @if (isset($seminarSchedule->waktu))
                                            {{App\Http\Controllers\DateID::formatDateTime($seminarSchedule->waktu, true)}}
                                        @else
                                            Belum ditentukan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu Selesai</td>
                                    <td colspan="2">
                                        @php
                                            $time = new DateTime($seminarSchedule->waktu);
                                            $time->add(new DateInterval('PT' . config('constants.ta1.waktu_seminar') . 'M'));
                                            $waktu_selesai = $time->format('Y-m-d H:i:s');
                                        @endphp
                                        @if (isset($seminarSchedule->waktu))
                                            {{App\Http\Controllers\DateID::formatDateTime($waktu_selesai, true)}}
                                        @else
                                            Belum ditentukan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ruangan</td>
                                    <td colspan="2">
                                        @if (isset($seminarSchedule->ruangan))
                                            {{$seminarSchedule->ruangan}}
                                        @else
                                            Belum ditentukan
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                @else
                    <p>Belum ada jadwal seminar.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
