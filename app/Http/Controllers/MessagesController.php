<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = DB::table('users as contact')
        ->join('messages as inbox', 'inbox.sender', '=', 'contact.id')
        ->where('inbox.receiver', Auth::user()->id)
        ->select('contact.*', 'created_at')
        ->union(
            DB::table('users as contact')
            ->join('messages as outbox', 'outbox.receiver', '=', 'contact.id')
            ->where('outbox.sender', Auth::user()->id)
            ->select('contact.*', 'created_at')
        )
        ->orderBy('created_at','DESC')
        ->get()
        ->unique('id');
        ////$chat = Auth::user()->inboxMessages->merge(Auth::user()->outboxMessages)->sortByDesc('created_at')->paginate(15);
        //$chat = \App\Message::where('sender', '=', Auth::user()->id)->orWhere('receiver', '=', Auth::user()->id)->orderBy('created_at','DESC')->paginate(15);
        ////$chat = \App\Message::where('sender', '=', Auth::user()->id)->orWhere('receiver', '=', Auth::user()->id)->orderBy('created_at')->paginate(15);
        $data=[
            // 'chat'=>$chat,
            // 'count' => \App\Message::where('sender', '=', Auth::user()->id)->orWhere('receiver', '=', Auth::user()->id)->count(),
            'contacts' => $contacts
        ];
        return view('messages.index')->with($data);
    }

    /**
     * Save the message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $message = new \App\Message;

        $message->content = $request->message;
        $message->sender = Auth::user()->id;
        $message->receiver = $request->receiver;
        $message->seen = 0;
        $message->save();

        $view = view('messages.show')->with('message', $message)->render();
        return array("desc"=>"The message has been saved.","success"=>true,"message"=>$message,"data"=>$view);
    }

    /**
     * Show new messages.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        $messages = \App\Message::where('receiver', Auth::user()->id)->where('sender', $request->sender)->where('id', '>', $request->lastMessage)->get();
        $data = array();
        for ($i=0; $i < $messages->count(); $i++) { 
            array_push($data, view('messages.show')->with('message', $messages[$i])->render());
        }
        return array("desc"=>"The messages has been received.","success"=>true,"data"=>$data);
    }

    /**
     * set all as seen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function seeAll(Request $request)
    {
        $messages = \App\Message::where('receiver', Auth::user()->id)->where('sender', $request->sender)->where('id', '<=', $request->lastMessage)->update(['seen' => 1]);

        return array("desc"=>"The messages has been updated.","success"=>true);
    }

    /**
     * set all as seen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkSee(Request $request)
    {
        $lastSeenMessage = \App\Message::where('sender', Auth::user()->id)->where('receiver', $request->receiver)->where('seen', '=', '1')->orderBy('id', 'desc')->first();
        if ($lastSeenMessage == null) {
            return array("desc"=>"The messages has been updated.","success"=>false);
        }
        $messages = \App\Message::where('sender', Auth::user()->id)->where('receiver', $request->receiver)->where('id', '<', $lastSeenMessage->id)->update(['seen' => 1]);

        return array("desc"=>"The messages has been updated.","success"=>true,"lastSeen"=>$lastSeenMessage->id);
    }

    /**
     * get all chat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getChat(Request $request)
    {
        $chat = \App\Message::where('sender', '=', Auth::user()->id)
                  ->where('receiver', '=', $request->chater)
        ->union(
            \App\Message::where('receiver', '=', Auth::user()->id)
                  ->where('sender', '=', $request->chater)
        )->orderBy('created_at','DESC')->take(15)->get();
        $data = view('messages.chat')->with('chat',$chat)->render();
        return array("desc"=>"The messages has been updated.","success"=>true,"data"=>$data);
    }
    
    /**
     * Chat Search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chatSearch(Request $request)
    {
        $users = \App\User::where('id', '!=', Auth::user()->id)
        ->where(function($q) {
            global $request;
            $q->where('username', 'like', '%' . $request->searchAbout . '%')
            ->orWhere('first_name', 'LIKE', '%' . $request->searchAbout . '%')
            ->orWhere('last_name', 'LIKE', '%' . $request->searchAbout . '%');
        })
        ->take(5)->get();


        $data = view('messages.usersearch')->with('users',$users)->render();
        return array("desc"=>"The search has been updated.","success"=>true,"data"=>$data);
    }

    /**
     * Chat Search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkContacts(Request $request)
    {
        $contacts = DB::table('users as contact')
        ->select('contact.*')
        ->join('messages as inbox', 'inbox.sender', '=', 'contact.id')
        ->where('inbox.receiver', Auth::user()->id)
        ->union(
            DB::table('users as contact')
            ->select('contact.*')
            ->join('messages as outbox', 'outbox.receiver', '=', 'contact.id')
            ->where('outbox.sender', Auth::user()->id)
        )
        ->get()
        ->unique()
        ->count();

        return array("desc"=>"","success"=>true,"contactsCount"=>$contacts);
    }

    /**
     * Chat Search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Contacts(Request $request)
    {
        $contacts = DB::table('users as contact')
        ->join('messages as inbox', 'inbox.sender', '=', 'contact.id')
        ->where('inbox.receiver', Auth::user()->id)
        ->select('contact.*', 'created_at')
        ->union(
            DB::table('users as contact')
            ->join('messages as outbox', 'outbox.receiver', '=', 'contact.id')
            ->where('outbox.sender', Auth::user()->id)
            ->select('contact.*', 'created_at')
        )
        ->orderBy('created_at','DESC')
        ->get()
        ->unique('id');


        $data = view('messages.contacts')->with(['contacts'=>$contacts,'opened'=>$request->chater])->render();
        return array("desc"=>"The messages has been updated.","success"=>true,"data"=>$data);
    }
}
