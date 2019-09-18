<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaKeilmuan extends Model
{
    protected $table = "kodekeilmuantemp";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "id";
    protected $hidden = ['id'];
}
