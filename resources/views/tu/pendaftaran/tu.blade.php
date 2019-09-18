@extends('layouts.tu')
@section('title')
    <title>Pendaftaran TU</title>
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
        <h3>Add New TU</h3>
        <form action="/tu/pendaftaran/addtu" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table>
                <tr>
                    <td class="tu-table-td-form"><label for="NIP">NIP:</label></td>
                    <td class="tu-table-td-form"><label for="name">Nama:</label></td>
                    <td class="tu-table-td-form"><label for="email">Email:</label></td>
                </tr>
                <tr>
                    <td class="tu-table-td-form"><input name="NIP" type="text" class="form-control" id="NIP"></td>
                    <td class="tu-table-td-form"><input name="name" type="text" class="form-control" id="name"></td>
                    <td class="tu-table-td-form"><input name="email" type="email" class="form-control" id="email"></td>
                    <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Tambah TU</button></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="container">
        @if (count($listOfTU) > 0)
            <h3 class="top-buffer">List of TU</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>NIP</th>
                        <th>EMAIL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listOfTU as $TU)
                        <tr>
                            <td>{{$TU->nama}}</td>
                            <td>{{$TU->nip}}</td>
                            <td>{{$TU->email}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else

        @endif
    </div>
@endsection
