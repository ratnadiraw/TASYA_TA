<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA2_Sidang extends Model
{
	/**
	 * Nama tabel pada database.
	 *
	 * @var string
	 */
	protected $table = "ta2_sidang";
	
	/**
	 * Atribut primary key pada tabel.
	 *
	 * @var string
	 */
	protected $primaryKey = "sidang_id";
	
	
	/**
	 * Mendapatkan objek TA2 dari sidang.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function ta2_TA()
	{
		return $this->belongsTo('App\TA2_TA', 'ta_id', 'ta_id');
	}

	/**
	 * Mendapatkan semua dosen penguji.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function penguji()
	{
		return $this->belongsToMany('App\Dosen', 'ta2_dosen_sidang', 'sidang_id', 'dosen_id');
	}
}
