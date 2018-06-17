<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CommitteesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $committees = \App\Committee::all();
        return view('committees.index')->with('committees',$committees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $committees_shortcuts = DB::table('committees_codes')->get();
        $contents = view('committees.create')->with('committees_codes', $committees_shortcuts)->render();
        
        return $contents;
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
            'name' => 'required',
            'description' => 'required',
            'type' => 'required'
        ]);
        $shortcut = DB::table('committees_codes')->where('id', $request->type)->get();
        if ($shortcut == null) {
            return array("desc"=>"The choosen type doesn't exist!","success"=>false);
        }
        $committee = new \App\Committee;

        $committee->name = $request->name;
        $committee->description = $request->description;
        $committee->shortcut_id = $request->type;
        $committee->save();

        return array("desc"=>"The committee has been saved.","success"=>true,"id"=>$committee->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $committee = \App\Committee::find($id);
        return array("desc"=>"The committee exists","success"=>true,"name"=>$committee->name,"description"=>$committee->description);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'name' => 'required',
            'description' => 'required'
        ]);
        $committee = \App\Committee::find($id);
        if($committee) {
            $committee->name = $request->name;
            $committee->description = $request->description;
            $committee->save();
            return array("desc"=>"The changes has been saved.","success"=>true);
        }
        return array("desc"=>"The Committee doesn't exist!","success"=>false);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $committee = \App\Committee::find($id);
        if($committee){
            $committee->delete();
            return array("desc"=>"The Committee has been deleted","success"=>true);
        }
        return array("desc"=>"The Committee doesn't exist","success"=>false);
    }
}
