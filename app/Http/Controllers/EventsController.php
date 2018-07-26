<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('AccessPermissions:PRESIDENT,HIGHBOARD,TYPE_HEAD,MK')
            ->only(['create','store', 'edit', 'update', 'destroy']);
        
        $this->middleware('AccessPermissions:GUEST')
            ->only(['enroll', 'enrollForm', 'enrollWithAnswers', 'rate']);

        $this->middleware('AccessPermissions:PRESIDENT,HIGHBOARD,BOARD,MEMBER,GUEST')
            ->only(['showEnrollment']);

        $this->middleware('AccessPermissions:PRESIDENT,HIGHBOARD,BOARD,MEMBER')
            ->only(['audience']);
    }
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
            'name'=>'required|string|unique:event',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i',
            'date' => 'required|date|after:today',
            'place' => 'required|string',
            'place_cost' => 'required|integer',
            'description' => 'required|string',
            'galleryPhoto' => 'array',
            'galleryPhoto.*' => 'image',
            'speaker'=> 'array',
            'speaker.*'=> 'integer',
            'sponsor'=> 'array',
            'sponsor.*'=> 'integer',
            'question'=> 'array',
            'question.*'=> 'string|required',
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

        if($request->input('speaker')){
            foreach ($request->input('speaker') as $speaker) {
                $eventSpeaker = new \App\EventSpeakers;
                $eventSpeaker->event_id = $event->id;
                $eventSpeaker->speaker_id = $speaker;
                $eventSpeaker->save();
            }
        }

        if($request->input('sponsor')){
            foreach ($request->input('sponsor') as $sponsor) {
                $eventSponsor = new \App\EventSponsors;
                $eventSponsor->event_id = $event->id;
                $eventSponsor->sponsor_id = $sponsor;
                $eventSponsor->save();
            }
        }

        if($request->input('question')){
            foreach ($request->input('question') as $key => $question) {
                $questionEvent = new \App\QuestionEvent;
                $questionEvent->event_id = $event->id;
                $questionEvent->question_content = $question;
                $questionEvent->required = $request->input('req')[$key];
                $questionEvent->save();
            }
        }

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
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i',
            'date' => 'required|date|after:today',
            'place' => 'required|string',
            'place_cost' => 'required|integer',
            'description' => 'required|string',
            'galleryPhoto' => 'array',
            'galleryPhoto.*' => 'image',
            'deletePhoto' => 'array',
            'deletePhoto.*' => 'string',
            'speaker'=> 'array',
            'speaker.*'=> 'integer',
            'sponsor'=> 'array',
            'sponsor.*'=> 'integer',
            'question'=> 'array',
            'question.*'=> 'string|required',
            'deleteQuestion'=> 'array',
            'deleteQuestion.*'=> 'string|required'
        ]);

        $event = \App\Event::find($id);
        $event->description = $request->input('description');
        $event->place = $request->input('place');
        $event->place_cost = $request->input('place_cost');
        $event->from = $request->input('from');
        $event->to = $request->input('to');
        $event->date = $request->input('date');
        \App\EventSpeakers::where('event_id',$event->id)->delete();
        if($request->input('speaker')){
            foreach ($request->input('speaker') as $speaker) {
                $eventSpeaker = new \App\EventSpeakers;
                $eventSpeaker->event_id = $event->id;
                $eventSpeaker->speaker_id = $speaker;
                $eventSpeaker->save();
            }
        }
        \App\EventSponsors::where('event_id',$event->id)->delete();
        if($request->input('sponsor')){
            foreach ($request->input('sponsor') as $sponsor) {
                $eventSponsor = new \App\EventSponsors;
                $eventSponsor->event_id = $event->id;
                $eventSponsor->sponsor_id = $sponsor;
                $eventSponsor->save();
            }
        }
        if($request->input('deleteQuestion')){
            foreach ($request->input('deleteQuestion') as $question) {
                \App\QuestionEvent::find($question)->delete();
            }
        }
        if($request->input('question')){
            foreach ($request->input('question') as $key => $question) {
                $questionEvent = new \App\QuestionEvent;
                $questionEvent->event_id = $event->id;
                $questionEvent->question_content = $question;
                $questionEvent->required = $request->input('req')[$key];
                $questionEvent->save();
            }
        }
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
        \App\EventSpeakers::where('event_id',$event->id)->delete();
        \App\EventSponsors::where('event_id',$event->id)->delete();

        $event->delete();
        return redirect('/event')->with('success', 'The event has been deleted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function enroll(Request $request, $name)
    {
        $event= \App\Event::where('name',$name)->first();
        if($event == null){
            return redirect('/event')->with('error', 'The event doesn\'t exist!');
        }
        if(Auth::user() && Auth::user()->type != 0){
        $checkExist=\App\EventEnrollment::where([
            ['event_id','=',$event->id],
            ['guest_id','=',Auth::user()->userInfo->id]
            ])->get();
        }
        else if(Auth::user()){
            return redirect('/event/'.$event->name)->with('error', 'You can\'t do this!');
        }
        else{
            return redirect('/login');
        }
        if($checkExist->count()==0)
        {
            if(count($event->questions) > 0){
                return redirect('/event/'.$event->name.'/enrollform');
            }
            $enroll=new \App\EventEnrollment;
            $enroll->event_id=$event->id;
            $enroll->guest_id=Auth::user()->userInfo->id;
            $enroll->save();        
            return redirect('/event/'.$event->name)->with('success', 'You have been enrolled in '.$event->name. ' event.');
        }
        
        return redirect('/event/'.$event->name.'/'.Auth::user()->username);
    }

    public function enrollForm($name)
    {
        $event= \App\Event::where('name',$name)->first();
        return view('events.enroll')->with('event',$event);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function enrollWithAnswers(Request $request, $name)
    {
        $this->validate($request, [
            'answer'=> 'array',
        ]);
        $event= \App\Event::where('name',$name)->first();
        if($event == null){
            return redirect('/event')->with('error', 'The event doesn\'t exist!');
        }
        if(Auth::user()){
        $checkExist=\App\EventEnrollment::where([
            ['event_id','=',$event->id],
            ['guest_id','=',Auth::user()->userInfo->id]
            ])->get();
        }
        else if(Auth::user() && Auth::user()->type != 0){
            return redirect('/event/'.$event->name)->with('error', 'You can\'t do this!');
        }
        else{
            return redirect('/login');
        }
        if($checkExist->count()==0)
        {
            $enroll=new \App\EventEnrollment;
            $enroll->event_id=$event->id;
            $enroll->guest_id=Auth::user()->userInfo->id;
            foreach ($request->input('answer') as $key => $answerInput) {
                if($answerInput != ""){
                    $answer = new \App\AnswerEvent;
                    $answer->question_id = $key;
                    $answer->event_id = $event->id;
                    $answer->guest_id = Auth::user()->userInfo->id;
                    $answer->answer_content = $answerInput;
                    $answer->save();
                }
            }
            $enroll->save();        
            return redirect('/event/'.$event->name)->with('success', 'You have been enrolled in '.$event->name. ' event.');
        }
        return redirect('/event/'.$event->name.'/'.Auth::user()->username);
        
    }
    public function showEnrollment($name,$username)
    {
        if($username == 'edit'){
            return $this->edit($name);
        }
        if($username == 'audience'){
            return $this->audience($name);
        }
        $event= \App\Event::where('name',$name)->first();
        $user= \App\User::where('username',$username)->first();
        if(Auth::check() && !Auth::user()->userInfo->isMember() ){
            if(   ! ($username == Auth::user()->username && \App\User::havePermission(['EVENT_AUD', $event->id])))    {
                return redirect('/event/'.$event->name)->with('error', 'You haven\'t the permission to do that!');
            }
        }
        if($user->type != 1){
            return redirect('/event/'.$event->name)->with('error', 'No thing there!');
        }
        $user = $user->userInfo;
        return view('events.enrollment')->with(['event'=>$event,'user'=>$user]);
    }
    public function audience($name)
    {
        $event= \App\Event::where('name',$name)->first();
        return view('events.audience')->with('event',$event);
    }
    public function rate(Request $request, $name)
    {

        $this->validate($request, [
            'rate' => 'required'
        ]);
        $event= \App\Event::where('name',$name)->first();
        if($event) {
            if( !(Auth::check() && !Auth::user()->userInfo->isMember() && \App\EventEnrollment::where('event_id', $event->id)->where('guest_id', Auth::user()->userInfo->id))  ){
                return array("desc"=>"You can\'t rate this event!","success"=>false);
            }
            $oldRate = \App\EventRate::where('event_id',$event->id)->where('guest_id',Auth::user()->userInfo->id);
            if ($oldRate){
                $oldRate->update(['rate' => $request->rate]);
            }
            else {
                $newRate = new \App\EventRate;
                $newRate->event_id = $event->id;
                $newRate->guest_id = Auth::user()->userInfo->id;
                $newRate->rate = $request->rate;
                $newRate->save();
            }
            return array("desc"=>"The changes has been saved.","success"=>true,"userRate"=>$request->rate,"totalRate"=>$event->totalRate());
        }
        return array("desc"=>"The Event doesn't exist!","success"=>false);
    }
}
