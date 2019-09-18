<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA1_Surat_Seminar extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "ta1_surat_seminar";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = "id";

    public function seminar() {
        return $this->belongsTo('App\TA1_Seminar','seminar_id','id');
    }
    public function penguji1() {
        return $this->belongsTo('App\Dosen','penguji1_id','user_id');
    }
    public function penguji2() {
        return $this->belongsTo('App\Dosen','penguji2_id','user_id');
    }
}
