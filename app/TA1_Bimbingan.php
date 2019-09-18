<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA1_Bimbingan extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "ta1_bimbingan";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = "id";


    /**
     * Get TA1 object from bimbingan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function TA1_Tugas_Akhir()
    {
        return $this->belongsTo('App\TA1_Tugas_Akhir', 'ta_id', 'id');
    }

    /**
     * Get dosen who mentors the bimbingan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dosenPembimbing()
    {
        return $this->belongsTo('App\Dosen', 'pembimbing_id', 'user_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'mahasiswa_id', 'user_id');
    }

    public function MoM() {
        return $this->hasOne('App\TA1_MoM','bimbingan_id','id');
    }
}
