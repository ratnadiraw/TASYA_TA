<?php

namespace App\Http\Controllers\Mahasiswa\TA1\Administrasi;

use App\DosenTemp;
use App\Http\Controllers\Controller;
use App\Topik;
use App\TopikTemp;
use App\Usulan_Topik;
use App\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PemilihanTopik extends Controller
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
    public function index() {
        $mahasiswaID = Auth::user()->id;
        $mahasiswa = Mahasiswa::find($mahasiswaID);
        $currentTA = $mahasiswa->TA1_Tugas_Akhir()->latest()->first();
        if ($currentTA != null) {
            $topicChoice = $currentTA->getTopicChoices($currentTA->id);
        } else {
            $topicChoice = null;
        }
        $listOfDosen = DosenTemp::all();
        $listOfTopicProposalIDs = Usulan_Topik::where('mahasiswa_id', $mahasiswaID)->pluck('id');
        if (count($listOfTopicProposalIDs) > 0) {
            $listOfTopicProposalIDs = $listOfTopicProposalIDs->toArray();
            $listOfTopics = TopikTemp::where('status',3)->whereIn('usulan_id',$listOfTopicProposalIDs)->orWhere('usulan_id','=',null)->get();
        } else {
            $listOfTopics = TopikTemp::where('status',3)->whereNull('usulan_id')->get();
        }
        $listOfTopics = TopikTemp::all();
        return view('mahasiswa.ta1.administrasi.topik')->with(['topicChoice' => $topicChoice,'listOfDosen' => $listOfDosen,'listOfTopics' => $listOfTopics,'currentTA' => $currentTA]);
    }

    public function saveTopic(Request $request) {
        $firstPrio = null; $secondPrio = null; $thirdPrio = null;
        $firstPrioFlag = 0;
        $secondPrioFlag = 0;
        $thirdPrioFlag = 0;
        $topicIDs = $request->input('topic-id');
        $topicChoices = $request->input('topic-choices');
        foreach ($topicIDs as $topicID) {
            if (isset($topicChoices[$topicID]) && $topicChoices[$topicID] !== null) {
                echo 'ID Topik : '.$topicID.' '.$topicChoices[$topicID].'<br />';
                if ($topicChoices[$topicID] == 1 && $firstPrioFlag == 0) {
                    $firstPrio = $topicID;
                    $firstPrioFlag = 1;
                } else if ($topicChoices[$topicID] == 2 && $secondPrioFlag == 0) {
                    $secondPrio = $topicID;
                    $secondPrioFlag = 1;
                } else if ($topicChoices[$topicID] == 3 && $thirdPrioFlag == 0) {
                    $thirdPrio = $topicID;
                    $thirdPrioFlag = 1;
                } else {
                    Session::flash('message', "Tidak boleh memilih topik berbeda dengan prioritas sama");
                    return back();
                }
            }
        }

        $user_id = Auth::user()->id;
        if (!isset($firstPrio)) {
            Session::flash('message', "Prioritas 1 tidak boleh kosong");
            return back();
        } else {
            $mahasiswa = Mahasiswa::find($user_id);
            $currentTA = $mahasiswa->ta1_Tugas_Akhir()->latest()->first();
            $currentTA->saveTopicChoices($currentTA->id,$firstPrio,$secondPrio,$thirdPrio);
            return redirect('/mahasiswa/ta1/administrasi/topik');
        }
    }
    public function addNewTopicProposal(Request $request) {
        $request->validate([
            'topic' => 'required',
            'knowledge-field' => 'required',
            'exp-lab' => 'required',
            'pembimbing1' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $topicName = $request->input('topic');
        $topicKnowledgeField = $request->input('knowledge-field');
        $topicExpLab = $request->input('exp-lab');
        $pembimbing1_id = $request->input('pembimbing1');
        $topicProposal = new Usulan_Topik;
        $topicProposal->mahasiswa_id = $user_id;
        $topicProposal->save();

        $topic = new Topik;
        $topic->nama = $topicName;
        $topic->area_keilmuan = $topicKnowledgeField;
        $topic->laboratorium_keahlian = $topicExpLab;
        if ($request->input('specific-knowledge-field') !== null) {
            $topicSpecKnowledgeField = $request->input('specific-knowledge-field');
            $topic->area_keilmuan_spesifik = $topicSpecKnowledgeField;
        }
        $topic->kuota = 1;
        $topic->usulan_id = $topicProposal->id;
        $topic->pembimbing1_id = $pembimbing1_id;
        if ($request->input('pembimbing2') != null) {
            $pembimbing2_id = $request->input('pembimbing2');
            $topic->pembimbing2_id = $pembimbing2_id;
        }
        $topic->save();
        return redirect('/mahasiswa/ta1/administrasi/topik');
    }

}
