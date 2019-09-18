<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA1_Seminar extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "ta1_seminar";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = "id";

    public function TA1_Tugas_Akhir() {
        return $this->belongsTo('App\TA1_Tugas_Akhir','ta_id','id');
    }

    public function suratSeminar() {
        return $this->hasOne('App\TA1_Surat_Seminar','seminar_id','id');
    }
}
