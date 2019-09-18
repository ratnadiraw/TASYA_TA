@extends('layouts.tu')
@section('title')
    <title>Pendaftaran Tim TA</title>
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
        <h3>Add New TimTA</h3>
        <form action="/tu/pendaftaran/addtimta" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table>
                <tr>
                    <td class="tu-table-td-form"><label for="name">Nama:</label></td>
                    <td class="tu-table-td-form"><label for="email">Email:</label></td>
                </tr>
                <tr>
                    <td class="tu-table-td-form"><input name="name" type="text" class="form-control" id="name"></td>
                    <td class="tu-table-td-form"><input name="email" type="email" class="form-control" id="email"></td>
                    <td class="tu-table-td-form"><button type="submit" class="btn btn-primary align-self-center">Tambah Tim TA</button></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="container">
        @if (count($listOfTimTA) > 0)
            <h3 class="top-buffer">List of TimTA</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listOfTimTA as $timta)
                    <tr>
                        <td>{{$timta->name}}</td>
                        <td>{{$timta->email}}</td>
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
            {{$listOfTimTA->links()}}
        @else

        @endif
    </div>
@endsection