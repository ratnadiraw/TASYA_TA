<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosenTemp extends Model
{
    protected $table = "dosentemp";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "user_id";
}
