@extends('layouts.timta')
@section('title')
    <title>Tahun Ajaran</title>
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Tambah Tahun Ajaran</h3></div>
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
				<form action="/tim_ta/add_tahun_ajaran" method="POST">
                	<table>
	                    <tr>
	                    	<td class="tu-table-td-form"><label for="semester">Semester:</label></td>
	                    	<td class="tu-table-td-form"><label for="year">Tahun Ajaran:</label></td>
	                    	<td class="tu-table-td-form"><label for="start-date">Tanggal Mulai:</label></td>
	                    	<td class="tu-table-td-form"><label for="end-date">Tanggal Selesai:</label></td>
	                    	<td/>
	                    </tr>
	                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                    <tr>
	                        <td class="tu-table-td-form">
	                            <select name="semester" class="form-control" id="semester">
	                                <option value="1">I</option>
	                                <option value="2">II</option>
	                                <option value="3">III</option>
	                            </select>
	                        </td>
	                        <td class="tu-table-td-form">
	                            <select name="year" class="form-control" id="year">
	                                @php
	                                    $earliest_year = 2000;
	                                    $selected_value = date('Y');
	                                    for ($year = $selected_value; $year > $earliest_year; $year--) {
	                                        print '<option value="'.$year.'/'.($year+1).'"'.($year == $selected_value ? ' selected' : '').'>'.$year.'/'.($year+1).'</option>';
	                                    }
	                                @endphp
	                            </select>
	                        </td>
	                        <td class="tu-table-td-form"><input name="start-date" type="date" class="form-control" id="start-date"></td>
	                        <td class="tu-table-td-form"><input name="end-date" type="date" class="form-control" id="end-date"></td>
	                        <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Tambah</button></td>
	                    </tr>
	            	</table>
	            </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header"><h3>Daftar Tahun Ajaran</h3></div>
            <div class="card-body">
                @if (count($listOfTahunAjaran) > 0)
                    <table class="table table-striped" id="tahun-ajaran-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp
                            @foreach ($listOfTahunAjaran as $tahunAjaran)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>{{$tahunAjaran->semester}}</td>
                                    <td>{{$tahunAjaran->tahun}}</td>
                                    <td>{{$tahunAjaran->tanggal_mulai}}</td>
                                    <td>{{$tahunAjaran->tanggal_selesai}}</td>
                                    <td>
                                        <form action="/tim_ta/edit_tahun_ajaran/{{$tahunAjaran->id}}" method="GET">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <button type="submit" class="btn btn-warning">Ubah</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Belum ada tahun ajaran.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#tahun-ajaran-table").dynatable();
            }
        );
        $.when($('#tahun-ajaran-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection
