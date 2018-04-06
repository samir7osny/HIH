<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UniversitiesController extends Controller
{
    public function getColleges(Request $request)
    {
        $university = \App\University::find($request->id);
        $collegeOptions = view('colleges.index')->with('colleges',$university->colleges)->render();
        return $collegeOptions;
    }
}
