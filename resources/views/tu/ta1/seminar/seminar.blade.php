@extends('layouts.ta1.tu')

<style>
    
    .tab-content {
        width: 100%;
    }
    .tab-pane {
        position: relative;
        width: 100%;
    }
    div.col-12 .content{
        padding-top: 50px;
    }
    .navbar ul.menu {
        width: 100%;
    }
    .navbar ul.menu li {
        width: 33%;
        text-align: center;
    }
    #myBtn {
        display: none; /* Hidden by default */
        position: fixed; /* Fixed/sticky position */
        bottom: 20px; /* Place the button at the bottom of the page */
        right: 30px; /* Place the button 30px from the right */
        z-index: 99; /* Make sure it does not overlap */
        border: none; /* Remove borders */
        outline: none; /* Remove outline */
        color: black; /* Text color */
        cursor: pointer; /* Add a mouse pointer on hover */
        padding: 15px; /* Some padding */
        border-radius: 10px; /* Rounded corners */
        font-size: 18px; /* Increase font size */
    }
    #myBtn:hover {
        background-color: #555; /* Add a dark-grey background on hover */
    }
    #ListSuratSeminar {
        border: solid 1px;
        overflow: auto;
        max-height: 600px;
        padding: 8px 20px;
    }
</style>

@section('title')
    <title>TA1 | Seminar</title>
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
            <ul class="nav nav-tabs nav-justified sticky-top">
                <li class="nav-item">
                    <a onclick="document.cookie='active=persiapan';" class="nav-link @if($ac == 'persiapan') active @endif" href="#persiapan" data-toggle="tab"> <h6>Persiapan Seminar</h6></a>
                </li>
                <li class="nav-item">
                    <a onclick="document.cookie='active=seminar';" class="nav-link @if($ac == 'seminar') active @endif" href="#seminar" data-toggle="tab"> <h6>Seminar</h6></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane @if($ac == 'persiapan') active @endif container" data-spy="scroll" data-target="#scrollSpy" data-offset="50" id="persiapan">
                    <nav class="navbar navbar-expand-sm bg-light sticky-top" id="scrollSpy">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbarSeminar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavbarSeminar">
                            <ul class="navbar-nav menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="#jadwal">Jadwal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#skseminar">SK Seminar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#bap">Form BAP</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="col-sm-12 col-12">                                    
                        <div id="jadwal" class="content">
                            <div class="card" style="min-height: 500px;">
                            <div class="card-header">
                                <h4>Jadwal Seminar</h4>
                            </div>
                            <div class="card-body">
                                @if (count($listOfSeminar) > 0)
                                <form action="/tu/ta1/seminar/edit_seminar" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengubah data seminar?');">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <table class="table table-striped" id="tu-seminar">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Kelompok</th>
                                                <th>Shift</th>
                                                <th>Ruangan</th>
                                                <th>Waktu Mulai</th>
                                                <th>Waktu Selesai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listOfSeminar as $seminar)
                                                <tr>
                                                    <td>{{$seminar->nim}}</td>
                                                    <td>{{$seminar->nama}}</td>
                                                    <td>{{$seminar->kloter}}</td>
                                                    <td>{{$seminar->shift}}</td>
                                                    <td><input type="text" class="form-control" name="room[]" value="{{$seminar->ruangan}}"></td>
                                                    <td>
                                                        <div class="input-group date" id="waktu-seminar-{{$seminar->id}}" data-target-input="nearest">
                                                            <input placeholder="YYYY-MM-DD HH:MM:SS" type="text" name="datetime[]" value="{{$seminar->waktu}}" class="form-control datetimepicker-input" data-target="#waktu-seminar-{{$seminar->id}}"/>
                                                            <div class="input-group-append" data-target="#waktu-seminar-{{$seminar->id}}" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" class="form-control" name="seminar-id[]" value="{{$seminar->id}}">
                                                    </td>
                                                    <td>
                                                        @php
                                                            $time = new DateTime($seminar->waktu);
                                                            $time->add(new DateInterval('PT' . config('constants.ta1.waktu_seminar') . 'M'));
                                                            $waktu_selesai = $time->format('Y-m-d H:i:s');
                                                        @endphp
                                                        @if (isset($seminar->waktu))
                                                            <input type="text" class="form-control" value="{{$waktu_selesai}}" disabled>
                                                        @else
                                                            <input type="text" class="form-control" value="" disabled>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
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
                        <div id="skseminar" class="content">
                            <div class="card">
                                <div class="card-header"><h4>Surat Seminar Mahasiswa</h4></div>
                                <div class="card-body">
                                    @if (count($seminars) > 0)
                                        <form action="/tu/ta1/seminar/cetak_surat_seminar" method="post">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                    <input type="number" name="no_kop_inc" placeholder="Start Increment" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                    <input type="text" name="no_kop" placeholder="Nomor Kop Surat" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                    <input type="date" name="tanggal_terbit" placeholder="Tanggal Terbit Surat" class="form-control">
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Kaprodi</label>
                                                        <input type="text" name="nama_kaprodi" value="{{$nama_kaprodi}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>NIP Kaprodi</label>
                                                        <input type="text" name="nip_kaprodi" value="{{$nip_kaprodi}}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="ListSuratSeminar">
                                            <table class="table table-striped" id="surat-seminar-TU-table">
                                                <thead>
                                                    <tr>
                                                        <th>NIM</th>
                                                        <th>Nama</th>
                                                        <th>Ruangan</th>
                                                        <th>Waktu Mulai</th>
                                                        <th>Waktu Selesai</th>
                                                        <th data-dynatable-no-sort='true'><input type="checkbox" onClick="toggle(this)">All</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($seminars as $seminar)
                                                        <tr>
                                                            <td>{{$seminar->nim}}</td>
                                                            <td>{{$seminar->nama}}</td>
                                                            <td>{{$seminar->ruangan}}</td>
                                                            <td>
                                                                @if (isset($seminar->waktu))
                                                                    {{App\Http\Controllers\DateID::formatDateTime($seminar->waktu, true)}}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $time = new DateTime($seminar->waktu);
                                                                    $time->add(new DateInterval('PT' . config('constants.ta1.waktu_seminar') . 'M'));
                                                                    $waktu_selesai = $time->format('Y-m-d H:i:s');
                                                                @endphp
                                                                @if (isset($seminar->waktu))
                                                                    {{App\Http\Controllers\DateID::formatDateTime($waktu_selesai, true)}}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="surat[]" value="{{$seminar->id}}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            </div>
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-primary">Cetak SK Seminar</button>
                                            
                                        </form>
                                      @else
                                        <p>Belum ada seminar.</p>
                                      @endif
                                      </div>
                                        </div>
                        <script language="JavaScript">
                            function toggle(source) {
                              checkboxes = document.getElementsByName('surat[]');
                              for(var i=0, n=checkboxes.length;i<n;i++) {
                                checkboxes[i].checked = source.checked;
                              }
                            }
                        </script>
                        <script>
                            $(document).ready(function() {
                                $('#surat-seminar-TU-table').dynatable();
                            });
                            $.when($('#surat-seminar-TU-table').dynatable()).done(function() {
                                // code to be ran after plugin has initialized
                            });
                        </script>
                        </div>
                        <div id="bap" class="content">
                            <div class="card">
                                <div class="card-header"><h4>Unduh Formulir BAP</h4></div>
                                <div class="card-body">
                                    <p><a href="/tu/ta1/seminar/downloadFormBAP">Unduh Formulir BAP Seminar Tugas Akhir I</a></p>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <button onclick="topFunction()" id="myBtn" title="Go to top" class="btn">Back to top</button> 
                </div>
                <div class="tab-pane @if($ac == 'seminar') active @endif container" id="seminar">
                    <div class="card" style="margin-top: 40px;">
                        <div class="card-header"><h4>Daftar Hasil Seminar</h4></div>
                        <div class="card-body">
                            <div id="bapModal" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Upload BAP</h6>
                                            <button onclick="closeBAP()" type="button" class="close" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form enctype="multipart/form-data" action="/tu/ta1/seminar/saveBAP" method="POST">
                                                <div class="row" style="margin-bottom: 8px;">
                                                    <div class="col-sm-4">NIM Mahasiswa</div>
                                                    <div class="col-sm-8">
                                                       <input type="text" name="nim" class="form-control" id="input_nim" readonly>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-bottom: 8px;">
                                                    <div class="col-sm-4">File BAP</div>
                                                    <div class="col-sm-8">
                                                        <input type="file" name="BAP" class="form-control">
                                                    </div>
                                                </div>
                                                <span style="font-size: 11px; color: green;"><i>Maximum file size is 16 Mb</i></span>
                                                {{csrf_field()}}
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>        
                            </div>
                            @if (count($hasilseminars) > 0)
                                <table class="table table-striped" id="bap-seminar-TU-table">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Tempat</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hasilseminars as $seminar)
                                            @if ($seminar->final == 1)
                                                @if ($seminar->TA1_Tugas_Akhir->status_checkout == 0)
                                                    <tr>
                                                        <td>{{$seminar->TA1_Tugas_Akhir->mahasiswa->nim}}</td>
                                                        <td>{{$seminar->TA1_Tugas_Akhir->mahasiswa->nama}}</td>
                                                        <td>{{$seminar->ruangan}}</td>
                                                        <td>
                                                            @if ($seminar->waktu != null)
                                                                {{App\Http\Controllers\DateID::formatDateTime($seminar->waktu, true)}}
                                                            @else
                                                                Belum ditentukan
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $time = new DateTime($seminar->waktu);
                                                                $time->add(new DateInterval('PT' . config('constants.ta1.waktu_seminar') . 'M'));
                                                                $waktu_selesai = $time->format('Y-m-d H:i:s');
                                                            @endphp
                                                            @if (isset($seminar->waktu))
                                                                {{App\Http\Controllers\DateID::formatDateTime($waktu_selesai, true)}}
                                                            @else
                                                                Belum ditentukan
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($seminar->berkas_seminar == null)
                                                                <button class="btn btn-primary" onclick="setmodal({{$seminar->TA1_Tugas_Akhir->mahasiswa->nim}})">Unggah BAP Baru</button>
                                                            @else
                                                                <button class="btn btn-success" onclick="window.location = '/tu/ta1/seminar/downloadBAP/{{$seminar->id}}'">Lihat BAP</button>
                                                                <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus BAP seminar ini?')" action="/tu/ta1/seminar/deleteBAP/{{$seminar->id}}" method="POST">
                                                                <button type="submit" class="btn btn-danger">Hapus BAP</button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="5">{{$hasilseminars->links()}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            @else
                                <p>Belum ada seminar.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function setmodal(nim) {
            document.getElementById("input_nim").value = '' + nim;
            var modal = document.getElementById("bapModal");
            
            modal.style.display = "block";
        }

        function closeBAP() {
            document.getElementById("bapModal").style.display = "none";
        } 

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        } 

        $(document).ready(function() {
            $('#datetimepicker').datetimepicker();
        });
        $.when($('#datetimepicker').datetimepicker()).done(function() {
            // code to be ran after plugin has initialized
        });
        $(document).ready(function() {
            $('#tu-seminar').dynatable();
        });
        $.when($('#tu-seminar').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });

    </script>
@endsection
