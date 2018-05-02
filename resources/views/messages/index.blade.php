@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox fullHeight">   
        <div class="leftBox contactsBar">
            <div style="position:relative">
                    <input type="text" placeholder="Search about a contact" name="search">
                    <div class="contacts search">
                    
                    </div>
            </div>
            <hr class="green">
            <div class="contacts">
                @foreach ($contacts as $contact)
                    <div class="contact" u="{{$contact->id}}">
                        <img src="/storage/usersImages/{{$contact->photo_url}}" alt="">
                        <h2 class="tableCell">{{$contact->first_name . " " . $contact->last_name}}</h2>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rightBox" style="padding:0">
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