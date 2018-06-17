<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('highboard')->except('index','aboutus');
        // $this->middleware('president')->except('index','aboutus');
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutus()
    {
        $hih = \App\HIH::first();
        if ($hih == null) {
            return redirect('/aboutus/create')->with('error', 'you must create the Hand In Hand\'s information first!');
        }
        return view('hih.aboutus')->with('hih',$hih);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hih = \App\HIH::count();
        if ($hih != 0){
            return redirect('aboutus')->with('error', 'The Hand in Hand\'s information already exists!');
        }
        
        $universities = \App\University::all();
        return view('hih.create')->with('universities', $universities);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $hih = \App\HIH::count();
        if ($hih == 0){
            return redirect('/aboutus/create')->with('error', 'You must create the Hand In Hand\' information first!');
        }
        $universities = \App\University::all();
        $data = [
            'hih'  => \App\HIH::first(),
            'universities'   => $universities
        ];
        return view('hih.edit')->with($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'mission' => 'required',
            'vision' => 'required',
            'founder' => 'required',
            'college' => 'required|integer',
            'date_of_foundation' => 'required|date'
        ]);
        $hih = \App\HIH::count();
        if ($hih != 0){
            return redirect('/aboutus')->with('error', 'The Hand in Hand\'s information already exists!');
        }
        $hih = new \App\HIH;
        $hih->mission = $request->input('mission');
        $hih->vision = $request->input('vision');
        $hih->founder = $request->input('founder');
        $hih->college_id = $request->input('college');
        $hih->date_of_foundation = $request->input('date_of_foundation');
        $hih->president_id = Auth::user()->id;
        $hih->save();

        return redirect('/aboutus')->with('success', 'The Hand In Hand\'s information has been created.');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'mission' => 'required',
            'vision' => 'required',
            /*'founder' => 'required',
            'college' => 'required|integer',
            'date_of_foundation' => 'required|date'*/
        ]);
        $hih = \App\HIH::first();
        $hih->mission = $request->input('mission');
        $hih->vision = $request->input('vision');
        $hih->save();

        return redirect('/aboutus')->with('success', 'The Hand In Hand\'s information has been updated.');
    }
}
