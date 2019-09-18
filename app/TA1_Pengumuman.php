<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA1_Pengumuman extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "ta1_pengumuman";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = "id";

    public function timTA() {
        return $this->belongsTo('App\Dosen','dosen_kelas_id','user_id');
    }
}
