<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa_Bimbingan_Pilihan extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "mahasiswa_bimbingan_pilihan";

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
    public function topik()
    {
        return $this->belongsTo('App\Topik', 'topik_id', 'topik_id');
    }


    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa','mahasiswa_id','user_id');
    }
}
