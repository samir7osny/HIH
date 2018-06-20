@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
        <div class="innerBox">
                <div class="rightBox">
                        <div class="tableCell">
                                <h1><a style="color:#bdb3f3;"
                                        onMouseOver="this.style.color='#7d68f3'"
                                        onMouseOut="this.style.color='#bdb3f3'" href="/user/{{$user->user->username}}">{{$user->user->first_name." " . $user->user->last_name}}</a> have enrolled in "{{$event->name}}" Event</h1>
                                @foreach ($event->questions as $question)
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <span>{{$question->question_content}}</span>
                                        <textarea style="border:0;" disabled placeholder="Enter your answer" contenteditable="true" name="answer[{{$question->id}}]" class="CKEDITOR">@if ($question->answer($user->id)){{$question->answer($user->id)}} @else No Answer @endif</textarea>
                                </div>
                                @endforeach
                        </div>
                        
                        <div class="rightBoxBackground">
                                @include('inc.logo')
                        </div>
                </div>
        </div>
</div>
<script src="{{ asset('js/form.js') }}"></script>
@endsection
