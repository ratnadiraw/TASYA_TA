<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA1_MoM extends Model
{
    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = "ta1_mom";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = "id";


    public function bimbingan()
    {
        return $this->belongsTo('App\TA1_Bimbingan', 'bimbingan_id', 'id');
    }
}
