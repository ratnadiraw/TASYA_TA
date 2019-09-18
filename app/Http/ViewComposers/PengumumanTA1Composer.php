<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use MaddHatter\LaravelFullcalendar\Calendar;
use App\TA1_Pengumuman;
use Illuminate\Support\Facades\DB;

class PengumumanTA1Composer
{
    public $listOfPengumumanTA1;

    public function __construct()
    {
        $this->listOfPengumumanTA1 = TA1_Pengumuman::all();

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('listOfPengumumanTA1',$this->listOfPengumumanTA1);
    }
}