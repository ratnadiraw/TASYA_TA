@extends('layouts.ta1.timta')
@section('title')
    <title>TA1 | Riwayat</title>
@endsection
@section('content')
    <div class="container col-sm-10">
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
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header"><h3>Navigasi Tahun Ajaran</h3></div>
                    <div class="card-body">
                        @if (count($listOfTahunAjaran) > 0)
                            @foreach ($listOfTahunAjaran as $pilihanTahunAjaran)
                                <p><a href="/tim_ta/ta1/administrasi/history_detail/{{$pilihanTahunAjaran->id}}">
                                    Semester {{$pilihanTahunAjaran->semester}} - Tahun {{$pilihanTahunAjaran->tahun}}
                                </a></p>
                            @endforeach
                        @else
                            <p>Tidak ada tahun ajaran.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
            <div class="card">
                <div class="card-header"><h3>Riwayat TA1 Semester {{$tahunAjaran->semester}} - Tahun {{$tahunAjaran->tahun}}</h3></div>
                <div class="card-body">
                    @php $counter = 1; @endphp
                    <table class="table" id="history-ta1-table">
                        <thead>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                        <th>Judul Dokumen TA</th>
                        <th>Nilai</th>
                        <th>Status Lulus</th>
                        </thead>
                        <tbody>
                        @foreach(${'listOfCheckoutTA'} as $checkoutTA)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$checkoutTA->nim}}</td>
                                <td>{{$checkoutTA->nama}}</td>
                                <td>{{$checkoutTA->angkatan}}</td>
                                <td>{{$checkoutTA->judul}}</td>
                                <td>{{$checkoutTA->nilai_akhir}}</td>
                                <td>
                                    @if (!isset($checkoutTA->status_lulus))
                                        Belum Lulus
                                    @elseif (isset($checkoutTA->status_lulus) && $checkoutTA->status_lulus==0)
                                        Tidak Lulus
                                    @else
                                        Lulus
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#history-ta1-table").dynatable();
            }
        );
        $.when($('#history-ta1-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection