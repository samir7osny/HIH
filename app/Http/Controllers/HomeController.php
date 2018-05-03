<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upcomingEvents=\App\Event::orderBy('date','desc')->get();
        //$upcomingSessions=\App\Timeline::where('date_of_session','>=',date("Y-m-d"))->get();
        $upcomingWorkshops=\App\Workshop::join('sessiontimeline','workshop.id','=','sessiontimeline.workshop_id')
            ->select('workshop.*','sessiontimeline.date_of_session')
            ->where('date_of_session','>=',date("Y-m-d"))
            ->get()
            ->unique('workshop.id');
        $upcomingActivities=[
            'upcomingEvents'=>$upcomingEvents,
            'upcomingWorkshops'=>$upcomingWorkshops
        ];
        //$upcomingWorkshops = DB::table('workshop')->join($upcomingSessions, 'id', '=', 'workshop_id')->get();
        return view('home')->with('upcomingActivities',$upcomingActivities);
    }
}
