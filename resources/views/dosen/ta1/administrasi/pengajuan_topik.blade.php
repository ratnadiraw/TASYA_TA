{{--7--}}
@extends('layouts.ta1.dosen')
@section('title')
    <title>TA1 | Pengajuan Topik</title>
@endsection
@section('pengajuan')
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
            <div class="card-header"><h3>Pengajuan Topik</h3></div>
            <div class="card-body">
                <form action="/dosen/ta1/administrasi/add_new_topic" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menambahkan topik tersebut?');">
                    <table>
                        <tr>
                            <td class="tu-table-td-form"><label for="topic">Topik:</label></td>
                            <td class="tu-table-td-form"><label for="knowledge-field">Area Keilmuan:</label></td>
                            <td class="tu-table-td-form"><label for="specific-knowledge-field">Area Keilmuan Spesifik:</label></td>
                            <td class="tu-table-td-form"><label for="exp-lab">Laboratorium Keahlian:</label></td>
                            <td class="tu-table-td-form"><label for="quota">Jumlah Mahasiswa:</label></td>
                            <td class="tu-table-td-form"></td>
                        </tr>
                        <tr>
                            <td class="tu-table-td-form"><input name="topic" type="text" class="form-control" id="topic"></td>
                            <td class="tu-table-td-form">
                                <select name="knowledge-field" class="form-control" id="knowledge-field">
                                    <option value="" disabled selected>Area Keilmuan</option>
                                    <option value="Algorithm and Complexity">Algorithm and Complexity</option>
                                    <option value="Computer Architecture and Organization">Computer Architecture and Organization</option>
                                    <option value="Computational Science">Computational Science</option>
                                    <option value="Discrete Structure">Discrete Structure</option>
                                    <option value="Human-Computer Interaction">Human-Computer Interaction</option>
                                    <option value="Information Assurance and Security">Information Assurance and Security</option>
                                    <option value="Information Management">Information Management</option>
                                    <option value="Intelligent Systems">Intelligent Systems</option>
                                    <option value="Networking and Communication">Networking and Communication</option>
                                    <option value="Operating Systems">Operating Systems</option>
                                    <option value="Platform-Based Development">Platform-Based Development</option>
                                    <option value="Parallel and Distributed Computing">Parallel and Distributed Computing</option>
                                    <option value="Programming Languages">Programming Languages</option>
                                    <option value="Software Development Fundamentals">Software Development Fundamentals</option>
                                    <option value="Software Engineering">Software Engineering</option>
                                    <option value="Systems Fundamentals">Systems Fundamentals</option>
                                    <option value="Social Issues and Professional Practice">Social Issues and Professional Practice</option>
                                </select>
                            </td>
                            <td class="tu-table-td-form"><input name="specific-knowledge-field" type="text" class="form-control" id="specific-knowledge-field" placeholder="Opsional"></td>
                            <td class="tu-table-td-form">
                                <select name="exp-lab" class="form-control" id="exp-lab">
                                    <option value="" disabled selected>Laboratorium Keahlian</option>
                                    <option value="Ilmu dan Rekayasa Komputasi">Ilmu dan Rekayasa Komputasi</option>
                                    <option value="Grafika dan Intelejensia Buatan">Grafika dan Intelejensia Buatan</option>
                                    <option value="Sistem Terdistribusi">Sistem Terdistribusi</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                    <option value="Pemrograman">Pemrograman</option>
                                    <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                    <option value="Basisdata">Basisdata</option>
                                </select>
                            </td>
                            <td class="tu-table-td-form"><input name="quota" type="text" class="form-control" id="quota"></td>
                            <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Tambah Topik</button></td>
                        </tr>
                    </table>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Daftar Topik</h3></div>
            <div class="card-body">
                @if (count($listOfTopics) > 0)
                    @if(isset($message))
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @endif
                    <table class="table table-striped" id="topik-dosen-table">
                        <thead>
                        <tr>
                            <th>Topik</th>
                            <th>Area Keilmuan</th>
                            <th>Area Keilmuan Spesifik</th>
                            <th>Laboratorium Keahlian</th>
                            <th>Jumlah Mahasiswa Dibutuhkan</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listOfTopics as $topic)
                            <tr>
                                <td>{{$topic->nama}}</td>
                                <td>{{$topic->area_keilmuan}}</td>
                                @if ($topic->area_keilmuan_spesifik !== null)
                                    <td>{{$topic->area_keilmuan_spesifik}}</td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>{{$topic->laboratorium_keahlian}}</td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-sm-4 gap">
                                            <form action="/dosen/ta1/administrasi/decrease_topic_quota" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="topic-id" value="{{$topic->topik_id}}">
                                                <button type="submit" class="btn btn-warning">-</button>
                                            </form>
                                        </div>
                                        <div class="col-sm-3">
                                            {{$topic->kuota}}
                                        </div>
                                        <div class="col-sm-1">
                                            <form action="/dosen/ta1/administrasi/increase_topic_quota" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="topic-id" value="{{$topic->topik_id}}">
                                                <button type="submit" class="btn btn-warning">+</button>
                                            </form>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                </td>
                                @if($topic->status_buka === 0)
                                    <td>
                                        <form action="/dosen/ta1/administrasi/buka_topik" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="topic-id" value="{{$topic->topik_id}}">
                                            <button type="submit" class="btn btn-primary align-self-center">Buka</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/dosen/ta1/administrasi/hapus_topik" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus topik tersebut?');">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="topic-id" value="{{$topic->topik_id}}">
                                            <button type="submit" class="btn btn-danger align-self-center">Hapus</button>
                                        </form>
                                    </td>
                                @elseif ($topic->status_buka === 1)
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda yakin ingin menutup topik ini?')"action="/dosen/ta1/administrasi/tutup_topik" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="topic-id" value="{{$topic->topik_id}}">
                                            <button type="submit" class="btn btn-danger align-self-center">Tutup</button>
                                        </form>
                                    </td>
                                    <td> </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Anda belum mengajukan topik.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#topik-dosen-table').datetimepicker();
        });
        $.when($('#topik-dosen-table').datetimepicker()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
    <script>
        $(document).ready(function()
            {
                $("#topik-dosen-table").dynatable();
            }
        );
        $.when($('#topik-dosen-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection