@extends('layouts.ta1.tu')
@section('title')
    <title>Pendaftaran TA1</title>
@endsection
@section('content')
    <div class="container col-md-10">
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
            <div class="card-header"><h3>Daftar Mahasiswa</h3></div>
            <div class="card-body">
                @if (count($listOfMahasiswa) > 0)
                    <form action="/tu/pendaftaran/register_ta1" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <table id="pendaftaran-ta1-TU-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th>NAMA</th>
                                <th>NIM</th>
                                <th>ANGKATAN</th>
                                <th>JUMLAH SKS LULUS</th>
                                <th>STATUS LULUS</th>
                                <th>TAHUN AJARAN-SEMESTER</th>
                                <th>STATUS PENDAFTARAN</th>
                                <th>DAFTARKAN</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($listOfMahasiswa as $mahasiswa)
                                @php
                                    $currentTA1 = $mahasiswa->ta1_Tugas_Akhir()->latest()->first();
                                @endphp
                                @if (config('constants.ta1.flow_system.enable_daftar_ta_lulus') != 1 && (!isset($currentTA1->progressSummary->status_lulus) || $currentTA1->progressSummary->status_lulus==0))
                                    <tr>
                                        <td>{{$mahasiswa->nama}}</td>
                                        <td>{{$mahasiswa->nim}}</td>
                                        <td>{{$mahasiswa->angkatan}}</td>
                                        <td>{{$mahasiswa->jumlah_sks_lulus}}</td>
                                        <td>
                                            @if (!isset($currentTA1->progressSummary->status_lulus))
                                                Belum Lulus
                                            @elseif ($currentTA1->progressSummary->status_lulus === 0)
                                                Tidak Lulus
                                            @elseif ($currentTA1->progressSummary->status_lulus === 1)
                                                Lulus
                                            @endif
                                        </td>
                                        <td>
                                            <select class="form-control" name="tahun-ajaran-{{$mahasiswa->user_id}}">
                                                @if (isset($currentTA1) && $currentTA1->tahunAjaran != null)
                                                    <option value="{{$currentTA1->tahunAjaran->id}}">
                                                        {{$currentTA1->tahunAjaran->tahun}} - {{$currentTA1->tahunAjaran->semester}}
                                                    </option>
                                                @else
                                                    <option value="" disabled selected>Tahun Ajaran</option>
                                                @endif
                                                @if (count($listOfTahunAjaran) > 0)
                                                    @foreach ($listOfTahunAjaran as $tahunAjaran)
                                                        @if ((isset($currentTA1) && $tahunAjaran->id != $currentTA1->tahunAjaran->id) || !isset($currentTA1))
                                                            <option value="{{$tahunAjaran->id}}">{{$tahunAjaran->tahun}} - {{$tahunAjaran->semester}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            @if (!isset($currentTA1))
                                                Belum Terdaftar
                                            @else
                                                Terdaftar
                                            @endif
                                        </td>
                                        <td>
                                            <input type="hidden" name="mahasiswa-id[]" value="{{$mahasiswa->user_id}}">
                                            <input type="hidden" name="mahasiswa-name-{{$mahasiswa->user_id}}" value="{{$mahasiswa->nama}}">
                                            @if (isset($currentTA1))
                                                <input type="hidden" name="registered-{{$mahasiswa->user_id}}" value="{{$currentTA1->id}}">
                                                <input type="hidden" name="checkout-status-{{$mahasiswa->user_id}}" value="{{$currentTA1->status_checkout}}">
                                            @endif
                                            <input type="checkbox" name="register-{{$mahasiswa->user_id}}">
                                            <input type="hidden" name="passing-sks-{{$mahasiswa->user_id}}" value="{{$mahasiswa->jumlah_sks_lulus}}">
                                        </td>
                                    </tr>
                                @elseif (config('constants.ta1.flow_system.enable_daftar_ta_lulus') == 1 && (!isset($currentTA1->progressSummary->status_lulus) || $currentTA1->progressSummary->status_lulus==0 || $currentTA1->progressSummary->status_lulus==1))
                                    <tr>
                                        <td>{{$mahasiswa->nama}}</td>
                                        <td>{{$mahasiswa->nim}}</td>
                                        <td>{{$mahasiswa->angkatan}}</td>
                                        <td>{{$mahasiswa->jumlah_sks_lulus}}</td>
                                        <td>
                                            @if (!isset($currentTA1->progressSummary->status_lulus))
                                                Belum Lulus
                                            @elseif ($currentTA1->progressSummary->status_lulus === 0)
                                                Tidak Lulus
                                            @elseif ($currentTA1->progressSummary->status_lulus === 1)
                                                Lulus
                                            @endif
                                        </td>
                                        <td>
                                            <select class="form-control" name="tahun-ajaran-{{$mahasiswa->user_id}}">
                                                @if (isset($currentTA1) && $currentTA1->tahunAjaran != null)
                                                    <option value="{{$currentTA1->tahunAjaran->id}}">
                                                        {{$currentTA1->tahunAjaran->tahun}} - {{$currentTA1->tahunAjaran->semester}}
                                                    </option>
                                                @else
                                                    <option value="" disabled selected>Tahun Ajaran</option>
                                                @endif
                                                @if (count($listOfTahunAjaran) > 0)
                                                    @foreach ($listOfTahunAjaran as $tahunAjaran)
                                                        @if ((isset($currentTA1) && $tahunAjaran->id != $currentTA1->tahunAjaran->id) || !isset($currentTA1))
                                                            <option value="{{$tahunAjaran->id}}">{{$tahunAjaran->tahun}} - {{$tahunAjaran->semester}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            @if (!isset($currentTA1))
                                                Belum Terdaftar
                                            @else
                                                Terdaftar
                                            @endif
                                        </td>
                                        <td>
                                            <input type="hidden" name="mahasiswa-id[]" value="{{$mahasiswa->user_id}}">
                                            <input type="hidden" name="mahasiswa-name-{{$mahasiswa->user_id}}" value="{{$mahasiswa->nama}}">
                                            @if (isset($currentTA1))
                                                <input type="hidden" name="registered-{{$mahasiswa->user_id}}" value="{{$currentTA1->id}}">
                                                <input type="hidden" name="checkout-status-{{$mahasiswa->user_id}}" value="{{$currentTA1->status_checkout}}">
                                            @endif
                                            <input type="checkbox" name="register-{{$mahasiswa->user_id}}">
                                            <input type="hidden" name="passing-sks-{{$mahasiswa->user_id}}" value="{{$mahasiswa->jumlah_sks_lulus}}">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">
                            Daftarkan TA1
                        </button>
                    </form>
                @else
                    <p>Belum ada mahasiswa.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#pendaftaran-ta1-TU-table").dynatable();
            }
        );
        $.when($("#pendaftaran-ta1-TU-table").dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection