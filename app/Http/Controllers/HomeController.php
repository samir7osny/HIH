<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $upcomingEvents = \App\Event::where('date', '>=', date("Y-m-d"))->orderBy('date')->get();
        //$upcomingWorkshops = \App\Workshop::where('date', '>=', date("Y-m-d"))->sortBy('date');
        $data = [
            'upcomingEvents' => $upcomingEvents
        ];
        return view('home')->with($data);
    }
}
