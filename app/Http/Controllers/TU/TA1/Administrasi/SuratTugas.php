<?php

namespace App\Http\Controllers\TU\TA1\Administrasi;

use App\Month;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\TA1_Tugas_Akhir;
use App\TA1_Surat_Tugas;
use PDF;
use ZipArchive;
use Zipper;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\ConfigHunter;

class SuratTugas extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (ConfigHunter::where('key', 'nama_kaprodi')->first() == null) {
            $data['nama_kaprodi'] = null;
            $data['nip_kaprodi'] = null;
        } else {
            $data['nama_kaprodi'] = ConfigHunter::where('key', 'nama_kaprodi')->first()->value;
            $data['nip_kaprodi'] = ConfigHunter::where('key', 'nip_kaprodi')->first()->value;
        }

        $data['tas'] = TA1_Tugas_Akhir::where('status_checkout',false)->whereNotNull('topik_id')->get();

        return view('tu.ta1.administrasi.daftar_surat_tugas', $data);
    }

    public function addNewSuratTugasIndex($id)
    {
        if (TA1_Surat_Tugas::where('ta_id', $id)->first() == null) {
            $surattugas = null;
        } else {
            $surattugas = TA1_Surat_Tugas::where('ta_id', $id)->first();
        }
        $data['taid'] = $id;
        $data['surattugas'] = $surattugas;
        return view('tu.ta1.administrasi.pembuatan_surat_tugas', $data);
    }

    public function saveSuratTugas($id, Request $request) {
        if (TA1_Surat_Tugas::where('ta_id', $id)->first() == null) {
            $surattugas = new TA1_Surat_Tugas;
        } else {
            $surattugas = TA1_Surat_Tugas::where('ta_id', $id)->first();
        }

        $surattugas->ta_id = $id;
        $surattugas->nomor_kop_surat = $request->input('kop_surat');
        $surattugas->tanggal_terbit = Carbon::parse($request->input('tanggal_terbit'));

        $surattugas->save();

        return back();
    }

    public function cetakSuratTugas($id) {
        $surattugas = TA1_Surat_Tugas::where('ta_id', $surat)->first();

        $now_dumm = date_format(date_create($surattugas->tanggal_terbit), 'd n Y');
        $now_arr = explode(' ', $now_dumm);
        $now = $now_arr[0].' '.Month::where('id', $now_arr[1])->first()->bulan.' '.$now_arr[2];

        $data = [
            'kop_surat' => $surattugas->nomor_kop_surat,
            'tanggal_terbit' => $now,
            'nama_mahasiswa' => $surattugas->TA1_Tugas_Akhir->mahasiswa->nama,
            'nim_mahasiswa' => $surattugas->TA1_Tugas_Akhir->mahasiswa->nim,
            'topik' => $surattugas->TA1_Tugas_Akhir->nama_topik,
            'dosbings' => $surattugas->TA1_Tugas_Akhir->pembimbing,
        ];

        // // $pdf = view('tu.ta1.administrasi.pdf_surat_tugas', compact('surattugas'));
        // $pdf = view('tu.ta1.administrasi.pdf_surat_tugas')->render;

        // return PDF::load($pdf)->download();
        $pdf = PDF::loadView('tu.ta1.administrasi.pdf_surat_tugas', $data);
        return $pdf->download('sk.pdf');
    }

    public function printIndex() {
        $data['tas'] = TA1_Tugas_Akhir::all();

        return view('tu.ta1.administrasi.cetak_semua_surat_tugas', $data);
    }

    public function printAll(Request $req, Response $response) {
        // $pdf = new \mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0);
        $req->validate([
            'no_kop_inc' => 'required|integer',
            'tanggal_terbit' => 'required|date',
            'no_kop' => 'required',
            'nama_kaprodi' => 'required',
            'nip_kaprodi' => 'required|numeric'
        ]);
        $directoryPath = '/pdf/';

        \Storage::deleteDirectory($directoryPath);
        \Storage::makeDirectory($directoryPath);

        $files = array();
        if ($req->input('surat')) {
            $inc = $req->input('no_kop_inc');

            $nama_kaprodi = $req->input('nama_kaprodi');
            $nip_kaprodi = $req->input('nip_kaprodi');

            if (ConfigHunter::where('key', 'nama_kaprodi')->first() != null) {
                $conf = ConfigHunter::where('key', 'nama_kaprodi')->first();
            } else {
                $conf = new ConfigHunter;
                $conf->key = 'nama_kaprodi';
            }

            $conf->value = $nama_kaprodi;
            $conf->save();

            if (ConfigHunter::where('key', 'nip_kaprodi')->first() != null) {
                $conf = ConfigHunter::where('key', 'nip_kaprodi')->first();
            } else {
                $conf = new ConfigHunter;
                $conf->key = 'nip_kaprodi';
            }

            $conf->value = $nip_kaprodi;

            $conf->save();

            foreach ($req->input('surat') as $surat) {
                if (TA1_Surat_Tugas::where('ta_id', $surat)->first() == null) {
                    $surattugas = new TA1_Surat_Tugas;
                } else {
                    $surattugas = TA1_Surat_Tugas::where('ta_id', $surat)->first();
                }

                $surattugas->ta_id = $surat;
                $surattugas->nomor_kop_surat = $inc.$req->input('no_kop');
                $surattugas->tanggal_terbit = $req->input('tanggal_terbit');

                $surattugas->save();

                $surattugas = TA1_Surat_Tugas::where('ta_id', $surat)->first();

                $now_dumm = date_format(date_create($surattugas->tanggal_terbit), 'd n Y');
                $now_arr = explode(' ', $now_dumm);
                $now = $now_arr[0].' '.Month::where('id', $now_arr[1])->first()->bulan.' '.$now_arr[2];

                $data = [
                    'kop_surat' => $surattugas->nomor_kop_surat,
                    'tanggal_terbit' => $now,
                    'nama_mahasiswa' => $surattugas->TA1_Tugas_Akhir->mahasiswa->nama,
                    'nim_mahasiswa' => $surattugas->TA1_Tugas_Akhir->mahasiswa->nim,
                    'topik' => $surattugas->TA1_Tugas_Akhir->nama_topik,
                    'dosbings' => $surattugas->TA1_Tugas_Akhir->pembimbing,
                    'nama_kaprodi' => $nama_kaprodi,
                    'nip_kaprodi' => $nip_kaprodi,
                ];

                // $pdf->AddPage();
                $pdf = PDF::loadView('tu.ta1.administrasi.pdf_surat_tugas', $data);
                $filename = storage_path().'/app/pdf/sk-'.$surattugas->TA1_Tugas_Akhir->mahasiswa->nim;
                $pdf->save($filename.'.pdf');

                // $pdf->WriteHTML('tu.ta1.administrasi.pdf_surat_tugas', $data);
                array_push($files, $filename.'.pdf');
                $inc++;
            }

            $files = glob(storage_path().'/app/pdf/*.pdf');
            Zipper::make(storage_path().'/app/pdf/sk_pembimbing.zip')->add($files)->close();

            return Response::download(storage_path().'/app/pdf/sk_pembimbing.zip');
        } else {
            return back();
        }
    }
}
