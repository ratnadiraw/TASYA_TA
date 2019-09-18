<?php
/**
 * Created by PhpStorm.
 * User: wennyyustalim
 * Date: 04/04/18
 * Time: 20.30
 */

namespace App\Http\Controllers\TU\TA2\Seminar;

use App\TA2_BeritaAcara;
use App\TA2_Progress_Summary;
use App\TA2_Seminar;
use App\TA2_TA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mahasiswa;
use Carbon\Carbon;

class BeritaAcara extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $listOfSeminar = DB::table('ta2_seminar')
            ->whereNotNull('tanggal')
            ->whereNotNull('ruangan')
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->where('ta2_ta.status_lulus', '!=', '1')
            ->where('ta2_seminar.status_pendaftaran', '!=', '4')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_seminar.ruangan as ruangan',
                'ta2_seminar.tanggal as tanggal', 'ta2_seminar.seminar_id as seminar_id',
                'ta2_progress_summary.ps_id as ps_id', 'ta2_ta.judul as judul')
            ->get();
        $data['listOfSeminar'] = $listOfSeminar;
        return view('tu.ta2.seminar.lampiran_berita_acara_seminar', $data);
    }

    public function viewBeritaAcara($seminar_id) {
        $seminar = DB::table('ta2_seminar')
            ->where('seminar_id', '=', $seminar_id)
            ->first();
        if ($seminar == null) {
            return back();
        }

        $data_summary = DB::table('ta2_seminar')
            ->where('ta2_seminar.seminar_id', '=', $seminar_id)
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_seminar.ruangan as ruangan',
                'ta2_seminar.tanggal as tanggal', 'ta2_seminar.seminar_id as seminar_id', 'ta2_ta.topik as topik',
                'ta2_seminar.status_pendaftaran as status_pendaftaran')
            ->first();

        $berita_acara = DB::table('ta2_berita_acara_seminar')
            ->where('ta2_berita_acara_seminar.seminar_id', '=', $seminar_id)
            ->join('ta2_seminar', 'ta2_seminar.seminar_id', '=', 'ta2_berita_acara_seminar.seminar_id')
            ->first();

        if ($berita_acara == null) {
            $beritaAcara = new TA2_BeritaAcara;
            $beritaAcara->seminar_id = $seminar_id;
            $beritaAcara->catatan = "";
            $beritaAcara->save();

            $berita_acara = DB::table('ta2_berita_acara_seminar')
                ->where('ta2_berita_acara_seminar.seminar_id', '=', $seminar_id)
                ->join('ta2_seminar', 'ta2_seminar.seminar_id', '=', 'ta2_berita_acara_seminar.seminar_id')
                ->first();
        }
        return view('tu.ta2.seminar.view_lampiran_berita_acara_seminar', [
            'berita_acara' => $berita_acara,
            'data_summary' => $data_summary,
            'seminar' => $seminar,
        ]);
    }

    public function editBeritaAcara($seminar_id) {
        $seminar = DB::table('ta2_seminar')
            ->where('seminar_id', '=', $seminar_id)
            ->first();
        if ($seminar == null) {
            return back();
        }

        $data_summary = DB::table('ta2_seminar')
            ->where('ta2_seminar.seminar_id', '=', $seminar_id)
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_seminar.ruangan as ruangan',
                'ta2_seminar.tanggal as tanggal', 'ta2_seminar.seminar_id as seminar_id', 'ta2_ta.topik as topik')
            ->first();

        $berita_acara = DB::table('ta2_berita_acara_seminar')
            ->where('ta2_berita_acara_seminar.seminar_id', '=', $seminar_id)
            ->join('ta2_seminar', 'ta2_seminar.seminar_id', '=', 'ta2_berita_acara_seminar.seminar_id')
            ->first();

        if ($berita_acara == null) {
            $beritaAcara = new TA2_BeritaAcara;
            $beritaAcara->seminar_id = $seminar_id;
            $beritaAcara->catatan = "";
            $beritaAcara->save();

            $berita_acara = DB::table('ta2_berita_acara_seminar')
                ->where('ta2_berita_acara_seminar.seminar_id', '=', $seminar_id)
                ->join('ta2_seminar', 'ta2_seminar.seminar_id', '=', 'ta2_berita_acara_seminar.seminar_id')
                ->first();
        }
        return view('tu.ta2.seminar.add_lampiran_berita_acara_seminar', [
            'berita_acara' => $berita_acara,
            'data_summary' => $data_summary,
            'seminar' => $seminar,
        ]);
    }

    public function editBeritaAcaraSubmit(Request $request) {
        $request->validate([
            'berita_acara_id' => 'required',
            'seminar_id' => 'required',
            'catatan' => 'required',
            'file_berita_acara' => 'required',
        ]);

        $berita_acara = TA2_BeritaAcara::find($request->input('berita_acara_id'));
        $berita_acara->catatan = $request->input('catatan');


        // Ubah status seminar dan ta
        $seminar = TA2_Seminar::find($berita_acara->seminar_id);
        $ta2 = TA2_TA::find($seminar->ta_id);
        if ($request->input('lulus') == 1) { //lulus
            $ta2->lulus_seminar = 1;
            $seminar->status_pendaftaran = 3;
        } else if ($request->input('lulus') == 0) { //tidak lulus
            $ta2->lulus_seminar = 0;
            $seminar->status_pendaftaran = 4;
            $ta2->mahasiswa_daftar_seminar = 0;
        }

        //berita acara seminar
        if ($request->file('file_berita_acara') != null) {
            $file_berita_acara = $request->file('file_berita_acara');
            $berita_acara->berita_acara = base64_encode(
                file_get_contents($file_berita_acara->getRealPath())
            );
        }


        $berita_acara->save();
        $ta2->save();
        $seminar->save();

        $ps_id = TA2_Progress_Summary::where([
            'ta_id' => $ta2->ta_id
        ])->first()->ps_id;
        return redirect('/tu/ta2/administrasi/edit_progress_summary/' . $ps_id);
    }

    public function downloadBeritaAcara($berita_acara_id) {
//        echo $berita_acara_id . '<br>';
        $bap = TA2_BeritaAcara::find($berita_acara_id)->berita_acara;

        header("Content-Type: application/pdf");
        echo base64_decode($bap);
    }
}