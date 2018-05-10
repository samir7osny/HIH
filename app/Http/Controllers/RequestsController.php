<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RequestsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {        
        /*Middlewares to prevent someone from mainpulating with requests*/
         // $this->middleware('auth');
        // $this->middleware('highboard')->except('create','store');
         $this->middleware('president')->except('create','store');
         $this->middleware('hr_head')->except('update','edit');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->inbox();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //This function is responsible for get all incoming requests from the database
    public function inbox()
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'No thing to see!');
        }
        $data = [
            'section'  => 'inbox',
            'requests'   => \App\Request::all()    // check if the login user is HB
        ];
        return view('requests.index')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //This function is responsible for get all sent requests from the database
    public function outbox()
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'No thing to see!');
        }
        $data = [
            'section'  => 'outbox',
            'requests'   => Auth::user()->outboxRequests
        ];
        return view('requests.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //This function is responsible for return sending form request to the user
    public function create($userId)
    {
        $userToDelete = \App\User::find($userId);
        if ($userToDelete != null)
            return view('requests.create')->with('userToDelete',$userToDelete);
        return redirect('/')->with('error', 'The user doesn\'t exist!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //This function is responsible for storing  request in the database
    public function store(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required',
            'content' => 'required|string|max:255',
        ]);

        $DRequest = new \App\Request;
        $DRequest->member_to_delete_id = $request->input('userid');
        $DRequest->content = $request->input('content');
        if (!Auth::check())
            return redirect('/')->with('error', 'You must login!');
        $DRequest->sender = Auth::user()->id;
        $DRequest->answered = 0;
        $DRequest->seen = 0;
        $DRequest->seen_at = null;

        $DRequest->save();

        return redirect('/')->with('success', 'The deleting request has been sent.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //This function is responsible for return a certain request page to the user
    public function show($id)
    {
        $request = \App\Request::find($id);
        
        // Check for correct user
        if(auth()->user()->id !== $request->sender){
            if ($request->seen == 0) {
                $request->seen = 1;
                $request->seen_at = date('Y-m-d H:i:s');
                $request->save();
            }
        }
        return view('requests.show')->with('request', $request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //This function is responsible for updating a certian request in the database
    public function update(Request $request, $id)
    {
        $DRequest = \App\Request::find($id);
        if ($request->input('answer')) {
            $DRequest->deleted_user_name = $DRequest->userToDelete->first_name . " " . $DRequest->userToDelete->last_name;
            $DRequest->answered = true;
            $DRequest->answer = true;
            app('App\Http\Controllers\UsersController')->destroy($DRequest->userToDelete->username);
            $DRequest->save();
        }
        else{
            $DRequest->deleted_user_name = $DRequest->userToDelete->first_name . " " . $DRequest->userToDelete->last_name;
            $DRequest->answered = true;
            $DRequest->answer = false;
            $DRequest->save();
        }
        return redirect('/request')->with('success','The answer has been approved');
    }
}
