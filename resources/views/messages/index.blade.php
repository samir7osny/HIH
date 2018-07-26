@extends('layouts.app')
<?php
use Illuminate\Support\Facades\DB;
?>

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">   
        <div class="leftBox contactsBar">
            <div style="position:relative">
                    <input type="text" placeholder="Search about a contact" name="search">
                    <div class="contacts search">
                    
                    </div>
            </div>
            <hr class="green">
            <div class="contacts">
                @foreach ($contacts as $key=>$contact)
                    <?php
                        $lastM = DB::table('messages')->where('sender',$contact->id)->where('receiver',Auth::user()->id)->orderBy('created_at','DESC')->first();
                    ?>
                    <div class="contact
                    @if ($lastM != null && $lastM->seen==0)
                        unseen
                    @endif" u="{{$contact->id}}">
                        <img src="/storage/usersImages/{{$contact->photo_url}}" alt="">
                        <h2 class="tableCell">{{$contact->first_name . " " . $contact->last_name}}</h2>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rightBox" style="padding:0;display:block;">
            <div class="chat">
                @if (isset($chat))
                    @if ($count > $chat->count())
                        <button class="showMore">Show More</button>
                    @endif
                    @for ($i = $chat->count() - 1; $i >= 0 ; $i--)
                        <div class=" @if($chat[$i]->sender == Auth::user()->id) send @else receive @endif" m="{{$chat[$i]->id}}">
                            <p>{{$chat[$i]->content}}</p>
                            <span><i class="fa @if($chat[$i]->seen == 1) fa-check-square-o @else fa-square-o @endif " aria-hidden="true"></i>{{$chat[$i]->created_at}}</span>
                        </div>
                        <br>
                    @endfor
                @endif
            </div>
            <div class="messageInput">
                <input type="text" placeholder="Enter your message" name="message">
                <button><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/chat.js') }}"></script>
@endsection