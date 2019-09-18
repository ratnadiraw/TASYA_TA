@extends('layouts.ta2.dosen')
@section('content')
    <div class="container">
        <h3>Daftar Progress Tugas Akhir 2 </h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <th> No </th>
                <th> NIM </th>
                <th> Mahasiswa </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1 ?>
            @foreach($list_summary as $summary)
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$summary->nim}}</td>
                    <td>{{$summary->nama}}</td>
                    <td>
                        <form action="/dosen/ta2/progress_summary/view_progress_summary/{{$summary->ps_id}}" method="get">
                            <button class="btn btn-primary"> Lihat </button>
                        </form>
                    </td>
                </tr>
                <?php $no++ ?>
            @endforeach
            </tbody>
        </table>
        {{$list_summary->links()}}
    </div>
@endsection