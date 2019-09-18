<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use MaddHatter\LaravelFullcalendar\Calendar;
use App\TA1_Pengumuman;
use Illuminate\Support\Facades\DB;

class PengumumanTA2Composer
{
    public $listOfPengumumanTA2;

    public function __construct()
    {
        $this->listOfPengumumanTA2 = DB::table('ta2_pengumuman')
            ->get();

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('listOfPengumumanTA2',$this->listOfPengumumanTA2);
    }
}