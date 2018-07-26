<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Http\Request;

class WorkshopsController extends Controller
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
            'modirator'=> 'array',
            'modirator.*'=> 'integer',
            'sponsor'=> 'array',
            'sponsor.*'=> 'integer'
        ]);

        $workshop = new \App\Workshop;
        $workshop->name = $request->input('name');
        $workshop->description = $request->input('description');
        $workshop->place = $request->input('place');
        $workshop->place_cost = $request->input('place_cost');
        $workshop->cost = $request->input('cost');
        $workshop->save();

        if($request->input('modirator')){
            foreach ($request->input('modirator') as $modirator) {
                $workshopModirator = new \App\WorkshopModirators;
                $workshopModirator->workshop_id = $workshop->id;
                $workshopModirator->member_id = $modirator;
                $workshopModirator->save();
            }
        }

        if($request->input('sponsor')){
            foreach ($request->input('sponsor') as $sponsor) {
                $workshopSponsor = new \App\WorkshopSponsors;
                $workshopSponsor->workshop_id = $workshop->id;
                $workshopSponsor->sponsor_id = $sponsor;
                $workshopSponsor->save();
            }
        }

        if($request->input('question')){
            foreach ($request->input('question') as $key => $question) {
                $questionWorkshop = new \App\QuestionWorkshop;
                $questionWorkshop->workshop_id = $workshop->id;
                $questionWorkshop->question_content = $question;
                $questionWorkshop->required = $request->input('req')[$key];
                $questionWorkshop->save();
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
            'modirator'=> 'array',
            'modirator.*'=> 'integer',
            'sponsor'=> 'array',
            'sponsor.*'=> 'integer'
        ]);

        $workshop = \App\Workshop::find($id);
        $workshop->description = $request->input('description');
        $workshop->place = $request->input('place');
        $workshop->place_cost = $request->input('place_cost');
        \App\WorkshopModirators::where('workshop_id',$workshop->id)->delete();
        if($request->input('modirator')){
            foreach ($request->input('modirator') as $modirator) {
                $workshopModirator = new \App\WorkshopModirators;
                $workshopModirator->workshop_id = $workshop->id;
                $workshopModirator->member_id = $modirator;
                $workshopModirator->save();
            }
        }
        \App\WorkshopSponsors::where('workshop_id',$workshop->id)->delete();
        if($request->input('sponsor')){
            foreach ($request->input('sponsor') as $sponsor) {
                $workshopSponsor = new \App\WorkshopSponsors;
                $workshopSponsor->workshop_id = $workshop->id;
                $workshopSponsor->sponsor_id = $sponsor;
                $workshopSponsor->save();
            }
        }
        if($request->input('deleteQuestion')){
            foreach ($request->input('deleteQuestion') as $question) {
                \App\QuestionWorkshop::find($question)->delete();
            }
        }
        if($request->input('question')){
            foreach ($request->input('question') as $key => $question) {
                $questionWorkshop = new \App\QuestionWorkshop;
                $questionWorkshop->workshop_id = $workshop->id;
                $questionWorkshop->question_content = $question;
                $questionWorkshop->required = $request->input('req')[$key];
                $questionWorkshop->save();
            }
        }
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
        \App\WorkshopModirators::where('workshop_id',$workshop->id)->delete();
        \App\WorkshopSponsors::where('workshop_id',$workshop->id)->delete();

        $workshop->delete();
        return redirect('/workshop')->with('success', 'The workshop has been deleted.');
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
        $workshop= \App\Workshop::where('name',$name)->first();
        if($workshop == null){
            return redirect('/workshop')->with('error', 'The workshop doesn\'t exist!');
        }
        if(Auth::user() && Auth::user()->type != 0){
        $checkExist=\App\WorkshopEnrollment::where([
            ['workshop_id','=',$workshop->id],
            ['guest_id','=',Auth::user()->userInfo->id]
            ])->get();
        }
        else if(Auth::user() && Auth::user()->type != 0){
            return redirect('/workshop/'.$workshop->name)->with('error', 'You can\'t do this!');
        }
        else{
            return redirect('/login');
        }
        if($checkExist->count()==0)
        {
            if(count($workshop->questions) > 0){
                return redirect('/workshop/'.$workshop->name.'/enrollform');
            }
            $enroll=new \App\WorkshopEnrollment;
            $enroll->workshop_id=$workshop->id;
            $enroll->guest_id=Auth::user()->userInfo->id;
            $enroll->save();        
            return redirect('/workshop/'.$workshop->name)->with('success', 'You have been enrolled in '.$workshop->name. ' workshop.');
        }
        
        return redirect('/workshop/'.$workshop->name.'/'.Auth::user()->username);
    }

    public function enrollForm($name)
    {
        $workshop= \App\Workshop::where('name',$name)->first();
        return view('workshops.enroll')->with('workshop',$workshop);
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
        $workshop= \App\Workshop::where('name',$name)->first();
        if($workshop == null){
            return redirect('/workshop')->with('error', 'The workshop doesn\'t exist!');
        }
        if(Auth::user() && Auth::user()->type != 0){
        $checkExist=\App\WorkshopEnrollment::where([
            ['workshop_id','=',$workshop->id],
            ['guest_id','=',Auth::user()->userInfo->id]
            ])->get();
        }
        else if(Auth::user() && Auth::user()->type != 0){
            return redirect('/workshop/'.$workshop->name)->with('error', 'You can\'t do this!');
        }
        else{
            return redirect('/login');
        }
        if($checkExist->count()==0)
        {
            $enroll=new \App\WorkshopEnrollment;
            $enroll->workshop_id=$workshop->id;
            $enroll->guest_id=Auth::user()->userInfo->id;
            foreach ($request->input('answer') as $key => $answerInput) {
                if($answerInput != ""){
                    $answer = new \App\AnswerWorkshop;
                    $answer->question_id = $key;
                    $answer->workshop_id = $workshop->id;
                    $answer->guest_id = Auth::user()->userInfo->id;
                    $answer->answer_content = $answerInput;
                    $answer->save();
                }
            }
            $enroll->save();        
            return redirect('/workshop/'.$workshop->name)->with('success', 'You have been enrolled in '.$workshop->name. ' workshop.');
        }
        
        return redirect('/workshop/'.$workshop->name.'/'.Auth::user()->username);
        
    }
    public function showEnrollment($name,$username)
    {
        if($username == "edit"){
            return $this->edit($name);
        }
        if($username == 'audience'){
            return $this->audience($name);
        }
        $workshop= \App\Workshop::where('name',$name)->first();
        $user= \App\User::where('username',$username)->first();
        if(Auth::check() && !Auth::user()->userInfo->isMember() ){
            if(   ! ($username == Auth::user()->username && \App\User::havePermission(['WORKSHOP_AUD', $workshop->id])))    {
                return redirect('/workshop/'.$workshop->name)->with('error', 'You haven\'t the permission to do that!');
            }
        }
        if($user->type != 1){
            return redirect('/workshop/'.$workshop->name)->with('error', 'No thing there!');
        }
        $user = $user->userInfo;
        return view('workshops.enrollment')->with(['workshop'=>$workshop,'user'=>$user]);
    }
    public function audience($name)
    {
        $workshop= \App\Workshop::where('name',$name)->first();
        return view('workshops.audience')->with('workshop',$workshop);
    }
    public function rate(Request $request, $name)
    {
        $this->validate($request, [
            'rate' => 'required'
        ]);
        $workshop= \App\Workshop::where('name',$name)->first();
        if($workshop) {
            if( !(Auth::check() && !Auth::user()->userInfo->isMember() && \App\WorkshopEnrollment::where('workshop_id', $workshop->id)->where('guest_id', Auth::user()->userInfo->id))  ){
                return array("desc"=>"You can\'t rate this workshop!","success"=>false);
            }
            $oldRate = \App\WorkshopRate::where('workshop_id',$workshop->id)->where('guest_id',Auth::user()->userInfo->id);
            if ($oldRate){
                $oldRate->update(['rate' => $request->rate]);
            }
            else {
                $newRate = new \App\WorkshopRate;
                $newRate->workshop_id = $workshop->id;
                $newRate->guest_id = Auth::user()->userInfo->id;
                $newRate->rate = $request->rate;
                $newRate->save();
            }
            return array("desc"=>"The changes has been saved.","success"=>true,"userRate"=>$request->rate,"totalRate"=>$workshop->totalRate());
        }
        return array("desc"=>"The Workshop doesn't exist!","success"=>false);
    }
}