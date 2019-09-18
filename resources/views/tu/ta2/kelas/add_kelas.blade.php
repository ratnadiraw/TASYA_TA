@extends('layouts.ta2.tu')
@section('title')
    <title>Tambah Kelas | TU</title>
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
            <div class="card-header"><h3>Tambah Kelas Baru</h3></div>
            <div class="card-body">
                <form action="/tu/ta2/kelas/add_new_kelas" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table>
                        <tr>
                            <td class="tu-table-td-form"><label for="Tahun">Tahun:</label></td>
                            <td class="tu-table-td-form"><label for="Semester">Semester:</label></td>
                            <td class="tu-table-td-form"><label for="Dosen">Dosen:</label></td>
                            <td class="tu-table-td-form"></td>
                        </tr>
                        <tr>
                            <td class="tu-table-td-form"><input name="Tahun" type="text" class="form-control" id="Tahun"></td>
                            <td class="tu-table-td-form"><input name="Semester" type="text" class="form-control" id="Semester"></td>
                            <td class="tu-table-td-form">
                                <div class="dropdown">
                                    <select name="tim_ta_id">
                                        @foreach($all_tim_ta as $tim_ta)
                                            <option class = "dropdown-item" value={{$tim_ta->id}}> {{$tim_ta->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">ADD</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>Tambah Mahasiswa</h3></div>
            <div class="card-body">
                <form action="/tu/ta2/kelas/add_mahasiswa_kelas" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table>
                        <tr>
                            <td class="tu-table-td-form"><label for="NIM">NIM:</label></td>
                            <td class="tu-table-td-form"><label for="Kelas">Kelas:</label></td>
                        </tr>
                        <tr>
                            <td class="tu-table-td-form"><input name="nim" type="text" class="form-control" id="NIM"></td>
                            <td class="tu-table-td-form">
                                <div class="dropdown">
                                    <select name="kelas_id">
                                        @if(!empty($all_kelas))
                                            @foreach($all_kelas as $kelas)
                                                @if($kelas->tahun == $tahun && $kelas->semester == $semester)
                                                    <option class = "dropdown-item" value={{$kelas->id}} selected> {{$kelas->tahun}} / {{$kelas->semester}}</option>
                                                @else
                                                    <option class = "dropdown-item" value={{$kelas->id}}> {{$kelas->tahun}} / {{$kelas->semester}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </td>
                            <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">ADD</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Batch Pendaftaran Mahasiswa</h4>
            </div>
            <div class="card-body">
                <p>Unggah file excel untuk mendaftarkan banyak mahasiswa sekaligus.</p>
                <form action="/tu/ta2/kelas/add_mahasiswa_batch_kelas" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table>
                        <tr>
                            <td class="tu-table-td-form"><input name="excel" type="file"></td>
                            <td class="tu-table-td-form">
                                <div class="dropdown">
                                    <select name="kelas_id">
                                        @if(!empty($all_kelas))
                                            @foreach($all_kelas as $kelas)
                                                @if($kelas->tahun == $tahun && $kelas->semester == $semester)
                                                    <option class = "dropdown-item" value={{$kelas->id}} selected> {{$kelas->tahun}} / {{$kelas->semester}}</option>
                                                @else
                                                    <option class = "dropdown-item" value={{$kelas->id}}> {{$kelas->tahun}} / {{$kelas->semester}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </td>
                            <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Unggah</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php
        /*
        <div class="card gap-bottom">
            <div class="card-header"><h3>Batch Pendaftaran</h3></div>
            <div class="card-body">
                <form action="/tu/ta2/kelas/add_mahasiswa_batch_kelas" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table>
                        <tr>
                            <td class="tu-table-td-form"><input name="excel" type="file"></td>
                            <td class="tu-table-td-form"><label for="Kelas">Kelas:</label></td>
                            <td class="tu-table-td-form">
                            <td class="tu-table-td-form">
                                <div class="dropdown">
                                    <select name="kelas_id">
                                        @if(!empty($all_kelas))
                                            @foreach($all_kelas as $kelas)
                                                @if($kelas->tahun == $tahun && $kelas->semester == $semester)
                                                    <option class = "dropdown-item" value={{$kelas->id}} selected> {{$kelas->tahun}} / {{$kelas->semester}}</option>
                                                @else
                                                    <option class = "dropdown-item" value={{$kelas->id}}> {{$kelas->tahun}} / {{$kelas->semester}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </td>
                            <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Upload</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        */
        ?>
        <div class="card">
            <div class="card-header"><h3>List of Mahasiswa</h3></div>
            <div class="card-body" style="overflow-x:auto;">
                <form action="/tu/ta2/kelas/show_mahasiswa_kelas" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table class="gap-bottom">
                        <tr>
                            <td class="tu-table-td-form"><label for="Kelas">Kelas:</label></td>
                            <td class="tu-table-td-form">
                                <div class="dropdown">
                                    <select name="kelas_id">
                                        @if(!empty($all_kelas))
                                            @foreach($all_kelas as $kelas)
                                                @if($kelas->tahun == $tahun_list_mahasiswa && $kelas->semester == $semester_list_mahasiswa)oot
                                                    <option class = "dropdown-item" value={{$kelas->id}} selected> {{$kelas->tahun}} / {{$kelas->semester}}</option>
                                                @else
                                                    <option class = "dropdown-item" value={{$kelas->id}}> {{$kelas->tahun}} / {{$kelas->semester}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </td>
                            <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Tampilkan Mahasiswa</button></td>
                        </tr>
                    </table>
                </form>
                <table id="pendaftaran-mahasiswa-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>NAMA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($all_mahasiswa))
                            @foreach($all_mahasiswa as $mahasiswa)
                                <tr>
                                    <td>{{$mahasiswa->nim}}</td>
                                    <td>{{$mahasiswa->nama}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection