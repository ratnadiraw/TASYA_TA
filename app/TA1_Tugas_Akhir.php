<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Topik;

class TA1_Tugas_Akhir extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "ta1_tugas_akhir";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = "id";


    public function mahasiswa() {
        return $this->belongsTo('App\Mahasiswa','mahasiswa_id','user_id');
    }
    public function pembimbing() {
        return $this->belongsToMany('App\Dosen', 'ta1_dosen_ta', 'ta_id', 'dosen_id');
    }
     public function bimbingan() {
        return $this->hasMany('App\TA1_Bimbingan','ta_id','id');
     }
     public function progressSummary() {
        return $this->hasOne('App\TA1_ProgressSummary','ta_id','id');
     }
     public function topik() {
        return $this->belongsTo('App\Topik','topik_id','topik_id');
     }
     public function seminar() {
        return $this->hasOne('App\TA1_Seminar','ta_id','id');
     }
     public function suratTugas() {
        return $this->hasOne('App\TA1_Surat_Tugas','ta_id','id');
     }
     public function tahunAjaran() {
        return $this->hasOne('App\TahunAjaran', 'id', 'tahun_ajaran_id');
     }
     public function saveTopicChoices($taID,$firstPrio,$secondPrio,$thirdPrio) {
         DB::table('pilihan_topik')
             ->where('ta_id', $taID)
             ->update(['prioritas1' => $firstPrio, 'prioritas2' => $secondPrio, 'prioritas3' => $thirdPrio]);
     }
     public function getTopicChoices($taID) {
        $topicsChoice = DB::table('pilihan_topik')->where('ta_id',$taID)->first();
        if ($topicsChoice !== null) {
            $firstTopic = TopikTemp::find($topicsChoice->prioritas1);
            $secondTopic = TopikTemp::find($topicsChoice->prioritas2);
            $thirdTopic = TopikTemp::find($topicsChoice->prioritas3);
            $topics = array($firstTopic,$secondTopic,$thirdTopic);
            return $topics;
        }
     }

}
