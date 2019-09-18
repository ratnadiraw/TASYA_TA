<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA1_Tugas extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "ta1_tugas";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = "id";

    public function progressSummary() {
        return $this->belongsToMany('App\TA1_ProgressSummary', 'ta1_daftar_tugas', 'tugas_id', 'progress_id')->withPivot('status_pengumpulan');
    }
}
