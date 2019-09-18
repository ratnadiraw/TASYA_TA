<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Usulan_Topik;

class TempGenerate extends Model
{
    /**
     * Nama tabel pada database.
     *
     * @var string
     */
    protected $table = "tempgenerate";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "id";



    /**
     * Mendapatkan dosen pembimbing topik.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

}
