<?php

namespace App\Http\Controllers\TU\TA1\Seminar;

use App\ConfigHunter;
use App\Month;
use Validator;
use App\Mahasiswa;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\TA1_Seminar;
use App\TA1_Surat_Seminar;
use App\TA1_Tugas_Akhir;
use App\Dosen;
use PDF;
use Zipper;
use App\TahunAjaran;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class Seminar extends Controller
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
        if (!isset($_COOKIE['active'])) {
            $data['ac'] = 'persiapan';
        } else {
            $data['ac'] = $_COOKIE['active'];
        }
        $listOfSeminar = DB::table('ta1_seminar')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->where('ta1_seminar.final', 1)
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta1_seminar.ruangan as ruangan',
                'ta1_seminar.waktu as waktu', 'ta1_seminar.id as id', 'ta1_seminar.kloter', 'ta1_seminar.shift')
            ->get();
        $data['listOfSeminar'] = $listOfSeminar;

        $suratid = TA1_Surat_Seminar::whereNotNull('pembimbing_id')
            ->whereNotNull('penguji1_id')
            ->pluck('seminar_id');

        $seminars = DB::table('ta1_seminar')->whereIn('ta1_seminar.id', $suratid)
            ->whereNotNull('ta1_seminar.ruangan')
            ->whereNotNull('ta1_seminar.waktu')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->where('ta1_seminar.final', 1)
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta1_seminar.ruangan as ruangan',
                'ta1_seminar.waktu as waktu', 'ta1_seminar.id as id')
            ->get();

        $data['seminars'] = $seminars;

        $data['hasilseminars'] = TA1_Seminar::paginate(10);

        if (ConfigHunter::where('key', 'nama_kaprodi')->first() == null) {
            $data['nama_kaprodi'] = null;
            $data['nip_kaprodi'] = null;
        } else {
            $data['nama_kaprodi'] = ConfigHunter::where('key', 'nama_kaprodi')->first()->value;
            $data['nip_kaprodi'] = ConfigHunter::where('key', 'nip_kaprodi')->first()->value;
        }

        return view('tu.ta1.seminar.seminar', $data);
    }

    public function editSeminar(Request $request)
    {
        $request->validate([
            'datetime.*' => 'nullable|date'
        ]);
        $seminarId = $request->input('seminar-id');
        $room = $request->input('room');
        $datetime = $request->input('datetime');

        $counter = 0;
        foreach ($seminarId as $id) {
            error_log($room[$counter]);
            error_log($datetime[$counter]);
            DB::table('ta1_seminar')
                ->where('id', $id)
                ->update([
                    'ruangan' => $room[$counter],
                    'waktu' => Carbon::parse($datetime[$counter])
                ]);
            $counter++;
        }
        return redirect('/tu/ta1/seminar/seminar');
    }

    public function BAPSeminarIndex()
    {
        $data['seminars'] = DB::table('ta1_seminar')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->get();
        return view('tu.ta1.seminar.bap_seminar', $data);
    }

    public function suratSeminarIndex()
    {
        $seminars = DB::table('ta1_seminar')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta1_seminar.ruangan as ruangan',
                'ta1_seminar.waktu as waktu', 'ta1_seminar.id as id')
            ->get();

        $data['seminars'] = $seminars;
        return view('tu.ta1.seminar.surat_seminar', $data);
    }

    public function cetakSuratSeminar(Request $req) {
        $req->validate([
            'no_kop_inc' => 'required|numeric',
            'tanggal_terbit' => 'required|date',
            'no_kop' => 'required',
            'nama_kaprodi' => 'required',
            'nip_kaprodi' => 'required|numeric'
        ]);
        $directoryPath = '/pdf-seminar/';

        \Storage::deleteDirectory($directoryPath);
        \Storage::makeDirectory($directoryPath);

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
                // if (TA1_Surat_Seminar::where('seminar_id', $surat)->first() == null) {
                //     $suratseminar = new TA1_Surat_Seminar;
                // } else {
                //     $suratseminar = TA1_Surat_Seminar::where('seminar_id', $surat)->first();
                // }

                // $suratseminar->seminar_id = $surat;
                // $dosbings = Seminar::find($surat)
                //         ->TA1_Tugas_Akhir
                //         ->pembimbing;
                // $i = 1;
                // foreach ($dosbings as $dosbing) {
                //     if ($i == 1) {
                //         $suratseminar->pembimbing_id = $dosbing->user_id;    
                //     } else {
                //         $suratseminar->pemimbing_opsional_id = $dosbing->user_id;
                //     }
                // }

                // $suratseminar->save();

                $suratseminar = TA1_Surat_Seminar::where('seminar_id', $surat)->first();

                $pembimbing1 = Dosen::find($suratseminar->pembimbing_id)->nama;

                if ($suratseminar->pemimbing_opsional_id != null) {
                    $pembimbing2 = Dosen::find($suratseminar->pemimbing_opsional_id)->nama;
                } else {
                    $pembimbing2 = null;
                }

                $penguji1 = Dosen::find($suratseminar->penguji1_id)->nama;

                if ($suratseminar->penguji2_id != null) {
                    $penguji2 = Dosen::find($suratseminar->penguji2_id)->nama;
                } else {
                    $penguji2 = null;
                }

                $suratseminar->nomor_kop_surat = $inc.$req->input('no_kop');
                $suratseminar->tanggal_terbit = $req->input('tanggal_terbit');

                $suratseminar->save();

                $tahunajaran = TahunAjaran::latest()->first();
                $semester = 'Semester '.$tahunajaran->semester.' - '.$tahunajaran->tahun;

                $now_dumm = date_format(date_create($suratseminar->tanggal_terbit), 'd n Y');
                $now_arr = explode(' ', $now_dumm);
                $now = $now_arr[0].' '.Month::where('id', $now_arr[1])->first()->bulan.' '.$now_arr[2];

                $data = [
                    'kop_surat' => $suratseminar->nomor_kop_surat,
                    'tanggal_terbit' => $now,
                    'nama_mahasiswa' => $suratseminar->seminar->TA1_Tugas_Akhir->mahasiswa->nama,
                    'nim_mahasiswa' => $suratseminar->seminar->TA1_Tugas_Akhir->mahasiswa->nim,
                    'pembimbing1' => $pembimbing1,
                    'pembimbing2' => $pembimbing2,
                    'penguji1' => $penguji1,
                    'penguji2' => $penguji2,
                    'judul' => $suratseminar->seminar->judul,
                    'semester' => $semester,
                    'nama_kaprodi' => $nama_kaprodi,
                    'nip_kaprodi' => $nip_kaprodi,
                ];

                // $pdf->AddPage();
                $pdf = PDF::loadView('tu.ta1.seminar.pdf_surat_seminar', $data);
                $filename = storage_path().'/app/pdf-seminar/sk-'.$suratseminar->seminar->TA1_Tugas_Akhir->mahasiswa->nim;
                $pdf->save($filename.'.pdf');

                // $pdf->WriteHTML('tu.ta1.administrasi.pdf_surat_tugas', $data);
                $inc++;
            }
            // foreach ($files as $file) {
            //     return asset($file);
            // }

            $files = glob(storage_path().'/app/pdf-seminar/*.pdf');
            Zipper::make(storage_path().'/app/pdf-seminar/sk_seminar.zip')->add($files)->close();

            return Response::download(storage_path().'/app/pdf-seminar/sk_seminar.zip');
        } else {
            return back();
        }
    }


    public function downloadFormBAP() {
        return Response::download(public_path().'/BAP/BAPSeminarTA1.pdf');
    }

    public function saveBAP(Request $req) {
        $rules = [
            'BAP' => 'required|mimes:pdf|max:16000',
        ];

        $validate = Validator::make($req->all(), $rules);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        } else {
            $mahasiswa = Mahasiswa::where('nim', $req->input('nim'))->first();

            echo $req->input('nim');
            $seminar = TA1_Seminar::where(
                'ta_id', TA1_Tugas_Akhir::where('mahasiswa_id', $mahasiswa->user_id)->first()->id
            )->first();

            $seminar->nilai = $req->input('nilai');

            $f = $req->file('BAP');
            $seminar->berkas_seminar = base64_encode(
                file_get_contents($f->getRealPath())
            );

            $seminar->save();
            return back();
        }
    }

    public function downloadBAP($id) {
        $bap = TA1_Seminar::find($id)->berkas_seminar;

        header("Content-Type: application/pdf");
        echo base64_decode($bap);
    }

    public function deleteBAP($id) {
        $bap = TA1_Seminar::find($id);

        $bap->berkas_seminar = null;

        $bap->save();

        return back();
    }
}
