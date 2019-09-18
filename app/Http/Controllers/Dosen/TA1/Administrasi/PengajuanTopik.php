<?php

namespace App\Http\Controllers\Dosen\TA1\Administrasi;

use App\Http\Controllers\Controller;
use App\Topik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanTopik extends Controller
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
        $dosenID = Auth::user()->id;
        $listOfTopics = Topik::where('pembimbing1_id', $dosenID)->whereNull('usulan_id')->get();
        return view('dosen.ta1.administrasi.pengajuan_topik',  [
            'listOfTopics' => $listOfTopics,
        ]);
    }

    public function addNewTopic(Request $request)
    {
        $request->validate([
            'topic' => 'required',
            'knowledge-field' => 'required',
            'exp-lab' => 'required',
            'quota' => 'required|integer',
        ]);
        $dosenID = Auth::user()->id;
        $topicName = $request->input('topic');
        $topicKnowledgeField = $request->input('knowledge-field');
        $topicExpLab = $request->input('exp-lab');
        $topicQuota = $request->input('quota');

        $topic = new Topik;
        $topic->nama = $topicName;
        $topic->area_keilmuan = $topicKnowledgeField;
        $topic->laboratorium_keahlian = $topicExpLab;
        if ($request->input('specific-knowledge-field') !== null) {
            $topicSpecKnowledgeField = $request->input('specific-knowledge-field');
            $topic->area_keilmuan_spesifik = $topicSpecKnowledgeField;
        }
        $topic->kuota = $topicQuota;
        $topic->pembimbing1_id = $dosenID;
        $topic->save();
        return redirect('/dosen/ta1/administrasi/pengajuan_topik');
    }

    public function openTopic(Request $request)
    {
        $topicID = $request->input('topic-id');

        $topic = Topik::find($topicID);
        $topic->status_buka = true;
        $topic->save();
        return redirect('/dosen/ta1/administrasi/pengajuan_topik');
    }

    public function closeTopic(Request $request)
    {

        $topicID = $request->input('topic-id');

        $topic = Topik::find($topicID);
        $listOfOngoingTA = $topic->ongoing_TA1_Tugas_Akhir;
        if (count($listOfOngoingTA) > 0) {
            $message = 'Gagal menutup topik. Pastikan tidak terdapat mahasiswa bimbingan dengan topik tersebut.';
            $dosenID = Auth::user()->id;
            $listOfTopics = Topik::where('pembimbing1_id', $dosenID)->whereNull('usulan_id')->get();
            return view('dosen.ta1.administrasi.pengajuan_topik',  ['listOfTopics' => $listOfTopics,'message' => $message]);
        } else {
            $topic->status_buka = false;
            $topic->save();
            return redirect('/dosen/ta1/administrasi/pengajuan_topik');
        }
    }

    public function deleteTopic(Request $request)
    {
        $topicID = $request->input('topic-id');
        $topic = Topik::find($topicID);
        $topic->delete();
        return redirect('/dosen/ta1/administrasi/pengajuan_topik');
    }

    public function increaseTopicQuota(Request $request)
    {
        $topicID = $request->input('topic-id');
        $topic = Topik::find($topicID);
        $quota = $topic->kuota;
        $quota++;
        $topic->kuota = $quota;
        $topic->save();
        return redirect('/dosen/ta1/administrasi/pengajuan_topik');
    }
    public function decreaseTopicQuota(Request $request)
    {
        $topicID = $request->input('topic-id');
        $topic = Topik::find($topicID);
        $quota = $topic->kuota;
        $quota--;
        $topic->kuota = $quota;
        $topic->save();
        return redirect('/dosen/ta1/administrasi/pengajuan_topik');
    }
}
