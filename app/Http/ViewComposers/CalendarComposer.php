<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use MaddHatter\LaravelFullcalendar\Calendar;
use App\Event;

class CalendarComposer
{
    public $calendar;

    public function __construct()
    {
        $events = [];
        $listOfEvent = Event::all();
        if(count($listOfEvent) > 0) {
            foreach ($listOfEvent as $event) {
                $events[] = Calendar::event($event->title, true, new \DateTime($event->start_date), new \DateTime($event->end_date), null,
                    [
                        'color' => '#f05050',
                        'url' => '/agenda',
                    ]);
            }
        }
        $this->calendar = \Calendar::addEvents($events) //add an array with addEvents
        ->setOptions([ //set fullcalendar options
            'firstDay' => 1
        ]);

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('calendar',$this->calendar);
    }
}