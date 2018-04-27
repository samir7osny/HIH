<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkshopsController extends Controller
{
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
            'name' => 'required|string',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i',
            'date' => 'required|date',
            'place' => 'required|string',
            'place_cost' => 'required|integer',
            'description' => 'required|string',
            'galleryPhoto' => 'array',
            'galleryPhoto.*' => 'image'
        ]);

        $workshop = new \App\Workshop;
        $workshop->name = $request->input('name');
        $workshop->description = $request->input('description');
        $workshop->place = $request->input('place');
        $workshop->place_cost = $request->input('place_cost');
        $workshop->from = $request->input('from');
        $workshop->to = $request->input('to');
        $workshop->date = $request->input('date');
        $workshop->no_of_forms = 0;
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
    public function update(Request $request, $name)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i',
            'date' => 'required|date',
            'place' => 'required|string',
            'place_cost' => 'required|integer',
            'description' => 'required|string',
            'galleryPhoto' => 'array',
            'galleryPhoto.*' => 'image',
            'deletePhoto' => 'array',
            'deletePhoto.*' => 'string'
        ]);

        $workshop = \App\Workshop::where('name',$name)->first();
        $workshop->name = $request->input('name');
        $workshop->description = $request->input('description');
        $workshop->place = $request->input('place');
        $workshop->place_cost = $request->input('place_cost');
        $workshop->from = $request->input('from');
        $workshop->to = $request->input('to');
        $workshop->date = $request->input('date');
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
        $workshop->delete();
        return redirect('/workshop')->with('success', 'The workshop has been deleted.');
    }
}