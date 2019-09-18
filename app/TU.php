<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TU extends Model
{
	/**
	 * Nama tabel pada database.
	 *
	 * @var string
	 */
    protected $table = "tu";
	
	/**
	 * Atribut primary key pada tabel.
	 *
	 * @var string
	 */
	protected $primaryKey = "user_id";
    public $incrementing = false;
}
