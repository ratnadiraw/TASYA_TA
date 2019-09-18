<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    /**
     * Nama tabel pada database.
     *
     * @var string
     */
    protected $table = "tahun_ajaran";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "id";

}
