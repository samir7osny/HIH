<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('AccessPermissions:PRESIDENT,HIGHBOARD,BOARD')
            ->only(['index','show']);
        $this->middleware('AccessPermissions:PRESIDENT,HIGHBOARD')
            ->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = \App\ContactUs::paginate(8);
        return view('contactus.index')->with('messages', $messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'sender_name' => 'required',
            'sender_email' => 'required|email',
            'content' => 'required',
        ]);

        $message = new \App\ContactUs;
        $message->sender_name = $request->input('sender_name');
        $message->sender_email = $request->input('sender_email');
        $message->content = $request->input('content');
        $message->seen = 0;
        $message->save();

        return redirect('/')->with('success', 'The feedback has been sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = \App\ContactUs::find($id);
        $message->seen = 1;
        $message->save();
        return view('contactus.show')->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // No need
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
        // No need
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = \App\ContactUs::find($id);
        $message->delete();
        return redirect('/')->with('success', 'The feedback has been deleted');
    }
}
