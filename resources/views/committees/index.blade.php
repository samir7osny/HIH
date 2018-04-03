@extends('layouts.app')

@section('content')
@for ($i = 0; $i < count($committees); $i++)
<div class="outerBox 
@if ($i%2 == 0)
    dark
@else
    light
@endif" committee="{{$committees[$i]->id}}" >
    <div class="innerBox haveSlide">
        <div class="leftBox">
            <div class="tableCell">
                <h1 class="data" placeholder="Enter the name" name="name">{{$committees[$i]->name}}</h1>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h1>Description</h1>
                <p name="description" placeholder="Enter the description" class="data">{!!$committees[$i]->description!!}</p>
                <div class="inputContainer Button">
                    <button class="edit">Edit</button>
                    <button class="membersButton">Members</button>
                    <button class="delete">Delete</button>
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo')
            </div>
        </div>
    </div>
    <div class="innerBox members" style="display:block">
        <div class="flexBox">
            @if ($committees[$i]->head != null)
                <div class="member head">
                    <img src="{{asset('images/temp/tomhanks.jpg')}}" alt="{{$committees[$i]->head->first_name . " " . $committees[$i]->head->last_name}}">
                    <h3 class="tableCell">{{$committees[$i]->head->first_name . " " . $committees[$i]->head->last_name}}</h3>
                    <span><i class="fa fa-header" aria-hidden="true"></i></span>
                </div>
            @endif
            @foreach ($committees[$i]->members as $member)
                @if ($committees[$i]->head->id != $member->id)
                    <div class="member">
                        <img src="{{asset('images/temp/tomhanks.jpg')}}" alt="{{$member->first_name . " " . $member->last_name}}">
                        <h3 class="tableCell">{{$member->first_name . " " . $member->last_name}}</h3>
                    </div>
                @endif
            @endforeach
            <div class="member">
                <div class="inputContainer Button addMember"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                </button></div>
            </div>
        </div>
    </div>
</div>
@endfor
<div class="inputContainer Button"><button class="add"><i class="fa fa-plus-square" aria-hidden="true"></i>
</button></div>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/committees.js') }}"></script>

@endsection