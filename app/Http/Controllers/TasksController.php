<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('AccessPermissions:HIGHBOARD,BOARD,MEMBER')
            ->only(['inbox']);

        $this->middleware('AccessPermissions:PRESIDENT,HIGHBOARD,BOARD')
            ->only(['create','store','edit','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\App\User::havePermission(['PRESIDENT']))
            return redirect('task/outbox');
        else
            return $this->inbox();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'No thing to see!');
        }
        $data = [
            'section'  => 'inbox',
            'tasks'   => Auth::user()->inboxTasks
        ];
        //return $data['tasks'];
        return view('tasks.index')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function outbox()
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'No thing to see!');
        }
        $data = [
            'section'  => 'outbox',
            'tasks'   => Auth::user()->outboxTasks
        ];
        return view('tasks.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userId)
    {
        if(! \App\User::havePermission(['PRESIDENT','TASK_HIGHBOARD',$user->id,'TASK_BOARD',$user->id]) ){
            return redirect('/')->with('error', 'You haven\'t the permission to do that!');
        }
        $receiver = \App\User::find($userId);
        if ($receiver != null)
            return view('tasks.create')->with('receiver',$receiver);
        return redirect('/')->with('error', 'The user doesn\'t exist!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(! \App\User::havePermission(['PRESIDENT','TASK_HIGHBOARD',$user->id,'TASK_BOARD',$user->id]) ){
            return redirect('/')->with('error', 'You haven\'t the permission to do that!');
        }
        $this->validate($request, [
            'receiver' => 'required|integer',
            'content' => 'required|string|max:255',
        ]);

        $Task = new \App\Task;
        $Task->receiver = $request->input('receiver');
        $Task->content = $request->input('content');
        if (!Auth::check())
            return redirect('/')->with('error', 'You must login!');
        $Task->sender = Auth::user()->id;
        $Task->answered = 0;
        $Task->seen = 0;
        $Task->seen_at = null;

        $Task->save();

        return redirect('/')->with('success', 'The task has been sent.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = \App\Task::find($id);
        
        // Check for correct user
        if($task && auth()->user()->id !== $task->sender && auth()->user()->id == $task->receiver){
            if ($task->seen == 0) {
                $task->seen = 1;
                $task->seen_at = date('Y-m-d H:i:s');
                $task->save();
            }
        }
        return view('tasks.show')->with('task', $task);
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
        $Task = \App\Task::find($id);
        if ($request->input('answer')) {
            $Task->answered = true;
            $Task->answer = true;
            $Task->save();
        }
        else{
            $Task->answered = true;
            $Task->answer = false;
            $Task->save();
        }
        return redirect('/task')->with('success','The answer has been approved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Task = \App\Task::find($id);
        if ($Task && $Task->sender == Auth::user()->id) {
            return redirect('/task')->with('error','You can\'t delete this task');
        }        
        $Task->delete();
        return redirect('/task')->with('success','The task has been deleted');
    }
}
