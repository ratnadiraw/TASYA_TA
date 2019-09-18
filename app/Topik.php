<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Usulan_Topik;

class Topik extends Model
{
    /**
     * Nama tabel pada database.
     *
     * @var string
     */
    protected $table = "topik";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "topik_id";


    /**
     * Mendapatkan dosen pembimbing topik.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dosen()
    {
        return $this->belongsTo('App\Dosen', 'pembimbing1_id', 'user_id');
    }

    public function usulanTopik() {
        return $this->hasOne('App\Usulan_Topik','usulan_id','id');
    }

    public function TA1_Tugas_Akhir() {
        return $this->hasMany('App\TA1_Tugas_Akhir','topik_id','topik_id');
    }

    public function ongoing_TA1_Tugas_Akhir() {
        return $this->hasMany('App\TA1_Tugas_Akhir','topik_id','topik_id')->where('status_checkout','=','0');
    }

    public function mahasiswaBimbinganPilihan() {
        return $this->hasMany('App\Mahasiswa_Bimbingan_Pilihan','topik_id','topik_id');
    }

    public static function getTopicFromID($id) {
        $topic = DB::table('topik')->where('topik_id',$id);
        return $topic;
    }
}
