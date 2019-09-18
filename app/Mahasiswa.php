<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
	/**
	 * Nama tabel pada database.
	 *
	 * @var string
	 */
	protected $table = "mahasiswa";
	
	/**
	 * Atribut primary key pada tabel.
	 *
	 * @var string
	 */
	protected $primaryKey = "user_id";
    public $incrementing = false;
	
	
	/**
	 * Mendapatkan semua TA2 yang pernah diambil oleh mahasiswa.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function ta2_TA()
	{
		return $this->hasMany('App\TA2_TA', 'mahasiswa_id', 'user_id');
	}

    /**
     * Mendapatkan semua kelas TA2 yang pernah diambil oleh mahasiswa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function ta2_Kelas()
    {
        return $this->belongsToMany('App\TA2_Kelas', 'ta2_mahasiswa_kelas', 'mahasiswa_id', 'kelas_id');
    }

    /**
     * Mendapatkan semua tugas TA2 yang sudah dikumpulkan mahasiswa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ta2_Tugas()
    {
        return $this->belongsToMany('App\TA2_Tugas', 'ta2_mahasiswa_tugas', 'mahasiswa_id', 'tugas_id');
    }

    public function ta1_Tugas_Akhir() {
        return $this->hasMany('App\TA1_Tugas_Akhir','mahasiswa_id','user_id');
    }

    public function usulanTopik() {
        return $this->hasMany('App\Usulan_Topik','mahasiswa_id','user_id');
    }

    public function mahasiswaBimbinganPilihan() {
        return $this->hasMany('App\Mahasiswa_Bimbingan_Pilihan','mahasiswa_id','user_id');
    }
}
