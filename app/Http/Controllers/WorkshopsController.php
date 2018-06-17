<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Http\Request;

class WorkshopsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('marketing_head')->except('enroll','index','show');
        // $this->middleware('highboard')->except('index','show');
        // $this->middleware('president')->except('index','show');
        // $this->middleware('guest')->only('enroll');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshops= \App\Workshop::all();
        return  view('workshops.index')->with('workshops',$workshops);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workshops.create');
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
            'name' => 'required|string|unique:workshop',
            'place' => 'required|string',
            'cost' => 'integer',
            'place_cost' => 'integer',
            'description' => 'required|string',
            'galleryPhoto' => 'array',
            'galleryPhoto.*' => 'image',
            'timelineDate' => 'required|array',
            'timelineFrom' => 'required|array',
            'timelineTo' => 'required|array',
            'timelineDate.*' => 'required|date|after:today',
            'timelineFrom.*' => 'required|date_format:H:i',
            'timelineTo.*' => 'required|date_format:H:i',
        ]);

        $workshop = new \App\Workshop;
        $workshop->name = $request->input('name');
        $workshop->description = $request->input('description');
        $workshop->place = $request->input('place');
        $workshop->place_cost = $request->input('place_cost');
        $workshop->cost = $request->input('cost');
        $workshop->save();

        $files = $request->file('galleryPhoto');

        if($request->hasFile('galleryPhoto'))
        {
            foreach ($files as $file) {
                // Get filename with the ext.
                $fileNameWithExt = $file->getClientOriginalName();
                // Get just filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get just ext.
                $extension = $file->getClientOriginalExtension();
                // FileName To store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $file->storeAs('/public/activitiesGallery/', $fileNameToStore);

                // save the photo to the gallery
                $gallaeryPhoto = new \App\WorkshopPhoto;
                $gallaeryPhoto->url = $fileNameToStore;
                $gallaeryPhoto->workshop_id = $workshop->id;
                $gallaeryPhoto->save();

                // save the cover
                if($request->input('coverName') == $fileNameWithExt){
                    $workshop->cover_id = $gallaeryPhoto->id;
                    $workshop->save();
                }
            }
        }

        if ($request->has('timelineDate')){
            $timelineDates = $request->get('timelineDate');
            $timelineFrom = $request->get('timelineFrom');
            $timelineTo = $request->get('timelineTo');
            foreach ($timelineDates as  $key=>$timeline) {
                $timeline = new \App\Timeline;
                $timeline->workshop_id = $workshop->id;
                $timeline->date_of_session = $timelineDates[$key];
                $timeline->from = $timelineFrom[$key];
                $timeline->to = $timelineTo[$key];
                $timeline->session_number = $key;
                $timeline->save();
            }
        }

        return redirect('/workshop')->with('success', 'The workshop created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $workshop= \App\Workshop::where('name',$name)->first();
        return view('workshops.show')->with('workshop',$workshop);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        $workshop= \App\Workshop::where('name',$name)->first();
        return view('workshops.edit')->with('workshop',$workshop);
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
            'name' => 'string',
            'place' => 'required|string',
            'cost' => 'integer',
            'place_cost' => 'integer',
            'description' => 'required|string',
            'galleryPhoto' => 'array',
            'galleryPhoto.*' => 'image',
            'timelineDate' => 'required|array',
            'timelineFrom' => 'required|array',
            'timelineTo' => 'required|array',
            'timelineDate.*' => 'required|date|after:today',
            'timelineFrom.*' => 'required|date_format:H:i',
            'timelineTo.*' => 'required|date_format:H:i',
        ]);

        $workshop = \App\Workshop::find($id);
        $workshop->description = $request->input('description');
        $workshop->place = $request->input('place');
        $workshop->place_cost = $request->input('place_cost');
        $workshop->save();

        $files = $request->file('galleryPhoto');

        if($request->hasFile('galleryPhoto'))
        {
            foreach ($files as $file) {
                // Get filename with the ext.
                $fileNameWithExt = $file->getClientOriginalName();
                // Get just filename
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get just ext.
                $extension = $file->getClientOriginalExtension();
                // FileName To store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $file->storeAs('/public/activitiesGallery/', $fileNameToStore);

                // save the photo to the gallery
                $gallaeryPhoto = new \App\WorkshopPhoto;
                $gallaeryPhoto->url = $fileNameToStore;
                $gallaeryPhoto->workshop_id = $workshop->id;
                $gallaeryPhoto->save();

                // save the cover
                if($request->input('coverName') == $fileNameWithExt){
                    $workshop->cover_id = $gallaeryPhoto->id;
                    $workshop->save();
                }
            }
        }
        if ($request->has('deletePhoto')){
            foreach ($request->get('deletePhoto') as  $photo) {
                $gallaeryPhoto = \App\WorkshopPhoto::where('url',$photo)->first();
                if ($gallaeryPhoto){
                    if ($gallaeryPhoto->id == $workshop->cover_id){
                        $workshop->cover_id = null;
                        $workshop->save();
                    }
                    $gallaeryPhoto->delete();
                    Storage::delete('/public/activitiesGallery/' . $photo);
                }
            }
        }

        $cover = $request->input('coverName');
        $cover = \App\WorkshopPhoto::where('url',$cover)->first();
        if ($cover){
            $workshop->cover_id = $cover->id;
            $workshop->save();
        }

        foreach ($workshop->timelines as $timeline) {
            $timeline->delete();
        }
        if ($request->has('timelineDate')){
            $timelineDates = $request->get('timelineDate');
            $timelineFrom = $request->get('timelineFrom');
            $timelineTo = $request->get('timelineTo');
            foreach ($timelineDates as  $key=>$timeline) {
                $timeline = new \App\Timeline;
                $timeline->workshop_id = $workshop->id;
                $timeline->date_of_session = $timelineDates[$key];
                $timeline->from = $timelineFrom[$key];
                $timeline->to = $timelineTo[$key];
                $timeline->session_number = $key;
                $timeline->save();
            }
        }

        return redirect('/workshop')->with('success', 'The workshop updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workshop= \App\Workshop::find($id);
        foreach ($workshop->gallery as $photo) {
            Storage::delete('/public/activitiesGallery/' . $photo->url);
            $photo->delete();
        }
        foreach ($workshop->timelines as $timeline) {
            $timeline->delete();
        }
        $workshop->delete();
        return redirect('/workshop')->with('success', 'The workshop has been deleted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function enroll(Request $request,$id)
    {
        $workshop= \App\Workshop::find($id);
        if(Auth::user()){
        $checkExist=\App\WorkshopEnrollment::where([
            ['workshop_id','=',$id],
            ['guest_id','=',Auth::user()->id]
            ])->get();
        }
        else{
            return redirect('/login');
        }
        if($checkExist->count()==0)
        {
            $enroll=new \App\WorkshopEnrollment();
            $enroll->workshop_id=$id;
            $enroll->guest_id=Auth::user()->id;
            $enroll->save();        
            return redirect('/workshop/'.$workshop->name)->with('success', 'You have been enrolled in '.$workshop->name. ' workshop.');
        }
        return redirect('/workshop/'.$workshop->name)->with('error', 'You have already been enrolled in '.$workshop->name. ' workshop.');
    }
}