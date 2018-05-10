<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         //$this->middleware('member')->only('update','edit','show');
        // $this->middleware('guest');
        // $this->middleware('president');
        // $this->middleware('highboard');
        //$this->middleware('hr_head')->only('create','store');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $universities = \App\University::all();            
        return view('users.create')->with('universities',$universities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        app('App\Http\Controllers\Auth\RegisterController')->register($request);
        return redirect('/')->with('success', 'The user is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = \App\User::where('username' , '=', $username)->firstOrFail();
        if($user){
            return view('users.show')->with('user', $user);
        }
        return redirect('/')->with('error','The profile doesn\'t exist');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $user = \App\User::where('username' , '=', $username)->firstOrFail();
        $universities = \App\University::all();
        $data = [
            'user'  => $user,
            'universities'   => $universities
        ];
        if($user){
            return view('users.edit')->with($data);
        }
        return redirect('/')->with('error','User is not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        if(Auth::check())
        {
            $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'userImage' => 'image|nullable|max:5999',
            'college' => 'required|integer',
            'phone_number' => 'required|string|max:11|min:11',
            'email' => 'required|email',
            'about' => 'string|nullable',
            ]);
        }
        else{ 
            $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'userImage' => 'image|nullable|max:5999',
            'college' => 'required|integer',
            'grade_of_college'=>'required|integer',
            'phone_number' => 'required|string|max:11|min:11',
            'email' => 'required|email',
            'about' => 'string|nullable',
            ]);
        }
        $user = \App\User::where('username' , '=', $username)->firstOrFail();
        if($user)
        {
            if(!(Auth::check()))
                $user->grade_of_college = $request->input('grade_of_college');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->college_id = $request->input('college');
            $user->phone_number = $request->input('phone_number');
            $user->email = $request->input('email');
            $user->about = $request->input('about');
            // Handle file upload
            if($request->hasFile('userImage')){
                if ($request->file('userImage') != $user->photo_url){
                    // Get filename with the ext.
                    $fileNameWithExt = $request->file('userImage')->getClientOriginalName();
                    // Get just filename
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    // Get just ext.
                    $extension = $request->file('userImage')->getClientOriginalExtension();
                    // FileName To store
                    $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                    // Upload Image
                    $path = $request->file('userImage')->storeAs('public/usersImages', $fileNameToStore);

                    if($user->photo_url != 'user.jpg'){
                        // Delete Image
                        Storage::delete('public/usersImages/'.$user->photo_url);
                    }
                    $user->photo_url = $fileNameToStore;
                }
            }
            $user->save();
            return redirect('/user/' . $user->username)->with('success', 'The profile is updated');
        }
        return redirect('/')->with('error','The profile doesn\'t exist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        $user = \App\User::where('username' , '=', $username)->firstOrFail();

        // Check for correct user
        /*if(auth()->user()->id !== $user->id){
            return redirect('/')->with('error', 'Unauthorized page');
        }*/

        if($user->photo_url != 'user.jpg'){
            // Delete Image
            Storage::delete('public/usersImages/'.$user->photo_url);
        }

        $user->userInfo->delete();
        $user->delete();
        Auth::logout();
        return redirect('/')->with('success', 'user Removed');
    }
    
    
    /**
     * Change the password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePasswordForm()
    {
        return view('auth.passwords.change');
    }


    /**
     * Change the password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('old-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('old-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'old-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();
        return redirect('/')->with("success","Password changed successfully !");
    }
    
}
