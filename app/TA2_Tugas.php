<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA2_Tugas extends Model
{
    /**
     * Nama tabel pada database.
     *
     * @var string
     */
    protected $table = "ta2_tugas";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "tugas_id";


    /**
     * Mendapatkan kelas dimana tugas ini diberikan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ta2_Kelas()
    {
        return $this->belongsToMany('App\TA2_Kelas', 'ta2_tugas_kelas', 'tugas_id', 'kelas_id');
    }

    /**
     * Mendapatkan semua mahasiswa yang sudah mengerjakan tugas ini.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mahasiswa()
    {
        return $this->belongsToMany('App\Mahasiswa','ta2_tugas_mahasiswa', 'tugas_id', 'mahasiswa_id');
    }
}
