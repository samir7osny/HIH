<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = \App\Member::all();
        $data = [
            'title' => 'All HIH\'s members',
            'members' => $members
        ];
        return view('members.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 0;
        $universities = \App\University::all();
        // if(Auth::check()){
            return view('users.create')->with(['universities'=>$universities,'type'=>$type]);
        // }
        return redirect('/')->with('error', 'You can\'t access this');
    }


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


    public function freeMemebers()
    {
        $members = \App\Member::with(['user'])->whereNull('committee_id')->get();
        return view('members.free')->with('members',$members);
    }

    public function search(Request $request)
    {
        $members = \App\Member::whereHas('user', function ($query) {
            global $request;
            $query->Where('first_name', 'LIKE', '%' . $request->searchKey . '%')
            ->orWhere('last_name', 'LIKE', '%' . $request->searchKey . '%');
        })->paginate(8);
        $data = view('members.search')->with('members',$members)->render();
        return array("desc"=>"The search has been updated.","success"=>true,"data"=>$data);
    }
    public function rate(Request $request, $username)
    {
        $this->validate($request, [
            'rate' => 'required'
        ]);
        $member = \App\User::where('username' , '=', $username)->firstOrFail()->userInfo;
        $member->rate = $request->rate;
        $member->save();
        return array("desc"=>"The changes has been saved.","success"=>true,"userRate"=>$member->rate,"totalRate"=>$member->rate);
        return array("desc"=>"The Committee doesn't exist!","success"=>false);
    }
    public function president(Request $request, $id)
    {
        $member = \App\Member::find($id);
        $hih = \App\HIH::first();
        $hih->president_id = $member->id;
        $hih->save();
        return redirect('/aboutus')->with('success', 'The president is changed');
    }
}
