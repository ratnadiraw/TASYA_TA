<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Dosen;
use App\TU;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Calendar;
use Illuminate\Support\Facades\Redirect;

class Agenda extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'listOfAgenda']);
    }

    public function index()
    {
        $listOfEvent = Event::all();
        return view('tim_ta.agenda')->with(['listOfEvent' => $listOfEvent]);
    }

    public function addAgenda(Request $request)
    {
        $request->validate([
            'agenda' => 'required',
            'start-date' => 'required|date',
            'end-date' => 'required|date',
        ]);
        $title = $request->input('agenda');
        $startDate = $request->input('start-date');
        $endDate = $request->input('end-date');
        if (strtotime($endDate) < strtotime($startDate)) {
            return Redirect::back()->withErrors('Tanggal Berakhir tidak boleh lebih awal dari Tanggal Mulai');
        }
        $event = new Event;
        $event->title = $title;
        $event->start_date = $startDate;
        $event->end_date = $endDate;
        $event->save();

        return redirect('tim_ta/agenda');
    }

    public function deleteAgenda($id) {
        $event = Event::find($id);
        $event->delete();

        return back();
    }

    public function listOfAgenda() {
        $listOfEvent = Event::all();
        return view('layouts.agenda')->with(['listOfEvent' => $listOfEvent]);
    }
}
