@extends('layouts.tu')
@section('title')
    <title>Pendaftaran Pengguna</title>
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
                <h4>Batch Pendaftaran Mahasiswa</h4>
            </div>
            <div class="card-body">
            	<p>Unggah file excel untuk mendaftarkan banyak mahasiswa sekaligus.</p>
                <form action="/tu/pendaftaran/batchmahasiswa" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table>
                        <tr>
                            <td class="tu-table-td-form"><input name="excel" type="file"></td>
                            <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Unggah</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3>Pendaftaran Pengguna</h3></div>
            <div class="card-body">
                <form action="/tu/pendaftaran/addmahasiswa" method="POST">
                    <table style="margin-bottom: 15px;">
                        <tr>
                            <td class="tu-table-td-form"><label for="name">Nama:</label></td>
                            <td class="tu-table-td-form"><label for="email">Email:</label></td>
                            <td class="tu-table-td-form"><label> Daftarkan Sebagai:</label></td>
                        </tr>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <tr>
                            <td class="tu-table-td-form"><input name="name" type="text" class="form-control" id="name"></td>
                            <td class="tu-table-td-form"><input name="email" type="email" class="form-control" id="email"></td>
                            <td class="tu-table-td-form">
                                <a onclick="hideAnother(0);" data-toggle="collapse" data-target="#form-mhs" class="btn btn-warning align-self-center">Mahasiswa</a>
                                <a onclick="hideAnother(1);" data-toggle="collapse" data-target="#form-dos" class="btn btn-warning align-self-center">Dosen</a>
                                <a onclick="hideAnother(2);" data-toggle="collapse" data-target="#form-tu" class="btn btn-warning align-self-center">Tata Usaha</a>
                                <a onclick="hideAnother(3);" data-toggle="collapse" data-target="#form-ta" class="btn btn-warning align-self-center">Tim TA</a>
                            </td>
                        </tr>
                    </table>

                    <div id="form-mhs" class="collapse forms">
                            <table>
                                <tr>
                                    <td class="tu-table-td-form"><label for="NIM">NIM:</label></td>
                                    
                                    <td class="tu-table-td-form"><label for="passing-sks">Jumlah SKS Lulus:</label></td>
                                    <td class="tu-table-td-form"></td>
                                </tr>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <tr>
                                    <td class="tu-table-td-form"><input name="NIM" type="text" class="form-control" id="NIM"></td>
                                    
                                    <td class="tu-table-td-form"><input name="passing-sks" type="text" class="form-control" id="generation"></td>
                                    <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center" value="mahasiswa" name="submit">Daftarkan</button></td>
                                </tr>
                            </table>
                    </div>

                    <div id="form-dos" class="collapse forms">
                            <table>
                                <tr>
                                    <td class="tu-table-td-form"><label for="NIP-dosen">NIP:</label></td>
                                    <td class="tu-table-td-form"><label for="inisial">Inisial:</label></td>
                                    <td class="tu-table-td-form"><label for="wewenang-pembimbing">Wewenang Pembimbing</label></td>
                                    {{--<td class="tu-table-td-form"><label for="kk">KK:</label></td>--}}
                                </tr>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <tr>
                                    <td class="tu-table-td-form"><input name="NIP-dosen" type="text" class="form-control" id="NIP-dosen"></td>
                                    <td class="tu-table-td-form"><input name="inisial" type="text" class="form-control" id="inisial"></td>
                                    <td class="tu-table-td-form">
                                        <select name="wewenang-pembimbing" class="form-control" id="wewenang-pembimbing">
                                            <option value="" disabled selected>Wewenang</option>
                                            <option value="0">Belum Bisa</option>
                                            <option value="1">Pembimbing I</option>
                                            <option value="2">Pembimbing II</option>
                                        </select>
                                    </td>
                                    {{--<td class="tu-table-td-form">--}}
                                        {{--<select name="kk" class="form-control" id="kk">--}}
                                            {{--<option value="" disabled selected>Kelompok Keahlian</option>--}}
                                            {{--<option value="Rekayasa Perangkat Lunak dan Data">Rekayasa Perangkat Lunak & Data</option>--}}
                                            {{--<option value="Grafika dan Intelegensia Buatan">Grafika dan Intelegensia Buatan</option>--}}
                                            {{--<option value="Ilmu Rekayasa Komputasi" >Ilmu Rekayasa Komputasi</option>--}}
                                            {{--<option value="Sistem Terdistribusi">Sistem Terdistribusi</option>--}}
                                            {{--<option value="Sistem Informasi">Sistem Informasi</option>--}}
                                        {{--</select>--}}
                                    {{--</td>--}}
                                    <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center" value="dosen" name="submit">Daftarkan</button></td>
                                </tr>
                            </table>
                    </div>

                    <div id="form-tu" class="collapse forms">
                            <table>
                                <tr>
                                    <td class="tu-table-td-form"><label for="NIP">NIP:</label></td>
                                </tr>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <tr>
                                    <td class="tu-table-td-form"><input name="NIP-tu" type="text" class="form-control" id="NIP"></td>
                                    <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center" value="tu" name="submit">Daftarkan</button></td>
                                </tr>
                            </table>
                    </div>

                    <div id="form-ta" class="collapse forms">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table>
                                <tr>
                                    <td class="tu-table-td-form"><button type="submit" value="timta" name="submit" class="btn btn-primary align-self-center">Daftarkan</button></td>
                                </tr>
                            </table>
                    </div>
                </form>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link @if($active == 'mahasiswa') active @endif" data-toggle="tab" href="#mahasiswa" onclick="document.cookie='active=mahasiswa';">Mahasiswa</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @if($active == 'dosen') active @endif" data-toggle="tab" href="#dosen" onclick="document.cookie='active=dosen';">Dosen</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @if($active == 'timta') active @endif" data-toggle="tab" href="#timta"  onclick="document.cookie='active=timta';">Tim TA</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @if($active == 'tu') active @endif" data-toggle="tab" href="#tu"  onclick="document.cookie='active=tu';">Tata Usaha</a>
                  </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane @if($active == 'mahasiswa') active @endif container" id="mahasiswa">
                        @if (count($listOfMahasiswa) > 0)
                            <h3 style="margin-bottom: 32px;">Daftar Mahasiswa</h3>
                            <table id="pendaftaran-mahasiswa-table" class="table table-striped" style="overflow-x:auto;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Angkatan</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listOfMahasiswa as $mahasiswa)
                                        <tr>
                                            <td>{{$mahasiswa->nama}}</td>
                                            <td>{{$mahasiswa->nim}}</td>
                                            <td>{{$mahasiswa->angkatan}}</td>
                                            <td>{{$mahasiswa->email}}</td>
                                            <td>
                                               <form action="/tu/pendaftaran/showmahasiswa/{{$mahasiswa->id}}" method="get">
                                                    <button type="submit" class="btn btn-warning">
                                                        Ubah
                                                    </button>
                                                </form> 
                                            </td>
                                            <td>
                                                <form onsubmit="return confirm('Apakah Anda ingin menghapus data {{$mahasiswa->name}} dari Mahasiswa?');"
                                                action="/tu/pendaftaran/deletemahasiswa/{{$mahasiswa->id}}" method="get">
                                                    <button type="submit" class="btn btn-danger">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Belum ada mahasiswa.</p>
                        @endif
                    </div>

                    <div class="tab-pane @if($active == 'dosen') active @endif container" id="dosen">
                        @if (count($listOfDosen) > 0)
                            <h3 style="margin-bottom: 32px;">Daftar Dosen</h3>
                            <table id="pendaftaran-dosen-table" class="table table-striped" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th>NAMA</th>
                                            <th>NIP</th>
                                            <th>EMAIL</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($listOfDosen as $dosen)
                                           <tr>
                                               <td>{{$dosen->nama}}</td>
                                               <td>{{$dosen->nip}}</td>
                                               <td>{{$dosen->email}}</td>
                                               <td>
                                                   <form action="/tu/pendaftaran/showdosen/{{$dosen->id}}" method="get">
                                                       <button type="submit" class="btn btn-warning">
                                                           Ubah
                                                       </button>
                                                   </form>
                                               </td>
                                               <td>
                                                   <form onsubmit="return confirm('Apakah Anda ingin menghapus data {{$dosen->name}} dari Dosen?');"
                                                   action="/tu/pendaftaran/deletedosen/{{$dosen->id}}" method="get">
                                                       <button type="submit" class="btn btn-danger">
                                                           Hapus
                                                       </button>
                                                   </form>
                                               </td>
                                               <td>
                                                   @foreach ($listOfTimTA as $timta)
                                                        @if ($timta->id === $dosen->id)
                                                           {{Session::put('firstName',$dosen->id)}}
                                                           <form onsubmit="return confirm('Apakah Anda ingin menghapus {{$dosen->name}} dari Tim TA?');"
                                                                 action="/tu/pendaftaran/hapustimta/{{$dosen->id}}" method="get">
                                                               <button type="submit" class="btn btn-danger">
                                                                   Hapus Tim TA
                                                               </button>
                                                           </form>
                                                           @break
                                                        @endif
                                                   @endforeach
                                                   @if ($dosen->id !== Session::get('firstName'))
                                                           <form onsubmit="return confirm('Apakah Anda ingin menambahkan {{$dosen->name}} menjadi Tim TA?');"
                                                                 action="/tu/pendaftaran/tambahtimta/{{$dosen->id}}" method="get">
                                                               <button type="submit" class="btn btn-info">
                                                                   Tim TA
                                                               </button>
                                                           </form>
                                                   @endif
                                               </td>
                                           </tr>
                                       @endforeach
                                    </tbody>
                            </table>
                        @else
                            <p>Belum ada dosen.</p>
                        @endif
                    </div>

                    <div class="tab-pane @if($active == 'timta') active @endif container" id="timta">
                        @if (count($listOfTimTA) > 0)
                            <h3 style="margin-bottom: 32px;">Daftar Tim TA</h3>
                            <table id="pendaftaran-timta-table" class="table table-striped" style="overflow-x:auto;">
                                <thead>
                                <tr>
                                    <th>NAMA</th>
                                    <th>EMAIL</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($listOfTimTA as $timta)
                                    <tr>
                                        <td>{{$timta->name}}</td>
                                        <td>{{$timta->email}}</td>
                                        <td>
                                            <form action="/tu/pendaftaran/showtimta/{{$timta->id}}" method="get">
                                                <button type="submit" class="btn btn-warning">
                                                    Ubah
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda ingin menghapus data {{$timta->name}} dari Tim TA?');" 
                                            action="/tu/pendaftaran/deletetimta/{{$timta->id}}" method="get">
                                                <button type="submit" class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Belum ada Tim TA.</p>
                        @endif
                    </div>

                    <div class="tab-pane @if($active == 'tu') active @endif container" id="tu">
                        @if (count($listOfTU) > 0)
                            <h3 style="margin-bottom: 32px;">Daftar Pegawai Tata Usaha</h3>
                            <table id="pendaftaran-tata_usaha-table" class="table table-striped" style="overflow-x:auto;">
                                <thead>
                                    <tr>
                                        <th>NAMA</th>
                                        <th>NIP</th>
                                        <th>EMAIL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listOfTU as $TU)
                                        <tr>
                                            <td>{{$TU->nama}}</td>
                                            <td>{{$TU->nip}}</td>
                                            <td>{{$TU->email}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Belum ada pegawai tata usaha.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
       
        <script type="text/javascript">
            function hideAnother(id) {
                var content = document.getElementsByClassName("forms");

                for (var i = 0; i < content.length; i++) {
                    if (i != id) {
                        content[i].style.display = "none";
                    } else {
                        content[i].style.display = "block";
                    }
                }
            }
        </script>
@endsection

@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#pendaftaran-mahasiswa-table").dynatable();
            }
        );
        $.when($('#pendaftaran-mahasiswa-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
    <script>
        $(document).ready(function()
            {
                $("#pendaftaran-dosen-table").dynatable();
            }
        );
        $.when($('#pendaftaran-dosen-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
    <script>
        $(document).ready(function()
            {
                $("#pendaftaran-timta-table").dynatable();
            }
        );
        $.when($('#pendaftaran-timta-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
    <script>
        $(document).ready(function()
            {
                $("#pendaftaran-tata_usaha-table").dynatable();
            }
        );
        $.when($('#pendaftaran-tata_usaha-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection