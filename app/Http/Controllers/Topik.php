<?php

namespace App\Http\Controllers;

use App\AreaKeilmuan;
use App\Dosen;
use App\DosenTemp;
use App\SubTopik;
use App\TopikTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\DB;
use \stdClass;

class Topik extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\Maatwebsite\Excel\Excel $excel)
    {
        $this->middleware('auth');
        $this->excel = $excel;
    }

    public function index()
    {
        $listOfKodeKeilmuan = AreaKeilmuan::all();
        $listOfDosen = DosenTemp::orderBy('nip', 'ASC')->get();
        if (!Auth::user()->isDosen()){
            return redirect('/home');
        }
        $idDosen = Auth::user()->id;
        $dosen = DosenTemp::where('user_id','=',$idDosen)->first();
        $nama = $dosen->user_id;
        $wewenang = $dosen->wewenang_pembimbing;
        return view('topik.home', [
            'listOfKodeKeilmuan' => $listOfKodeKeilmuan,
            'listOfDosen' => $listOfDosen,
            'nama' => $nama,
            'wewenang' =>$wewenang,
            'me' => Auth::user()->isTimTA()
        ]);
    }

    public function convertToObject($array) {
        $object = new stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->convertToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }
    public function addTopik(Request $request)
    {
        $aaa= $request->input('topik');
        $bbb= $request->input('date');
        $request->validate([
//            'checkbox_name' => 'required',
//            'topik' => ['required',Rule::exists('topiktemp')->where(function ($query) use ($bbb, $aaa) {
//                $query->where('tahun', $bbb)->where('topik', $aaa)->where('idDosen', Auth::user()->id);
//            })],
            'description' => 'required',
            'exp-lab' => 'required',
            'project' => 'required',
            'quota' => 'required|integer',

        ],[
//            'topik.exists' => "You already have that topic, please change to another topic."
        ]);
        if (!Auth::user()->isDosen()){
            return redirect('/home');
        }
        //cek dosennya cek tahunnya
        if (TopikTemp::where('topik','=',$request->input('topik'))->where('idDosen','=',Auth::user()->id )->where('tahun','=',$request->input('date'))->where('semester','=',$request->input('semester'))->exists()){
            return redirect('dosen/ta1/topik')->withInput()->withErrors("You already have that topic, please change to another topic.");
        }

//        $temp = TopikTemp::where('areakeilmuan', 'like', '%' . $request->input('knowledge-field') . '%')->get();
//        $name = AreaKeilmuan::select('kode')->where('areakeilmuan',$request->input('knowledge-field') )->first();
        $topic = new TopikTemp;
//        $count = count($temp) + 1;
//        $topic->kodetopik = $name["kode"]."-".sprintf('%03d', $count);
        if ($request->input('pembimbing1') !== null && $request->input('pembimbing1') != 'lalala') {
            $topic->pembimbing1 = $request->input('pembimbing1');
        } else {
            $topic->pembimbing1 = -1;
        }
        if ($request->input('pembimbing2') !== null && $request->input('pembimbing2') != 'lalala') {
            $topic->pembimbing2 = $request->input('pembimbing2');
        } else {
            $topic->pembimbing2 = -1;
        }
        $arraycheckbox = $request->input('checkbox_name');
        $area = "";
        $lengtharray = count($arraycheckbox);
        $in = 0;
        if ($lengtharray!==0){
            foreach ($arraycheckbox as $check){
                $in++;
                $area .= $check;
                if ($in !== $lengtharray){
                    $area .= "; ";
                }
            }
        }
        if ($request->input('externalkeilmuan') !== null && $request->input('externalkeilmuan') !== "") {
            if ($area !== ""){
                $area .= "; ";
            }
            $area .= $request->input('externalkeilmuan');
        }
        $topic->areakeilmuan = $area;

        if ($request->input('specific-knowledge-field') !== null) {
            $topicSpecKnowledgeField = $request->input('specific-knowledge-field');
            $topic->areakeilmuanspesifik = $topicSpecKnowledgeField;
        } else {
            $topic->areakeilmuanspesifik = "";
        }
        $topic->topik = $request->input('topik');

        $topic->deskripsi = $request->input('description');
        if ($request->input('other-topic') !== null) {
            $topic->bidanglain = $request->input('other-topic');
        } else {
            $topic->bidanglain = "";
        }
        $topic->laboratorium = $request->input('exp-lab');
        $topic->keterangan = $request->input('project');
        $topic->quota = $request->input('quota');
        $topic->tahun = $request->input('date');
        $topic->semester = $request->input('semester');
        $topic->status = 0;
        $topic->idDosen = Auth::user()->id;
        $topic->save();
        $subtopic = new SubTopik;


        if ($request->input('subtopic') !== null && $request->input('subtopic') !== "") {
            $subtopic->subtopik = $request->input('subtopic');
            $subtopic->id_topik = $topic->id;
            $subtopic->save();
            for ($x = 0; $x <= 40; $x++) {
                if ($request->input('subtopic'.$x) !== null && $request->input('subtopic'.$x) !== "") {
                    $subtopic = new SubTopik;
                    $subtopic->subtopik = $request->input('subtopic'.$x);
                    $subtopic->id_topik = $topic->id;
                    $subtopic->save();
                }
            }
        } else {
            $subtopic->subtopik = "";
        }
        if ($request->input('externalkeilmuan') !== null && $request->input('externalkeilmuan') !== "") {
            $words = explode(" ", $request->input('externalkeilmuan'));
            $acronym = "";
            $max = 0;
            foreach ($words as $w) {
                $templength = strlen($w);
                if ($max < $templength){
                    $max = $templength;
                }
                $acronym .= $w[0];
            }
            $iter = 1;
            while (AreaKeilmuan::where('kode','=',$acronym )->exists() && $iter < $max){
                $acronym = "";
                foreach ($words as $w) {
                    $templength = strlen($w);
                    for ($x = 0; $x < $iter; $x++) {
                        if ($x < $templength) {
                            $acronym .= $w[$x];
                        }
                    }
                }
                $iter++;
            }
            $area = new AreaKeilmuan;
            $area->kode = $acronym;
            $area->areakeilmuan = $request->input('externalkeilmuan');
            $area->save();
        }
//        return redirect('/topik');
//        $this->allTopik("Data berhasil Anda tambahkan!");
        $dosenID = Auth::user()->id;
        $listOfTopics = TopikTemp::where('idDosen', $dosenID)->get();
        $listOfSub = SubTopik::all();
        $sub = [];
        $so = 0;
        $subtopic = "";

        $array = array('id_topik'=>1,'subtopik'=>"ball");
        $sub['11'] = $array;
        foreach ($listOfTopics as $topic){
            $subtopic = "";
            $pass = 0;
            $y = 1;
            foreach ($listOfSub as $sub1) {
                if ($sub1->id_topik === $topic->id){
                    if ($y !== 1) {
                        $subtopic .= "; ";
                    }
                    $subtopic .= $y;
                    $subtopic .= ". ";
                    $subtopic .= $sub1->subtopik;
                    $pass = 1;
                    $y++;
                }
            }
            if ($pass === 0){
                $subtopic = " ";
            }

            $so++;
            $array = array('id_topik'=>$topic->id,'subtopik'=>$subtopic);
            $sub[strval($so)] = $array;

        }
        $obj =  $this->convertToObject($sub);

        return view('topik.all_topik',  [
            'listOfTopics' => $listOfTopics,
            'message' => "Data berhasil Anda tambahkan!",
            'listOfSub' =>  $obj,
            'subtop' => $obj,
            'timta' => 'dosen',
            'me' => Auth::user()->isTimTA()
        ]);
    }

    public function allTopik() {
        if (!Auth::user()->isDosen()){
            return redirect('/home');
        }
        $dosenID = Auth::user()->id;
        $listOfTopics = TopikTemp::where('idDosen', $dosenID)->get();
        $listOfSub = SubTopik::all();
        $sub = [];
        $so = 0;
        $subtopic = "";

        $array = array('id_topik'=>-1,'subtopik'=>"ball");
        $sub['11'] = $array;
        foreach ($listOfTopics as $topic){
            $subtopic = "";
            $pass = 0;
            $y = 1;
            foreach ($listOfSub as $sub1) {
                if ($sub1->id_topik === $topic->id){
                    if ($y !== 1) {
                        $subtopic .= "; ";
                    }
                    $subtopic .= $y;
                    $subtopic .= ". ";
                    $subtopic .= $sub1->subtopik;
                    $pass = 1;
                    $y++;
                }
            }
            if ($pass === 0){
                $subtopic = " ";
            }

            $so++;
            $array = array('id_topik'=>$topic->id,'subtopik'=>$subtopic);
            $sub[strval($so)] = $array;

        }
        $obj =  $this->convertToObject($sub);
        return view('topik.all_topik',  [
            'listOfTopics' => $listOfTopics,
            'listOfSub' =>  $obj,
            'subtop' => $obj,
            'timta' => 'dosen',
            'me' => Auth::user()->isTimTA()
        ]);
    }

    public function allTopikNormal() {
        if (!Auth::user()->isDosen()){
            return redirect('/home');
        }
        $listOfTopics = TopikTemp::where('status', 3)->get();
        $listOfSub = SubTopik::all();
        $sub = [];
        $so = 0;
        $subtopic = "";

        $array = array('id_topik'=>-1,'subtopik'=>"ball");
        $sub['11'] = $array;
        foreach ($listOfTopics as $topic){
            $subtopic = "";
            $pass = 0;
            $y = 1;
            foreach ($listOfSub as $sub1) {
                if ($sub1->id_topik === $topic->id){
                    if ($y !== 1) {
                        $subtopic .= "; ";
                    }
                    $subtopic .= $y;
                    $subtopic .= ". ";
                    $subtopic .= $sub1->subtopik;
                    $pass = 1;
                    $y++;
                }
            }
            if ($pass === 0){
                $subtopic = " ";
            }

            $so++;
            $array = array('id_topik'=>$topic->id,'subtopik'=>$subtopic);
            $sub[strval($so)] = $array;

        }
        $obj =  $this->convertToObject($sub);
//        $listOfTopics = TopikTemp::all();
        return view('topik.all_topik',  [
            'listOfTopics' => $listOfTopics,
            'listOfSub' =>  $obj,
            'subtop' => $obj,
            'timta' => 'dosenall',
            'me' => Auth::user()->isTimTA()
        ]);
    }

    public function allTopikDosen() {
        if (!Auth::user()->isTimTA()){
            return redirect('/home');
        }
        $listOfTopics = TopikTemp::where('status', 1)->orWhere('status',3)->get();
        $listOfSub = SubTopik::all();
        $sub = [];
        $so = 0;
        $subtopic = "";

        $array = array('id_topik'=>-1,'subtopik'=>"ball");
        $sub['11'] = $array;
        foreach ($listOfTopics as $topic){
            $subtopic = "";
            $pass = 0;
            $y = 1;
            foreach ($listOfSub as $sub1) {
                if ($sub1->id_topik === $topic->id){
                    if ($y !== 1) {
                        $subtopic .= "; ";
                    }
                    $subtopic .= $y;
                    $subtopic .= ". ";
                    $subtopic .= $sub1->subtopik;
                    $pass = 1;
                    $y++;
                }
            }
            if ($pass === 0){
                $subtopic = " ";
            }

            $so++;
            $array = array('id_topik'=>$topic->id,'subtopik'=>$subtopic);
            $sub[strval($so)] = $array;

        }
        $obj =  $this->convertToObject($sub);
//        $listOfTopics = TopikTemp::all();
        return view('topik.all_topik',  [
            'listOfTopics' => $listOfTopics,
            'listOfSub' =>  $obj,
            'subtop' => $obj,
            'timta' => 'timta',
            'me' => Auth::user()->isTimTA()
        ]);
    }

    public function readTopic($id)
    {
        $topicID = $id;
        try
        {

            $topic = TopikTemp::findOrFail($topicID);
        }
// catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
            $this->allTopik();
        }
        $topic = TopikTemp::find($topicID);
        $listOfKodeKeilmuan = AreaKeilmuan::all();
        $listOfDosen = DosenTemp::all();
        if ($topic["idDosen"] !== Auth::user()->id || !($topic["status"]===1 && Auth::user()->isTimTA())){
            $this->allTopik();
        }
        $listOfSub = SubTopik::where('id_topik','=',$topic->id)->get();
        $listOfKeilmuan = explode("; ",$topic->areakeilmuan);
        $inputDosen = DosenTemp::where('user_id','=',$topic->idDosen)->first();
        $nama = $inputDosen["user_id"];
        $namaInput = $inputDosen["nama"];
        return view('topik.read', [
            'topic' => $topic,
            'listOfKodeKeilmuan' => $listOfKodeKeilmuan,
            'listOfSub' => $listOfSub,
            'listOfKeilmuan' => $listOfKeilmuan,
            'listOfDosen' => $listOfDosen,
            'namaDosen' => $nama,
            'namaDosenInput' => $inputDosen,
            'me' => Auth::user()->isTimTA()
        ]);
    }

    public function processEditTopic(Request $request)
    {

        $topicID = $request->input('id');
        $listOfKodeKeilmuan = AreaKeilmuan::all();
        $listOfDosen = DosenTemp::orderBy('nip', 'ASC')->get();
        $topic = TopikTemp::find($topicID);
        if ($topic["status"]!==0 && $topic["idDosen"] !== Auth::user()->id){
            $this->allTopik();
        }
        $listOfSub = SubTopik::where('id_topik','=',$topic->id)->get();
        $listOfKeilmuan = explode("; ",$topic->areakeilmuan);

        return view('topik.edit', [
            'message' =>'edit',
            'topic' => $topic,
            'listOfKodeKeilmuan' => $listOfKodeKeilmuan,
            'listOfSub' => $listOfSub,
            'listOfKeilmuan' => $listOfKeilmuan,
            'listOfDosen' => $listOfDosen,
            'me' => Auth::user()->isTimTA()
        ]);
    }

    public function copyTopic(Request $request)
    {
        $topicID = $request->input('id');
        $listOfKodeKeilmuan = AreaKeilmuan::all();
        $listOfDosen = DosenTemp::all();
        $topic = TopikTemp::find($topicID);
        if ($topic["idDosen"] !== Auth::user()->id){
            $this->allTopik();
        }
        $listOfSub = SubTopik::where('id_topik','=',$topic->id)->get();
        $listOfKeilmuan = explode("; ",$topic->areakeilmuan);
        return view('topik.edit', [
            'message' => 'copy',
            'topic' => $topic,
            'listOfKodeKeilmuan' => $listOfKodeKeilmuan,
            'listOfSub' => $listOfSub,
            'listOfKeilmuan' => $listOfKeilmuan,
            'listOfDosen' => $listOfDosen,
            'me' => Auth::user()->isTimTA()
        ]);
    }

    public function editTopic(Request $request)
    {
        $request->validate([
            'topik' => 'required',
            'description' => 'required',
            'exp-lab' => 'required',
            'project' => 'required',
            'quota' => 'required|integer',
        ]);
        $topicID = $request->input('id');

//        $temp = TopikTemp::where('areakeilmuan', 'like', '%' . $request->input('knowledge-field') . '%')->get();
//        $name = AreaKeilmuan::select('kode')->where('areakeilmuan',$request->input('knowledge-field') )->first();

        if (!Auth::user()->isDosen()){
            return redirect('/home');
        }
        //cek dosennya cek tahunnya
        $tes = TopikTemp::where('topik','=',$request->input('topik'))->where('idDosen','=',Auth::user()->id )->where('tahun','=',$request->input('date'))->where('semester','=',$request->input('semester'))->first();
        if (count($tes)>0){
            if ($tes->id != $topicID){
                $topicID = $request->input('id');
                $listOfKodeKeilmuan = AreaKeilmuan::all();
                $listOfDosen = DosenTemp::orderBy('nip', 'ASC')->get();
                $topic = TopikTemp::find($topicID);
                if ($topic["status"]!==0 && $topic["idDosen"] !== Auth::user()->id){
                    $this->allTopik();
                }
                $listOfSub = SubTopik::where('id_topik','=',$topic->id)->get();
                $listOfKeilmuan = explode("; ",$topic->areakeilmuan);

                return view('topik.edit', [
                    'message' =>'edit',
                    'topic' => $topic,
                    'listOfKodeKeilmuan' => $listOfKodeKeilmuan,
                    'listOfSub' => $listOfSub,
                    'listOfKeilmuan' => $listOfKeilmuan,
                    'listOfDosen' => $listOfDosen,
                    'me' => Auth::user()->isTimTA()
                ])->withErrors("You already have that topic, please change to another topic.".$tes->id.'aaa'.$topicID);
            }
        }

//        $count = count($temp) + 1;
//        $topic->kodetopik = $name["kode"]."-".sprintf('%03d', $count);
        $topic = TopikTemp::find($topicID);
        if ($request->input('pembimbing1') !== null) {
            $topic->pembimbing1 = $request->input('pembimbing1');
        } else {
            $topic->pembimbing1 = -1;
        }
        if ($request->input('pembimbing2') !== null) {
            $topic->pembimbing2 = $request->input('pembimbing2');
        } else {
            $topic->pembimbing2 = -1;
        }
        $arraycheckbox = $request->input('checkbox_name');
        $area = "";
        $lengtharray = count($arraycheckbox);
        $in = 0;
        if ($lengtharray!==0){
            foreach ($arraycheckbox as $check){
                $in++;
                $area .= $check;
                if ($in !== $lengtharray){
                    $area .= "; ";
                }
            }
        }
        if ($request->input('externalkeilmuan') !== null && $request->input('externalkeilmuan') !== "") {
            if ($area !== ""){
                $area .= "; ";
            }
            $area .= $request->input('externalkeilmuan');
        }
        $topic->areakeilmuan = $area;
        if ($request->input('specific-knowledge-field') !== null) {
            $topicSpecKnowledgeField = $request->input('specific-knowledge-field');
            $topic->areakeilmuanspesifik = $topicSpecKnowledgeField;
        } else {
            $topic->areakeilmuanspesifik = "";
        }
        $topic->topik = $request->input('topik');
        $topic->deskripsi = $request->input('description');
        if ($request->input('other-topic') !== null) {
            $topic->bidanglain = $request->input('other-topic');
        } else {
            $topic->bidanglain = "";
        }
        $topic->laboratorium = $request->input('exp-lab');
        $topic->keterangan = $request->input('project');
        $topic->quota = $request->input('quota');
        $topic->tahun = $request->input('date');
        $topic->semester = $request->input('semester');
        $topic->status = 0;
        $topic->idDosen = Auth::user()->id;
        $topic->save();
//        return redirect('/topik');
//        $this->allTopik("Data berhasil Anda edit!");
//        $listOfTopics = TopikTemp::all();

        $subtopic = new SubTopik;


        if ($request->input('subtopic') !== null && $request->input('subtopic') !== "") {
            $subtopic->subtopik = $request->input('subtopic');
            $subtopic->id_topik = $topic->id;
            $subtopic->save();
            for ($x = 0; $x <= 40; $x++) {
                if ($request->input('subtopic'.$x) !== null && $request->input('subtopic'.$x) !== "") {
                    $subtopic = new SubTopik;
                    $subtopic->subtopik = $request->input('subtopic'.$x);
                    $subtopic->id_topik = $topic->id;
                    $subtopic->save();
                }
            }
        } else {
            $subtopic->subtopik = "";
        }
        if ($request->input('externalkeilmuan') !== null && $request->input('externalkeilmuan') !== "") {
            $words = explode(" ", $request->input('externalkeilmuan'));
            $acronym = "";
            $max = 0;
            foreach ($words as $w) {
                $templength = strlen($w);
                if ($max < $templength){
                    $max = $templength;
                }
                $acronym .= $w[0];
            }
            $iter = 1;
            while (AreaKeilmuan::where('kode','=',$acronym )->exists() && $iter < $max){
                $acronym = "";
                foreach ($words as $w) {
                    $templength = strlen($w);
                    for ($x = 0; $x < $iter; $x++) {
                        if ($x < $templength) {
                            $acronym .= $w[$x];
                        }
                    }
                }
                $iter++;
            }
            $area = new AreaKeilmuan;
            $area->kode = $acronym;
            $area->areakeilmuan = $request->input('externalkeilmuan');
            $area->save();
        }

        $dosenID = Auth::user()->id;
        $listOfTopics = TopikTemp::where('idDosen', $dosenID)->get();

        $listOfSub = SubTopik::all();
        $sub = [];
        $so = 0;
        $subtopic = "";

        $array = array('id_topik'=>1,'subtopik'=>"ball");
        $sub['11'] = $array;
        foreach ($listOfTopics as $topic){
            $subtopic = "";
            $pass = 0;
            $y = 1;
            foreach ($listOfSub as $sub1) {
                if ($sub1->id_topik === $topic->id){
                    if ($y !== 1) {
                        $subtopic .= "; ";
                    }
                    $subtopic .= $y;
                    $subtopic .= ". ";
                    $subtopic .= $sub1->subtopik;
                    $pass = 1;
                    $y++;
                }
            }
            if ($pass === 0){
                $subtopic = " ";
            }

            $so++;
            $array = array('id_topik'=>$topic->id,'subtopik'=>$subtopic);
            $sub[strval($so)] = $array;

        }
        $obj =  $this->convertToObject($sub);

        return view('topik.all_topik',  [
            'listOfTopics' => $listOfTopics,
            'listOfSub' =>  $obj,
            'subtop' => $obj,
            'message' => "Data berhasil Anda Edit!",
            'timta' => 'dosen',
            'me' => Auth::user()->isTimTA()
        ]);
    }

    public function deleteTopic(Request $request)
    {

        $topicID = $request->input('id');
        $topic = TopikTemp::find($topicID);
        if (($topic["status"]!==0 || $topic["status"]!==2) && $topic["idDosen"] !== Auth::user()->id){
            $this->allTopik();
        }
        $topic->delete();
        return redirect('/dosen/ta1/alltopik');
    }

    public function finalTopic(Request $request)
    {

        $topicID = $request->input('id');
        $topic = TopikTemp::find($topicID);
        if ($topic["status"]!==1 && !Auth::user()->isTimTA()){
            $this->allTopik();
        }
        $topic->status = 3;
        $topic->save();
        return redirect('/dosen/ta1/alltopikdosen');
    }
    public function postTopic(Request $request)
    {

        $topicID = $request->input('id');
        $topic = TopikTemp::find($topicID);
        if ($topic["status"]!==1 && !Auth::user()->isTimTA()){
            $this->allTopik();
        }

        $topic->status = 2;
        $topic->save();
        return redirect('/dosen/ta1/alltopikdosen');
    }
    public function increaseTopicQuota(Request $request)
    {
        $topicID = $request->input('id');
        $topic = TopikTemp::find($topicID);
        if (($topic["status"]!==0 || $topic["status"]!==2) && $topic["idDosen"] !== Auth::user()->id){
            $this->allTopik();
        }
        $quota = $topic->quota;
        $quota++;
        $topic->quota = $quota;
        $topic->save();
        return redirect('/dosen/ta1/alltopik');
    }

    public function submitTopic(Request $request)
    {
        if (!Auth::user()->isDosen()){
            return redirect('/home');
        }
        $topicID = $request->input('id');
        $topic = TopikTemp::find($topicID);
        $topic->status = 1;
        $topic->save();

        return redirect('/dosen/ta1/alltopik');
    }

    public function decreaseTopicQuota(Request $request)
    {
        $topicID = $request->input('id');
        $topic = TopikTemp::find($topicID);
        if (($topic["status"]!==0 || $topic["status"]!==2) && $topic["idDosen"] !== Auth::user()->id){
            $this->allTopik();
        }
        $quota = $topic->quota;
        $quota--;
        $topic->quota = $quota;
        $topic->save();
        return redirect('/dosen/ta1/alltopik');
    }

    public function generateExcel() {
        if (!Auth::user()->isTimTA()){
            return redirect('/home');
        }
        $listOfTopics = TopikTemp::where('status', 3)->orderBy('areakeilmuan', 'desc')->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $topicsArray = [];

        //subtopik belum
        // Define the Excel spreadsheet headers
        $topicsArray[] = [
            'Area Keilmuan Utama',
            'Area Keilmuan Spesifik',
            'Tema/Topik', 'Deskripsi Umum', 'Sub-Topik', 'Jumlah Mahasiswa yang Dibutuhkan',
            'Calon Pembimbing I', 'Calon Pembimbing II',
            'Kaitan dengan Bidang Ilmu Lain', 'Laboratorium Keahlian',
            'Keterangan'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($listOfTopics as $topic) {
            $temp = [];
            $temp[] = $topic["areakeilmuan"];
            $temp[] = $topic["areakeilmuanspesifik"];
            $temp[] = $topic["topik"];
            $temp[] = $topic["deskripsi"];
            $subtopiktemp = SubTopik::where('id_topik', $topic["id"])->get();
            if ($subtopiktemp) {
                $subtopic = "";
                $y = 1;
                foreach ($subtopiktemp as $sub1) {
                    if ($sub1->id_topik === $topic->id){
                        if ($y !== 1) {
                            $subtopic .= "; ";
                        }
                        $subtopic .= $y;
                        $subtopic .= ". ";
                        $subtopic .= $sub1->subtopik;
                        $y++;
                    }
                }
                $temp[] = $subtopic;
            } else {
                $temp[] = "";
            }
            $temp[] = $topic["quota"];
            if ($topic["pembimbing1"]!==-1){
                $dosentemp = DosenTemp::where('user_id',$topic["pembimbing1"])->first();
                $temp[] = $dosentemp["nama"];
            } else {
                $temp[] = "";
            }
            if ($topic["pembimbing2"]!==-1){
                $dosentemp = DosenTemp::where('user_id',$topic["pembimbing2"])->first();
                $temp[] = $dosentemp["nama"];
            } else {
                $temp[] = "";
            }
            $temp[] = $topic["bidanglain"];
            $temp[] = $topic["laboratorium"];
            $temp[] = $topic["keterangan"];

            $topicsArray[] = $temp;

        }

        $listOfCode = AreaKeilmuan::all();
        $codesArray = [];
        $codesArray[] = ['Kode',
            'Area Keilmuan'];
        foreach ($listOfCode as $code) {
            $codesArray[] = $code->toArray();
        }
        $listOfLectures = DB::table('topiktemp')
            ->select('dosentemp.inisial', DB::raw('COUNT(topiktemp.pembimbing1) as jumlah'))
            ->where('topiktemp.status','=',3)
            ->join('dosentemp', 'dosentemp.nama', '=', 'topiktemp.pembimbing1')
            ->groupBy('dosentemp.inisial')
            ->get();
//        $listOfLectures = DB::table('topiktemp')
//            ->join('dosentemp', 'dosentemp.nama', '=', 'topiktemp.pembimbing1')
//            ->groupBy('dosentemp.inisial')
//            ->select('dosentemp.inisial as inisial', DB::raw("count(dosentemp.inisial as count"))
//            ->get();
        $lecturesArray = [];
        $lecturesArray[] = ['Kode',
            'Jumlah Topik'];
        foreach ($listOfLectures as $code) {
            $temp = [];
            $temp[] = $code->inisial;

            $temp[] = $code->jumlah;
            $lecturesArray[] = $temp;
        }
//        $lecturesArray[] = (array)$listOfLectures;
//        foreach ($listOfLectures as $lecture) {
//            $lecturesArray[] = $lecture;
//        }


        // Generate and return the spreadsheet
        $this->excel->create('Daftar Tawaran Topik TA Prodi S1 IF', function($excel) use ($topicsArray,$lecturesArray, $codesArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Daftar Tawaran Topik TA Prodi S1 IF');
            $excel->setCreator('Tim TA')->setCompany('ITB');
            $excel->setDescription('Daftar tawaran topik');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('Topik', function($sheet) use ($topicsArray) {
                $sheet->fromArray($topicsArray, null, 'A1', false, false);
                $sheet->row(1, function($row) { $row->setFontWeight('bold'); });
            });
            // Build the spreadsheet, passing in the payments array
            $excel->sheet('Daftar Dosen', function($sheet) use ($lecturesArray) {
                $sheet->fromArray($lecturesArray, null, 'A1', false, false);
                $sheet->row(1, function($row) { $row->setFontWeight('bold'); });
            });
            // Build the spreadsheet, passing in the payments array
            $excel->sheet('Kode Keilmuan', function($sheet) use ($codesArray) {
                $sheet->fromArray($codesArray, null, 'A1', false, false);
                $sheet->row(1, function($row) { $row->setFontWeight('bold'); });
            });

        })->download('xlsx');
        $listOfTopics = TopikTemp::where('status', 1)->get();

//        $listOfTopics = TopikTemp::all();
        $this->allTopikDosen();
        return true;
//        return view('topik.all_topik',  [
//            'listOfTopics' => $listOfTopics,
//            'timta' => 'timta'
//        ]);
    }
}
