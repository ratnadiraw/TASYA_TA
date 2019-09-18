<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA2_TA extends Model
{
	/**
	 * Nama tabel pada database.
	 *
	 * @var string
	 */
	protected $table = "ta2_ta";
	
	/**
	 * Atribut primary key pada tabel.
	 *
	 * @var string
	 */
	protected $primaryKey = "ta_id";
	
	
	/**
	 * Mendapatkan mahasiswa yang mengerjakan.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function mahasiswa()
	{
		return $this->belongsTo('App\Mahasiswa', 'mahasiswa_id', 'user_id' );
	}

	/**
	 * Mendapatkan topik.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function topik()
	{
		return $this->belongsTo('App\Topik', 'topik_id', 'topik_id');
	}
	
	
	/**
	 * Mendapatkan semua seminar.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ta2_Seminar()
	{
		return $this->hasMany('App\TA2_Seminar', 'ta_id', 'ta_id');
	}
	
	
	/**
	 * Mendapatkan semua sidang.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ta2_Sidang()
	{
		return $this->hasMany('App\TA2_Sidang', 'ta_id', 'ta_id');
	}

    /**
     * Mendapatkan semua dosen.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dosen()
    {
        return $this->belongsToMany('App\Dosen', 'ta2_dosen_ta', 'ta_id', 'dosen_id');
    }

    /**
     * Mendapatkan semua bimbingan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function ta2_Bimbingan()
     {
        return $this->hasMany('App\TA2_Bimbingan', 'ta_id', 'ta_id');
     }

}
