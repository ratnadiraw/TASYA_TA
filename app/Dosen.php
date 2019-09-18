<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
	/**
	 * Nama tabel pada database.
	 *
	 * @var string
	 */
	protected $table = "dosen";
	
	/**
	 * Atribut primary key pada tabel.
	 *
	 * @var string
	 */
	protected $primaryKey = "user_id";
    public $incrementing = false;
	
	
	/**
	 * Mendapatkan semua topik yang dibimbing oleh dosen.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function topik()
	{
		return $this->hasMany('App\Topik', 'pembimbing1_id', 'user_id');
	}

    public function topik_buka()
    {
        return $this->hasMany('App\Topik', 'pembimbing1_id', 'user_id')->where('status_buka','=','1');
    }

	/**
	 * Mendapatkan semua sidang ta2 yang diuji oleh dosen.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function ta2_Sidang()
	{
		return $this->belongsToMany('App\TA2_Sidang', 'ta2_dosen_sidang', 'dosen_id', 'sidang_id');
	}

    /**
     * Mendapatkan semua kelas ta2 yang diajar oleh dosen.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ta2_Kelas()
    {
        return $this->hasMany('App\TA2_Kelas', 'dosen_id', 'user_id');
    }

    /**
     * Mendapatkan semua ta2 yang dibimbing oleh dosen.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function ta2_TA()
    {
        return $this->belongsToMany('App\TA2_TA', 'ta2_dosen_ta', 'dosen_id', 'ta_id');
    }

    public function TA1_Tugas_Akhir() {
        return $this->belongsToMany('App\TA1_Tugas_Akhir','ta1_dosen_ta','dosen_id','ta_id');
    }
}
