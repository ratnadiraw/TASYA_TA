<?php

namespace App\Http\Controllers\TU;

use App\DosenTemp;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TU\TA1\Administrasi\ProgressSummary;
use App\Mahasiswa;
use App\TA2_Progress_Summary;
use App\TA1_Tugas_Akhir;
use App\TA1_ProgressSummary;
use App\User;
use Carbon\Carbon;
use App\TA2_TA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Dosen;
use App\TimTA;
use App\TU;
use Illuminate\Validation\Rule;

class PendaftaranMahasiswa extends Controller
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
            $data['active'] = 'mahasiswa';
        } else {
            $data['active'] = $_COOKIE['active'];
        }

        $data['listOfMahasiswa'] = DB::table('mahasiswa')
            ->join('users', 'users.id', '=' ,'mahasiswa.user_id')
            ->get();

        $data['listOfDosen'] = DB::table('dosentemp')
            ->join('users', 'users.id', '=' ,'dosentemp.user_id')
            ->get();

        $data['listOfTimTA'] = DB::table('tim_ta')
            ->join('users', 'users.id', '=' ,'tim_ta.user_id')
            ->get();

        $data['listOfTU'] = DB::table('tu')
            ->join('users', 'users.id', '=' ,'tu.user_id')
            ->get();
        return view('tu.pendaftaran.mahasiswa',  $data);
    }

    public function addMahasiswa(Request $request)
    {
        if ($request->input('submit') == 'mahasiswa') {
            $request->validate([
                'NIM' => 'required|digits:8',
                'name' => 'required',
                'email' => 'required|email',
                'passing-sks' => 'required|integer',
            ]);

            $nim = $request->input('NIM');
            $name = $request->input('name');
            $email = $request->input('email');
            $passingSKS = $request->input('passing-sks');
            $password = bcrypt('TA_'.$nim);

            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->save();

            $last_id = $user->id;
            $mahasiswa = new Mahasiswa;
            $mahasiswa->user_id = $last_id;
            $mahasiswa->nim = $nim;
            $mahasiswa->nama = $name;
            $mahasiswa->jumlah_sks_lulus = $passingSKS;
            $mahasiswa->angkatan = '20'.substr($nim, 3, 2);
            $mahasiswa->save();

        } else if ($request->input('submit') == 'dosen') {
            $email = $request->input('email');
            $request->validate([
                'NIP-dosen' => 'required',
                'name' => 'required',
                'inisial' => 'unique:dosentemp|required',
                'wewenang-pembimbing' =>'required',
                'email' => 'unique:users|required|email',
//            'kk' => 'required',
//                'email' => ['required','email',
//                    Rule::exists('users', 'email')]
            ],[
                'email.exists' => "This email already used, use another email."
            ]);
            $nip = $request->input('NIP-dosen');
            $name = $request->input('name');
            $wewenang = $request->input('wewenang-pembimbing');
            $inisial = $request->input('inisial');
//            $kelompok_keahlian = $request->input('kk');
            $email = $request->input('email');
            $password = bcrypt('DOSEN_'.$nip);

            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->save();

            $last_id = $user->id;
            $dosen = new DosenTemp;
            $dosen->user_id = $last_id;
            $dosen->nip = $nip;
            $dosen->nama = $name;
            $dosen->inisial = $inisial;
            $dosen->wewenang_pembimbing = $wewenang;
            $dosen->save();
        } else if ($request->input('submit') == 'timta') {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);
            $name = $request->input('name');
            $email = $request->input('email');
            $password = bcrypt('TimTA_'.$email);

            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->save();

            $last_id = $user->id;
            $timta = new TimTA;
            $timta->user_id = $last_id;
            $timta->save();
        } else if ($request->input('submit') == 'tu') {
            $request->validate([
                'NIP-tu' => 'required|numeric',
                'name' => 'required',
                'email' => 'required|email',
            ]);
            $nip = $request->input('NIP-tu');
            $name = $request->input('name');
            $email = $request->input('email');
            $password = bcrypt('TU_'.$nip);

            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->save();

            $last_id = $user->id;
            $tu = new TU;
            $tu->user_id = $last_id;
            $tu->nip = $nip;
            $tu->nama = $name;
            $tu->save();
        }
        return back();
    }

    public function batchMahasiswa(Request $request) {
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
            $this->parseExcel($filePath,$fileType);
        } else {
            echo 'Upload Failed';
        }
        return back();
    }

    private function parseExcel($filePath,$fileType) {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($fileType));
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load(storage_path().'/app/'.$filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRowIdx = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIdx = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        for ($row = 2; $row < $highestRowIdx; $row++) {
            $nim = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $name = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $email = $nim.'@std.stei.itb.ac.id';
            $generation = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $credits = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $password = bcrypt('TA_'.$nim);

            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->save();

            $last_id = $user->id;
            $mahasiswa = new Mahasiswa;
            $mahasiswa->user_id = $last_id;
            $mahasiswa->nim = $nim;
            $mahasiswa->nama = $name;
            $mahasiswa->angkatan = $generation;
            $mahasiswa->jumlah_sks_lulus = $credits;
            $mahasiswa->save();
        }
    }

    public function delete($id) {
        $user = User::find($id);
        $mhs = Mahasiswa::find($id);


        $mhs->delete();
        $user->delete();

        return back();
    }

    public function show($id) {
        $mhs = Mahasiswa::find($id);
        $mhs['email'] = User::find($mhs->user_id)->email;
        $data['mahasiswa'] = $mhs;

        return view('tu.pendaftaran.mahasiswa_update', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'NIM' => 'required|digits:8',
            'name' => 'required',
            'email' => 'required|email',
            'generation' => 'required|integer',
            'sks_lulus' => 'required|integer',
        ]);

        $mhs = Mahasiswa::find($id);
        $user = User::find($mhs->user_id);

        $mhs->nim = $request->input('NIM');
        $mhs->nama = $request->input('name');
        $mhs->jumlah_sks_lulus = $request->input('sks_lulus');
        $mhs->angkatan = $request->input('generation');

        $mhs->save();

        $user->email = $request->input('email');

        $user->save();

        return redirect('/tu/pendaftaran/user');
    }
}
