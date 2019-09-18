@extends('layouts.ta2.tu')
@section('title')
    <title>Progress Mahasiswa | TU</title>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Daftar Progress Mahasiswa Tugas Akhir 2 </h3></div>
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
                @if (count($list_summary) > 0)
                    <table class="table table-striped" id="progress-summmary-TU-table">
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
                                    <form action="/tu/ta2/progress_summary/edit_progress_summary/{{$summary->ps_id}}" method="get">
                                        <button class="btn btn-primary">View</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $no++ ?>
                        @endforeach
                        </tbody>
                    </table>
                    {{$list_summary->links()}}
                @else
                    <p>Belum ada progress mahasiswa.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#progress-summmary-TU-table").dynatable();
            }
        );
        $.when($("#progress-summmary-TU-table").dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection