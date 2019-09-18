<?php

namespace App\Http\Controllers\TU\TA2\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class UnduhDokumen extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        return view('tu.ta2.administrasi.unduh_dokumen');
    }

    public function downloadFormSeminar() {
        //TO-DO: change path
        return Response::download(public_path().'/Sidang/FormSidangTAII.pdf');
    }

    public function downloadFormSidang() {
        return Response::download(public_path().'/Sidang/FormSidangTAII.pdf');
    }

    public function downloadFormPembatalanSidang() {
        return Response::download(public_path().'/Sidang/FormPembatalanSidangTAII.pdf');
    }

}