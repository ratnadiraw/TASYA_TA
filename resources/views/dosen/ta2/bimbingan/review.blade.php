@extends('layouts.ta2.dosen')
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


        <div class="card edit-mom">
            <div class="card-header">Minutes of Meeting Bimbingan Tugas Akhir</div>
            <div class="card-body">
                <div class="add-bimbingan-content">
                    <div class="add-bimbingan-content-field font-weight-bold">
                        Tanggal: {{App\Http\Controllers\DateID::formatDate($bimbingan->tanggal, false)}}
                    </div>
                    <div class="add-bimbingan-content-field font-weight-bold">
                        Hasil Diskusi : {{$bimbingan->hasil_diskusi}}
                    </div>
                    <div class="add-bimbingan-content-field font-weight-bold">
                        Rencana Tindak Lanjut : {{$bimbingan->rencana_tindak_lanjut}}
                    </div>
                    <div class="add-bimbingan-content-field font-weight-bold">
                        @if($bimbingan->approved == 0)
                            Komentar:
                            <form action="/dosen/ta2/bimbingan/approve_bimbingan/{{$nim}}">
                                <textarea name="komentar" class="form-control" rows="5" id="diskusi" width="276"></textarea>
                                <input type="hidden" name="id" value="{{$bimbingan->bimbingan_id}}">
                                <div class="col md-4">
                                    <button class="btn-primary" type="submit" name="button_bimbingan" value="1">
                                        Approve
                                    </button>

                                    <button class="btn-danger" type="submit" name="button_bimbingan" value="0">
                                        Reject
                                    </button>
                                </div>
                            </form>

                        @elseif($bimbingan->approved ==1)
                            Komentar: {{$bimbingan->komentar}}

                        @elseif($bimbingan->approved ==2)
                            Komentar: {{$bimbingan->komentar}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection