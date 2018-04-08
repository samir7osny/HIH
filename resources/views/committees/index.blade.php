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
            @foreach ($committees[$i]->members as $member)
                <a href="/user/{{$member->user->username}}" id="{{$member->id}}" class="member @if ($committees[$i]->head && $committees[$i]->head->id == $member->id)
                    head
                    @endif ">
                    <img src="/storage/usersImages/{{$member->user->photo_url}}" alt="{{$member->user->first_name . " " . $member->user->last_name}}">
                    <h3 class="tableCell">{{$member->user->first_name . " " . $member->user->last_name}}</h3>
                    <span class="headButton"><i class="fa fa-header" aria-hidden="true"></i></span>
                    <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                </a>
            @endforeach
            <div class="member addMember">
                <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                </button></div>
                    <div class="chooseMember dropdown">
                            
                    </div>
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