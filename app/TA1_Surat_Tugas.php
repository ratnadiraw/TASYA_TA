<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA1_Surat_Tugas extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "ta1_surat_tugas";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = "id";

    public function TA1_Tugas_Akhir() {
        return $this->belongsTo('App\TA1_Tugas_Akhir','ta_id','id');
    }
}
