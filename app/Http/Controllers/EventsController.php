<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events= \App\Event::all();
        return  view('events.index')->with('events',$events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
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
            'name'=>'required|string',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i',
            'date' => 'required|date|after:today',
            'place' => 'required|string',
            'place_cost' => 'required|integer',
            'description' => 'required|string',
            'galleryPhoto' => 'array',
            'galleryPhoto.*' => 'image'
        ]);

        $event = new \App\Event;
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->place = $request->input('place');
        $event->place_cost = $request->input('place_cost');
        $event->from = $request->input('from');
        $event->to = $request->input('to');
        $event->date = $request->input('date');
        $event->no_of_forms = 0;
        $event->save();

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
                $gallaeryPhoto = new \App\EventPhoto;
                $gallaeryPhoto->url = $fileNameToStore;
                $gallaeryPhoto->event_id = $event->id;
                $gallaeryPhoto->save();

                // save the cover
                if($request->input('coverName') == $fileNameWithExt){
                    $event->cover_id = $gallaeryPhoto->id;
                    $event->save();
                }
            }
        }


        return redirect('/event')->with('success', 'The event created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $event= \App\Event::where('name',$name)->first();
        return view('events.show')->with('event',$event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        $event= \App\Event::where('name',$name)->first();
        return view('events.edit')->with('event',$event);
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
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i',
            'date' => 'required|date|after:today',
            'place' => 'required|string',
            'place_cost' => 'required|integer',
            'description' => 'required|string',
            'galleryPhoto' => 'array',
            'galleryPhoto.*' => 'image',
            'deletePhoto' => 'array',
            'deletePhoto.*' => 'string'
        ]);

        $event = \App\Event::find($id);
        $event->name=$request->input('name');
        $event->description = $request->input('description');
        $event->place = $request->input('place');
        $event->place_cost = $request->input('place_cost');
        $event->from = $request->input('from');
        $event->to = $request->input('to');
        $event->date = $request->input('date');
        $event->save();

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
                $gallaeryPhoto = new \App\EventPhoto;
                $gallaeryPhoto->url = $fileNameToStore;
                $gallaeryPhoto->event_id = $event->id;
                $gallaeryPhoto->save();

                // save the cover
                if($request->input('coverName') == $fileNameWithExt){
                    $event->cover_id = $gallaeryPhoto->id;
                    $event->save();
                }
            }
        }
        if ($request->has('deletePhoto')){
            foreach ($request->get('deletePhoto') as  $photo) {
                $gallaeryPhoto = \App\EventPhoto::where('url',$photo)->first();
                if ($gallaeryPhoto){
                    if ($gallaeryPhoto->id == $event->cover_id){
                        $event->cover_id = null;
                        $event->save();
                    }
                    $gallaeryPhoto->delete();
                    Storage::delete('/public/activitiesGallery/' . $photo);
                }
            }
        }

        $cover = $request->input('coverName');
        $cover = \App\EventPhoto::where('url',$cover)->first();
        if ($cover){
            $event->cover_id = $cover->id;
            $event->save();
        }

        return redirect('/event')->with('success', 'The event updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event= \App\Event::find($id);
        foreach ($event->gallery as $photo) {
            Storage::delete('/public/activitiesGallery/' . $photo->url);
            $photo->delete();
        }
        $event->delete();
        return redirect('/event')->with('success', 'The event has been deleted.');
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
        $event= \App\Event::find($id);
        if(Auth::user()){
        $checkExist=\App\EventEnrollment::where([
            ['event_id','=',$id],
            ['guest_id','=',Auth::user()->id]
            ])->get();
        }
        else{
            return redirect('/login');
        }
        if($checkExist->count()==0)
        {
            $enroll=new \App\EventEnrollment;
            $enroll->event_id=$id;
            $enroll->guest_id=Auth::user()->id;
            $enroll->save();        
            return redirect('/event/'.$event->name)->with('success', 'You have been enrolled in '.$event->name. ' event.');
        }
        
        return redirect('/event/'.$event->name)->with('error', 'You have already been enrolled in '.$event->name. ' event.');
    }
}
