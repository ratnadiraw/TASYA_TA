<?php

namespace App\Http\Controllers\TU\TA2\Kelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KelasTA2 extends Controller
{
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
        $tim_ta = DB::table('tim_ta')
            ->join('users','tim_ta.user_id', '=', 'users.id')
            ->select('users.name as nama', 'users.id as id')
            ->get();

        $kelas = DB::table('ta2_kelas')
            ->where('ta2_kelas.status_kelas', '=', 0)
            ->select('ta2_kelas.kelas_id as id', 'ta2_kelas.tahun as tahun', 'ta2_kelas.semester as semester')
            ->get();

        $all_periode = DB::table('tahun_ajaran')
            ->select('tahun_ajaran.tahun as tahun', 'tahun_ajaran.semester as semester')
            ->get();
        $count = count($all_periode);

        $periode = $all_periode[$count - 1];
        $tahun = $periode->tahun;
        $semester = $periode->semester;

        $all_mahasiswa = session('all_mahasiswa');

        if(empty($all_mahasiswa))
        {
            $tahun_list_mahasiswa = $tahun;
            $semester_list_mahasiswa = $semester;

            $kelas_periode = DB::table('ta2_kelas')
                ->where('ta2_kelas.tahun', '=', $tahun)
                ->where('ta2_kelas.semester', '=', $semester)
                ->select('ta2_kelas.kelas_id as id')
                ->first();

            if(!empty($kelas_periode))
            {
                $kelas_id = $kelas_periode->id;

                $all_mahasiswa = DB::table('ta2_mahasiswa_kelas')
                    ->where('ta2_mahasiswa_kelas.kelas_id', '=', $kelas_id)
                    ->join('mahasiswa', 'ta2_mahasiswa_kelas.mahasiswa_id', '=', 'mahasiswa.user_id')
                    ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim')
                    ->get();
            }
        }
        else
        {
            $tahun_list_mahasiswa = session('tahun');
            $semester_list_mahasiswa = session('semester');
        }

