@extends('layouts.timta')
@section('title')
    <title>Agenda</title>
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
        	<div class="card-header"><h3>Pembuatan Agenda Baru</h3></div>
        	<div class="card-body">
        		<form action="/tim_ta/add_agenda" method="POST">
		            <input type="hidden" name="_token" value="{{ csrf_token() }}">
		            <div class="form-group col-xs-6 gap">
		                <label for="agenda">Agenda</label>
		                <input type="text" name="agenda" class="form-control" id="agenda">
		            </div>
		            <div class="form-group col-xs-6 gap">
		                <label for="bimbingan-date">Tanggal Mulai</label>
		                <input name="start-date" type="date" class="form-control" id="start-date">
		            </div>
		            <div class="form-group col-xs-6 gap">
		                <label for="next-bimbingan-date">Tanggal Berakhir</label>
		                <input name="end-date" type="date" class="form-control" id="end-date">
		            </div>
		            <div class="form-group col-xs-6 gap">
		                <button type="submit" class="btn btn-primary align-self-center">Tambah Agenda</button>
		            </div>
		        </form>
		    </div>
		</div>
	    <div class="card">
	        <div class="card-header">
	            <h3 class="top-buffer">Daftar Agenda</h3>
	        </div>
	        <div class="card-body">
	        	@if (count($listOfEvent) > 0)
			        <table class="table table-striped" id="agenda-table">
			            <thead>
			            <tr>
			                <th>No</th>
			                <th>Tanggal</th>
			                <th>Agenda Kegiatan</th>
							<th>Aksi</th>
			            </tr>
			            </thead>
			            <tbody>
			            @foreach ($listOfEvent as $key => $event)
			                <tr>
			                    <td>{{++$key}}</td>
			                    @if ($event->start_date === $event->end_date)
			                        <td>{{date('d-m-Y', strtotime($event->start_date))}}</td>
			                    @else
			                        <td>{{date('d-m-Y', strtotime($event->start_date))}} - {{date('d-m-Y', strtotime($event->end_date))}}</td>
			                    @endif
			                    <td>{{$event->title}}</td>
								<td>
									<form onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')" action="/tim_ta/delete_agenda/{{$event->id}}" method="GET">
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
			    	<p>Belum ada agenda.</p>
	        	@endif
	        </div>
	    </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function()
            {
                $("#agenda-table").dynatable();
            }
        );
        $.when($('#agenda-table').dynatable()).done(function() {
            // code to be ran after plugin has initialized
        });
    </script>
@endsection
