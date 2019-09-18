@extends('layouts.ta1.timta')
@section('title')
    <title>TA1 | Riwayat</title>
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
            <div class="card-header"><h3>Riwayat Tugas Akhir 1</h3></div>
            <div class="card-body text-center">
                @if (count($listOfTahunAjaran) > 0)
                    @foreach ($listOfTahunAjaran as $tahunAjaran)
                        <p><a href="/tim_ta/ta1/administrasi/history_detail/{{$tahunAjaran->id}}">
                            <button class="btn btn-primary">
                                Semester {{$tahunAjaran->semester}} - Tahun {{$tahunAjaran->tahun}}
                            </button>
                        </a></p>
                    @endforeach
                    </div>
                @else
                    <p>Tidak ada tahun ajaran.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#formulir-tahun-ajaran').submit(function(){
                var pilihan = $('#pilihan-tahun-ajaran').val();
                $(this).attr('action', "/tim_ta/ta1/administrasi/history_detail/" + {{$tahunAjaran->id}});
            });
        });
     </script>
@endsection