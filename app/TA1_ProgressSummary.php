<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA1_ProgressSummary extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "ta1_progress_summary";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = "id";

    public function TA1_Tugas_Akhir() {
        return $this->belongsTo('App\TA1_Tugas_Akhir','ta_id','id');
    }

    public function tugas() {
        return $this->belongsToMany('App\TA1_Tugas', 'ta1_daftar_tugas', 'progress_id', 'tugas_id')->withPivot('status_pengumpulan');
    }
}
