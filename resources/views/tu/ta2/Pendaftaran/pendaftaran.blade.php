@extends('layouts.ta2.tu')
@section('title')
    <title>Pendaftaran TA 2 | TU</title>
@endsection
@section('content')
    <div class="container">
        <h3> Pendaftaran TA 2</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (count($data_mahasiswa) > 0)
            <form action="/tu/ta2/administrasi/daftar_ta2" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="col-md-12 scrollable">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Angkatan</th>
                            <th>SKS Lulus</th>
                            <th>Topik</th>
                            <th>Status TA 1</th>
                            <th>Status TA 2</th>
                            <th>Tahun Ajaran</th>
                            <th>Daftarkan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data_mahasiswa as $mahasiswa)
                            <tr>
                                <td>{{$mahasiswa->nim}}</td>
                                <td>{{$mahasiswa->nama}}</td>
                                <td>{{$mahasiswa->angkatan}}</td>
                                <td>{{$mahasiswa->jumlah_sks_lulus}}</td>
                                <td>{{$mahasiswa->nama_topik}}</td>
                                @if($mahasiswa->status_lulus == null)
                                    <td> Belum lulus </td>
                                @else
                                    <td> Sudah lulus </td>
                                @endif
                                @if($mahasiswa->ta_id != null)
                                    <td> Terdaftar </td>
                                @else
                                    <td> Belum terdaftar </td>
                                @endif
                                <td>
                                    <select class="form-control" name="tahun_ajaran_{{$mahasiswa->user_id }}">
                                        @if(count($data_tahun_ajaran) > 0)
                                            @foreach($data_tahun_ajaran as $key => $tahun_ajaran)
                                                @if($key+1 == count($data_tahun_ajaran))
                                                    <option value="{{$tahun_ajaran->id}}" selected="selected">
                                                        {{$tahun_ajaran->tahun}} - {{$tahun_ajaran->semester}}
                                                    </option>
                                                @else
                                                    <option value="{{$tahun_ajaran->id}}">
                                                        {{$tahun_ajaran->tahun}} - {{$tahun_ajaran->semester}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    @if($mahasiswa->ta_id == null)
                                        <input type="checkbox" name="mahasiswa_ids[]" value="{{$mahasiswa->user_id}}">
                                    @else

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Daftarkan</button>
                </div>


            </form>
        @else

        @endif
    </div>

@endsection