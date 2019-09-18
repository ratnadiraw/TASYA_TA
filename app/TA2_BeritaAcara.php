<?php
/**
 * Created by PhpStorm.
 * User: wennyyustalim
 * Date: 04/04/18
 * Time: 21.38
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class TA2_BeritaAcara extends Model
{
    /**
     * Nama tabel pada database.
     *
     * @var string
     */
    protected $table = "ta2_berita_acara_seminar";

    /**
     * Atribut primary key pada tabel.
     *
     * @var string
     */
    protected $primaryKey = "berita_acara_id";

    /**
     * Mendapatkan objek Seminar.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ta2_seminar()
    {
        return $this->belongsTo('App\TA2_Seminar', 'seminar_id', 'seminar_id');
    }
}