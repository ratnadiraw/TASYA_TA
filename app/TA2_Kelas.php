<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA2_Kelas extends Model
{
    /**
     * Nama tabel pada database.
     *
     * @var string
     */
    protected $table = "ta2_kelas";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "kelas_id";


    /**
     * Mendapatkan dosen pengajar di kelas ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dosen()
    {
        return $this->belongsTo('App\Dosen', 'dosen_id', 'user_id');
    }

    /**
     * Mendapatkan semua mahasiswa yang terdaftar di kelas ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mahasiswa()
    {
        return $this->belongsToMany('App\Mahasiswa', 'ta2_mahasiswa_kelas', 'kelas_id', 'mahasiswa_id');
    }

    /**
     * Mendapatkan semua tugas kelas TA2 yang diberikan di kelas ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ta2_Tugas()
    {
        return $this->belongsToMany('App\TA2_Tugas', 'ta2_tugas_kelas', 'kelas_id', 'tugas_id');
    }
}
