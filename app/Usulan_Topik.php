<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usulan_Topik extends Model
{
    /**
     * Nama tabel pada database.
     *
     * @var string
     */
    protected $table = "usulan_topik";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "id";


    /**
     * Mendapatkan dosen pembimbing topik.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getMahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'mahasiswa_id', 'user_id');
    }

    public function pembimbing1() {
        return $this->hasOne('App\Dosen','pembimbing1_id','user_id');
    }

    public function pembimbing2() {
        return $this->hasOne('App\Dosen','pembimbing2_id','user_id');
    }
}
