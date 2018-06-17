<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class SponsorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('fr_head')->except('index','show');
        // $this->middleware('highboard')->except('index','show');
        // $this->middleware('president')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = \App\Sponsor::all();
        return view('sponsors.index')->with('sponsors',$sponsors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sponsors.create');
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
            'name' => 'required|max:25',
            'userImage' => 'image|nullable|max:5999',
            'phone_number' => 'required|string|max:11|min:11|unique:sponsor',
            'email' => 'required|email|unique:sponsor',
            'about' => 'string|nullable',
        ]);

        $sponsor = new \App\Sponsor;
        $sponsor->name = $request->input('name');
        $sponsor->phone_number = $request->input('phone_number');
        $sponsor->email = $request->input('email');
        $sponsor->about = $request->input('about');
        $sponsor->save();

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
            $path = $request->file('userImage')->storeAs('public/sponsorsImages', $fileNameToStore);
        } else {
            $fileNameToStore = 'sponsor.jpg';
        }
        $sponsor->photo_url = $fileNameToStore;
        $sponsor->save();


        return redirect('/sponsor')->with('success', 'The sponsor created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sponsor = \App\Sponsor::find($id);
        if($sponsor){
            return view('sponsors.show')->with('sponsor', $sponsor);
        }
        return redirect('/')->with('error','The sponsor doesn\'t exist');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sponsor = \App\Sponsor::find($id);
        if($sponsor){
            return view('sponsors.edit')->with('sponsor',$sponsor);
        }
        return redirect('/')->with('error','The sponsor doesn\'t exist');
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
            'name' => 'required|max:25',
            'userImage' => 'image|nullable|max:5999',
            'phone_number' => 'required|string|max:11|min:11',
            'email' => 'required|email',
            'about' => 'string|nullable',
        ]);
        
        $sponsor = \App\Sponsor::find($id);
        $sponsor->name = $request->input('name');
        $sponsor->phone_number = $request->input('phone_number');
        $sponsor->email = $request->input('email');
        $sponsor->about = $request->input('about');

        // Handle file upload
        if($request->hasFile('userImage')){
            if ($request->file('userImage') != $sponsor->photo_url){
                // Get filename with the ext.
                $fileNameWithExt = $request->file('userImage')->getClientOriginalName();
                // Get just filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get just ext.
                $extension = $request->file('userImage')->getClientOriginalExtension();
                // FileName To store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $request->file('userImage')->storeAs('public/sponsorsImages', $fileNameToStore);

                if($sponsor->photo_url != 'sponsor.jpg'){
                    // Delete Image
                    Storage::delete('public/sponsorsImages/'.$sponsor->photo_url);
                }
                $sponsor->photo_url = $fileNameToStore;
            }
        }
        $sponsor->save();
        return redirect('/sponsor/' . $sponsor->id)->with('success', 'The profile is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sponsor = \App\Sponsor::find($id);

        if($sponsor->photo_url != 'sponsor.jpg'){
            // Delete Image
            Storage::delete('public/sponsorsImages/'.$sponsor->photo_url);
        }

        $name = $sponsor->name;
        $sponsor->delete();
        return redirect('/')->with('success', 'the sponsor ' . $name .' is removed');
    }
}
