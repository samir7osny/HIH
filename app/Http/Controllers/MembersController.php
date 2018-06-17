<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {       
         $this->middleware('hr_head')->except('index');
        // $this->middleware('highboard')->except('index');
        // $this->middleware('president')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //To get all members
    public function index()
    {
        $members = \App\Member::all();
        $data = [
            'title' => 'All HIH\'s members',
            'members' => $members
        ];
        return view('members.index')->with($data);
    }

    //To assign a certain member to a certain committee
    public function assign(Request $request){
        $member = \App\Member::find($request->id);
        if(! $member){
            return  array("desc"=>"The member doesn't exist!","success"=>false);
        }
        if($member->committee_id){
            return  array("desc"=>"The member is assigned in another committee!","success"=>false);
        }
        $committee = \App\Committee::find($request->committeeId);
        if(! $committee){
            return  array("desc"=>"The committee doesn't exist!","success"=>false);
        }
        $member->committee_id = $request->committeeId;
        $member->save();
        return array("desc"=>"The member is assigned to the committee.","success"=>true,"member"=> $member->toArray(),"user"=>$member->user->toArray());
    }
    //To assign a certain member to a certain committee as a head
    public function assignHead(Request $request){
        $member = \App\Member::find($request->id);
        if(! $member){
            return  array("desc"=>"The member doesn't exist!","success"=>false);
        }
        if($member->committee_id != $request->committeeId){
            return  array("desc"=>"The member isn't in this committee!","success"=>false);
        }
        $committee = \App\Committee::find($request->committeeId);
        if(! $committee){
            return  array("desc"=>"The committee doesn't exist!","success"=>false);
        }
        $committee->head_id = $request->id;
        $committee->save();
        return array("desc"=>"The member is assigned as head in the committee.","success"=>true);
    }
    //To delete a certain member from a certain committee
    public function unassign(Request $request){
        $member = \App\Member::find($request->id);
        if(! $member){
            return  array("desc"=>"The member doesn't exist!","success"=>false);
        }
        $committee = \App\Committee::find($request->committeeId);
        if($committee && $committee->head_id == $request->id){
            $committee->head_id = null;
            $committee->save();
        }
        $member->committee_id = null;
        $member->save();
        return array("desc"=>"The member is unassigned from the committee.","success"=>true);
    }
    //To get all members that are not in any committee
    public function freeMemebers()
    {
        $members = \App\Member::with(['user'])->whereNull('committee_id')->get();
        return view('members.free')->with('members',$members);
    }
}