        return view('tu.ta2.kelas.add_kelas',[
            'all_tim_ta' => $tim_ta,
            'all_kelas' => $kelas,
            'all_mahasiswa' => $all_mahasiswa,
            'tahun' => $tahun,
            'semester' => $semester,
            'tahun_list_mahasiswa' => $tahun_list_mahasiswa,
            'semester_list_mahasiswa' => $semester_list_mahasiswa,
        ]);
    }

    public function addNewKelas(Request $request)
    {
        $tahun = $request['Tahun'];
        $semester = $request['Semester'];
        $tim_ta_id = $request['tim_ta_id'];


        DB::table('ta2_kelas')
            ->insert([
                'tim_ta_id' => $tim_ta_id,
                'semester' => $semester,
                'tahun' => $tahun,
                'status_kelas' => 0
            ]);

        return redirect('/tu/ta2/kelas/add_kelas');
    }

    public function addMahasiswa(Request $request)
    {
        $nim = $request['nim'];
        $kelas_id = $request['kelas_id'];

        $mahasiswa_id = DB::table('mahasiswa')
            ->where('mahasiswa.nim', '=', $nim)
            ->select('mahasiswa.user_id as id')
            ->first()
            ->id;

        DB::table('ta2_mahasiswa_kelas')
            ->insert([
                'mahasiswa_id' => $mahasiswa_id,
                'kelas_id' => $kelas_id,
                'jumlah_kehadiran_kelas' => 0
            ]);

        $all_tugas = DB::table('ta2_tugas_kelas')
			->where('ta2_tugas_kelas.kelas_id', '=', $kelas_id)
			->select('ta2_tugas_kelas.tugas_id as id')
			->get();

        if(count($all_tugas) > 0)
		{
			foreach($all_tugas as $tugas)
			{
				DB::table('ta2_tugas_mahasiswa')
					->insert([
						'tugas_id' => $tugas->id,
						'mahasiswa_id' => $mahasiswa_id,
						'sudah_dinilai' => 0
					]);
			}
		}

        return redirect('/tu/ta2/kelas/add_kelas');
    }


    public function addMahasiswaBatch(Request $request) {
        if ($request->file('excel')->isValid()) {
            $file = $request->file('excel');
            $date = Carbon::now('Asia/Jakarta');
            if ($date->month >=1 && $date->month <= 5) {
                $semester = 'II';
            } else if ($date->month >=8 && $date->month<=12) {
                $semester = 'I';
            }
            $fileName = 'DPK_'.$semester.'_'.$date->year.'_'.$date->format('d-m-Y').'.'.$file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $filePath = $request->file('excel')->storeAs('DPK',$fileName);
            $this->parseExcel($filePath,$fileType,$request['kelas_id']);
        } else {
            echo 'Upload Failed';
        }
        return back();
    }

    private function parseExcel($filePath,$fileType,$kelas_id) {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($fileType));
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load(storage_path().'/app/'.$filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRowIdx = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIdx = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        for ($row = 2; $row < $highestRowIdx; $row++) {
            $nim = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $mahasiswa = DB::table('mahasiswa')
                ->where('mahasiswa.nim', '=', $nim)
                ->first();
            if ($mahasiswa != null) {
                $mahasiswa_id = $mahasiswa->user_id;
                $mahasiswa_kelas = DB::table('ta2_mahasiswa_kelas')
                    ->where('mahasiswa_id', '=', $mahasiswa_id)
                    ->where('kelas_id', '=', $kelas_id)
                    ->first();
                if ($mahasiswa_kelas == null) {
                    DB::table('ta2_mahasiswa_kelas')
                        ->insert([
                            'mahasiswa_id' => $mahasiswa_id,
                            'kelas_id' => $kelas_id,
                            'jumlah_kehadiran_kelas' => 0
                        ]);
                    $all_tugas = DB::table('ta2_tugas_kelas')
                        ->where('ta2_tugas_kelas.kelas_id', '=', $kelas_id)
                        ->select('ta2_tugas_kelas.tugas_id as id')
                        ->get();

                    if(count($all_tugas) > 0)
                    {
                        foreach($all_tugas as $tugas)
                        {
                            DB::table('ta2_tugas_mahasiswa')
                                ->insert([
                                    'tugas_id' => $tugas->id,
                                    'mahasiswa_id' => $mahasiswa_id,
                                    'sudah_dinilai' => 0
                                ]);
                        }
                    }
                }
            }
        }
    }

    public function showMahasiswaKelas(Request $request)
    {
        $kelas_id = $request['kelas_id'];

        $all_mahasiswa = DB::table('ta2_mahasiswa_kelas')
            ->where('ta2_mahasiswa_kelas.kelas_id', '=', $kelas_id)
            ->join('mahasiswa', 'ta2_mahasiswa_kelas.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim')
            ->get();

        $kelas = DB::table('ta2_kelas')
            ->where('ta2_kelas.kelas_id', '=', $kelas_id)
            ->select('ta2_kelas.tahun as tahun', 'ta2_kelas.semester as semester')
            ->first();

        $tahun = $kelas->tahun;
        $semester = $kelas->semester;

        return redirect('/tu/ta2/kelas/add_kelas')->with([
            'all_mahasiswa' => $all_mahasiswa,
            'tahun' => $tahun,
            'semester' => $semester
        ]);
    }

    public function listKelas()
	{
		$all_kelas = DB::table('ta2_kelas')
			->where('ta2_kelas.status_kelas', '=', 0)
			->select('ta2_kelas.kelas_id as id', 'ta2_kelas.tahun as tahun', 'ta2_kelas.semester as semester')
			->get();

		$kelas_reverse = [];
		$count = count($all_kelas);
		for($idx = $count - 1; $idx >= 0; $idx--) array_push($kelas_reverse, $all_kelas[$idx]);

		return view('tu.ta2.kelas.daftar_kelas', [
			'all_kelas' => $kelas_reverse
		]);
    }
}