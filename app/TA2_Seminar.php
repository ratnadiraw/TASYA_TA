<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA2_Seminar extends Model
{
	/**
	 * Nama tabel pada database.
	 *
	 * @var string
	 */
	protected $table = "ta2_seminar";
	
	/**
	 * Atribut primary key pada tabel.
	 *
	 * @var string
	 */
	protected $primaryKey = "seminar_id";
	
	
	/**
	 * Mendapatkan objek TA2 dari seminar.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function ta2_TA()
	{
		return $this->belongsTo('App\TA2_TA', 'ta_id', 'ta_id');
	}
}
