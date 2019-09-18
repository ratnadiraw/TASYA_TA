<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Usulan_Topik;

class TempSelect extends Model
{
    /**
     * Nama tabel pada database.
     *
     * @var string
     */
    protected $table = "topikselecttemp";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "id";


}
