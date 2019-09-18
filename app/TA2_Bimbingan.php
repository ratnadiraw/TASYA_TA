<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA2_Bimbingan extends Model
{
	/**
	 * Nama tabel pada database.
	 *
	 * @var string
	 */
	protected $table = "ta2_bimbingan";
	
	/**
	 * Atribut primary key pada tabel.
	 *
	 * @var string
	 */
	protected $primaryKey = "bimbingan_id";
	
	
	/**
	 * Mendapatkan objek TA2 dari bimbingan.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function ta2_TA()
	{
		return $this->belongsTo('App\TA2_TA', 'ta_id', 'ta_id');
	}
	
	/**
	 * Mendapatkan dosen pembimbing.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function dosen()
	{
		return $this->belongsTo('App\Dosen', 'dosen_id', 'user_id');
	}

  public function dosen2(){
    return $this->belongsTo('App\Dosen', 'dosen_id_2', 'user_id');
  }
}
