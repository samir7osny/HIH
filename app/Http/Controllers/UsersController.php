<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $universities = \App\University::all();
        if(Auth::check()){
            return view('users.create')->with('universities',$universities);
        }
        return redirect('/')->with('error', 'You can\'t access this');
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
        return redirect('/')->with('error','The profile doesn\'t exist');
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
        $user = \App\User::where('username' , '=', $username)->firstOrFail();
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
        if(auth()->user()->id !== $user->id){
            return redirect('/')->with('error', 'Unauthorized page');
        }

        if($user->photo_url != 'user.jpg'){
            // Delete Image
            Storage::delete('public/usersImages/'.$user->photo_url);
        }
        
        $user->userInfo->delete();
        $user->delete();
        return redirect('/')->with('success', 'user Removed');
    }
}
