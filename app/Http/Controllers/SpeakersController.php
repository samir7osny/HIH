<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class SpeakersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $speakers = \App\Speaker::all();
        return view('speakers.index')->with('speakers', $speakers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('speakers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:5',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'userImage' => 'image|nullable|max:5999',
            'phone_number' => 'required|string|max:11|min:11|unique:speaker',
            'email' => 'required|email|unique:speaker',
            'interests' => 'required|string',
            'about' => 'string|nullable',
        ]);

        $speaker = new \App\Speaker;
        $speaker->title = $request->input('title');
        $speaker->first_name = $request->input('first_name');
        $speaker->last_name = $request->input('last_name');
        $speaker->phone_number = $request->input('phone_number');
        $speaker->email = $request->input('email');
        $speaker->fields_of_interest = $request->input('interests');
        $speaker->about = $request->input('about');
        $speaker->save();

        // Handle file upload
        if($request->hasFile('userImage')){
            // Get filename with the ext.
            $fileNameWithExt = $request->file('userImage')->getClientOriginalName();
            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext.
            $extension = $request->file('userImage')->getClientOriginalExtension();
            // FileName To store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('userImage')->storeAs('public/speakersImages', $fileNameToStore);
        } else {
            $fileNameToStore = 'speaker.jpg';
        }
        $speaker->photo_url = $fileNameToStore;
        $speaker->save();


        return redirect('/speaker')->with('success', 'The speaker created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $speaker = \App\Speaker::find($id);
        if($speaker){
            return view('speakers.show')->with('speaker', $speaker);
        }
        return redirect('/')->with('error','The speaker doesn\'t exist');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $speaker = \App\Speaker::find($id);
        if($speaker){
            return view('speakers.edit')->with('speaker',$speaker);
        }
        return redirect('/')->with('error','The speaker doesn\'t exist');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:5',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'userImage' => 'image|nullable|max:5999',
            'phone_number' => 'required|string|max:11|min:11',
            'email' => 'required|email',
            'interests' => 'required|string',
            'about' => 'string|nullable',
        ]);
        
        $speaker = \App\Speaker::find($id);
        $speaker->title = $request->input('title');
        $speaker->first_name = $request->input('first_name');
        $speaker->last_name = $request->input('last_name');
        $speaker->phone_number = $request->input('phone_number');
        $speaker->email = $request->input('email');
        $speaker->fields_of_interest = $request->input('interests');
        $speaker->about = $request->input('about');

        // Handle file upload
        if($request->hasFile('userImage')){
            if ($request->file('userImage') != $speaker->photo_url){
                // Get filename with the ext.
                $fileNameWithExt = $request->file('userImage')->getClientOriginalName();
                // Get just filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get just ext.
                $extension = $request->file('userImage')->getClientOriginalExtension();
                // FileName To store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $request->file('userImage')->storeAs('public/speakersImages', $fileNameToStore);

                if($speaker->photo_url != 'speaker.jpg'){
                    // Delete Image
                    Storage::delete('public/speakersImages/'.$speaker->photo_url);
                }
                $speaker->photo_url = $fileNameToStore;
            }
        }
        $speaker->save();
        return redirect('/speaker/' . $speaker->id)->with('success', 'The profile is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $speaker = \App\Speaker::find($id);

        if($speaker->photo_url != 'speaker.jpg'){
            // Delete Image
            Storage::delete('public/speakersImages/'.$speaker->photo_url);
        }

        $name = $speaker->title . "\ " . $speaker->first_name . " " . $speaker->last_name;
        $speaker->delete();
        return redirect('/')->with('success', 'the speaker ' . $name .' is removed');
    }
}
