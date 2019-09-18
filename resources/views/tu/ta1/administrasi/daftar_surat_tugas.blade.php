@extends('layouts.ta1.tu')
<style>
    #ListSuratTugas {
        border: solid 1px;
        overflow: auto;
        max-height: 600px;
        padding: 8px 20px;
    }
</style>

@section('title')
    <title>TA1 | Daftar Surat Tugas</title>
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Surat Tugas Akhir 1</h3></div>
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
                @if (count($tas) > 0)
                    <!--div id="ListSuratTugas"-->
                        <form method="post" action="/tu/ta1/administrasi/a/all_surat_tugas">
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <input type="number" name="no_kop_inc" placeholder="Start Increment" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <input type="text" name="no_kop" placeholder="Nomor Kop Surat" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                            <br>
                        <table class="table table-striped" id="daftar-surat-tugas-table">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Mahasiswa</th>
                                    <th>Topik</th>
                                    <th>Pembimbing</th>
                                    <th data-dynatable-no-sort='true' style="text-align: center;">Cetak<input class="form-control" type="checkbox" onClick="toggle(this)" style="margin-top: 8px;" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tas as $ta)
                                <tr>
                                    <td>{{$ta->mahasiswa->nim}}</td>
                                    <td>{{$ta->mahasiswa->nama}}</td>
                                    <td>{{$ta->nama_topik}}</td>  
                                    <td>
                                        @if (count($ta->pembimbing) == 1)
                                            {{$ta->pembimbing[0]->nama}}
                                        @else
                                            @foreach ($ta->pembimbing as $key => $dosbing)
                                                <div class="row">
                                                    {{++$key}}. {{$dosbing->nama}}
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td><input type="checkbox" class="form-control" value="{{$ta->id}}" name="surat[]"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary middle-button">Cetak</button>
                        </form>
                    <!--/div-->
                </div>
                <script language="JavaScript">
                    function toggle(source) {
                      checkboxes = document.getElementsByName('surat[]');
                      for(var i=0, n=checkboxes.length;i<n;i++) {
                        checkboxes[i].checked = source.checked;
                      }
                    }
                </script>

                @else
                    <p>Belum ada surat tugas untuk dicetak.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#daftar-surat-tugas-table").dynatable({
                    dataset: {
                        perPageDefault: 10,
                        perPageOptions: [10,20,50,100, 150, 200],
                      },
                });
            }
        );
        $.when($("#daftar-surat-tugas-table").dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection