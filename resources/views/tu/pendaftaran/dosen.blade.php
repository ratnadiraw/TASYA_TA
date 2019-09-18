@extends('layouts.tu')
@section('title')
    <title>Pendaftaran Dosen</title>
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
        <h3>Add New Dosen</h3>
        <form action="/tu/pendaftaran/adddosen" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table>
                <tr>
                    <td class="tu-table-td-form"><label for="NIP">NIP:</label></td>
                    <td class="tu-table-td-form"><label for="name">Nama:</label></td>
                    <td class="tu-table-td-form"><label for="kk">KK:</label></td>
                    <td class="tu-table-td-form"><label for="email">Email:</label></td>
                </tr>
                <tr>
                    <td class="tu-table-td-form"><input name="NIP" type="text" class="form-control" id="NIP"></td>
                    <td class="tu-table-td-form"><input name="name" type="text" class="form-control" id="name"></td>
                    <td class="tu-table-td-form">
                        <select name="kk" class="form-control" id="kk">
                            <option value="" disabled selected>Kelompok Keahlian</option>
                            <option value="Rekayasa Perangkat Lunak dan Data">Rekayasa Perangkat Lunak & Data</option>
                            <option value="Grafika dan Intelegensia Buatan">Grafika dan Intelegensia Buatan</option>
                            <option value="Ilmu Rekayasa Komputasi" >Ilmu Rekayasa Komputasi</option>
                            <option value="Sistem Terdistribusi">Sistem Terdistribusi</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                        </select>
                    </td>
                    <td class="tu-table-td-form"><input name="email" type="email" class="form-control" id="email"></td>
                    <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Tambah Dosen</button></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="container">
        @if (count($listOfDosen) > 0)
            <h3 class="top-buffer">List of Dosen</h3>
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NAMA</th>
                            <th>NIP</th>
                            <th>KK</th>
                            <th>EMAIL</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($listOfDosen as $dosen)
                           <tr>
                               <td>{{$dosen->nama}}</td>
                               <td>{{$dosen->nip}}</td>
                               <td>{{$dosen->kelompok_keahlian}}</td>
                               <td>{{$dosen->email}}</td>
                               <td>
                                   <form>
                                       <button type="submit" class="btn btn-warning">
                                           Ubah
                                       </button>
                                   </form>
                               </td>
                               <td>
                                   <form>
                                       <button type="submit" class="btn btn-danger">
                                           Hapus
                                       </button>
                                   </form>
                               </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
                {{$listOfDosen->links()}}
        @else

        @endif
    </div>
@endsection
