<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;
	
	/**
	 * Atribut user yang mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];
	
	
	/**
	 * Atribut user yang bersifat private.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];


    /**
     * Mengecek apakah user adalah mahasiswa.
     *
     * @return bool
     */
    public function isMahasiswa()
    {
	    $mahasiswa = Mahasiswa::find($this->id);
        return ($mahasiswa)? true : false;
    }

    /**
     * Mengecek apakah user adalah tata usaha.
     *
     * @return bool
     */
    public function isTU()
    {
	    $tu = TU::find($this->id);
        return ($tu)? true : false;
    }

    /**
     * Mengecek apakah user adalah dosen.
     *
     * @return bool
     */
    public function isDosen()
    {
	    $dosen = DosenTemp::where('user_id', $this->id)->first();
        return ($dosen)? true : false;
    }

    public function isTimTA() {
        $ta = TimTA::where('user_id', $this->id)->first();
        return ($ta) ? true : false;
    }
}
