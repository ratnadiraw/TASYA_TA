<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA2_BeritaAcaraSidang extends Model
{
    /**
     * Nama tabel pada database.
     *
     * @var string
     */
    protected $table = "ta2_berita_acara_sidang";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "bas_id";
}
