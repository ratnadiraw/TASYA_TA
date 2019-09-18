@extends('layouts.ta1.dosen')
@section('title')
    <title>TA1 | Pemilihan Mahasiswa Bimbingan</title>
@endsection
@section('content')
    <div class="container col-md-11">
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
            <div class="col-sm-5">
                <div class="card sidebar-card">
                    <div class="card-header">
                        <h3>Daftar Mahasiswa Bimbingan Pilihan</h3>
                    </div>
                    <div class="card-body">
                        @if (isset($listOfMahasiswaBimbingan) && count($listOfMahasiswaBimbingan) > 0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Prioritas</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Angkatan</th>
                                    <th>Topik</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($listOfMahasiswaBimbingan as $mahasiswaBimbingan)
                                    <tr>
                                        <td>{{$mahasiswaBimbingan->prioritas}}</td>
                                        <td>{{$mahasiswaBimbingan->mahasiswa_nama}}</td>
                                        <td>{{$mahasiswaBimbingan->nim}}</td>
                                        <td>{{$mahasiswaBimbingan->angkatan}}</td>
                                        <td>{{$mahasiswaBimbingan->nama}}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa bimbingan pilihan ini?');" action="/dosen/ta1/administrasi/delete_mahasiswa_bimbingan" method="POST">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}" >
                                                <input type="hidden" name="mahasiswa-id" value="{{$mahasiswaBimbingan->user_id}}" >
                                                <input type="hidden" name="topic-id" value="{{$mahasiswaBimbingan->topik_id}}" >
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Anda belum memilih mahasiswa bimbingan.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h3>Daftar Calon Mahasiswa Bimbingan</h3>
                    </div>
                    <div class="card-body">
        	            @if (isset($listOfTopics) && count($listOfTopics) > 0)
        	                @foreach ($listOfTopics as $topic)
        	                    <h4 class="bold">{{$topic->nama}}</h4>
        	                    @if (count(${'mahasiswa'.$topic->topik_id}) > 0)
        	                    <table class="table table-striped tabel-pemilihan-mahasiswa">
        	                        <thead>
        		                        <tr>
        		                            <th>NIM</th>
        		                            <th>Nama</th>
                                            <th>Prioritas</th>
        		                            <th>Aksi</th>
        		                        </tr>
        		                        </thead>
        	                        <tbody>	   
        	                            @foreach (${'mahasiswa'.$topic->topik_id} as $mahasiswa)
                                            <tr>
                                                <td>{{$mahasiswa->nim}}</td>
                                                <td>{{$mahasiswa->nama}}</td>
                                                <td>
                                                    <select class="form-control" onchange="setPriority(this,'topic-{{$topic->topik_id}}-mahasiswa-{{$mahasiswa->user_id}}-prority')">
                                                        <option value="" disabled selected>Prioritas</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <form action="/dosen/ta1/administrasi/save_mahasiswa_bimbingan" method="POST">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="topic-id" value={{$topic->topik_id}}>
                                                        <input type="hidden" name="mahasiswa-id" value={{$mahasiswa->user_id}}>
                                                        <input type="hidden" name="mahasiswa-priority" class="form-control" id="topic-{{$topic->topik_id}}-mahasiswa-{{$mahasiswa->user_id}}-prority" min="1" max="6">
                                                        <button type="submit" class="btn btn-primary">Pilih Mahasiswa</button>
                                                    </form>
                                                </td>
                                            </tr>
        	                            @endforeach
        	                        </tbody>
        	                    </table>
        	                    @else
        	                        <p class="tabel-pemilihan-mahasiswa">Tidak ada mahasiswa yang memilih topik ini.</p>
        	                    @endif
        	                @endforeach
        	            @else
        	                <p>Tidak ada topik yang terdaftar.</p>
        	            @endif
        	        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function setPriority(select,priorityID) {
            var temp = select.value;
            document.getElementById(priorityID).value = temp;
        }
    </script>
@endsection