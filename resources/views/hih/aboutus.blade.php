@extends('layouts.app')


@section('content')
<div style="overflow:hidden;" class="outerBox dark windowHeight">
    <div class="innerBox" style="overflow:initial;">
        <div class="leftBox">
            <img src="vision.jpg" alt="" class="fullArea">
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h2><i class="headerIcon fa fa-user" aria-hidden="true"></i>The Founder: {{$hih->founder}}</h2>
                <h2><i class="headerIcon fa fa-university" aria-hidden="true"></i>{{$hih->college->university->name}}</h2>
                <h2><i class="headerIcon fa fa-graduation-cap" aria-hidden="true"></i>{{$hih->college->name}}</h2>
                <h2><i class="headerIcon fa fa-calendar-check-o" aria-hidden="true"></i>Date Of Foundation: {{$hih->date_of_foundation}}</h2>
                <h2>
                    <span style="text-align:center; display:block;">Our President</span> 
                    <div class="members">
                        <div class="flexBox">
                            <a target="blank" class="member" href="/user/mosalah">
                                <img src="/storage/usersImages/{{$hih->president->user->photo_url}}" alt="{{$hih->president->user->first_name . " " . $hih->president->user->last_name}}">
                                <h3 class="tableCell">{{$hih->president->user->first_name . " " . $hih->president->user->last_name}}</h3>
                            </a>
                        </div>
                    </div>
                </h2>
                @if (App\Highboard::count() != 0)
                <h2>
                    <span style="text-align:center; display:block;">Our Highboard</span> 
                    <div class="members">
                        <div class="flexBox">
                            @foreach (App\Highboard::all() as $highboard)
                            <a target="blank" class="member" href="/user/{{$highboard->memberInfo->user->username}}">
                                <img src="/storage/usersImages/{{$highboard->memberInfo->user->photo_url}}" alt="{{$highboard->memberInfo->user->first_name . " " . $highboard->memberInfo->user->last_name}}">
                                <h3 class="tableCell">{{$highboard->memberInfo->user->first_name . " " . $highboard->memberInfo->user->last_name}}</h3>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </h2>
                @endif
            </div>
            <div class="rightBoxBackground">
                    @include('inc.logo')
            </div>
        </div>
    </div>
</div>
@if ($hih->story != null)
<div style="overflow:hidden;" class="outerBox light windowHeight">
    <div class="innerBox" style="overflow:initial;">
        <div class="leftBox">
            <img src="mission.jpg" alt="" class="fullArea">
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h1>Our Story</h1>
                <p style="font-size:1.5em;">{!!str_replace("\n","<br>",$hih->story)!!}</p>
            </div>
            <div class="rightBoxBackground">
                    @include('inc.logo')
            </div>                
        </div>
    </div>
</div>
@endif
<div style="overflow:hidden;" class="outerBox @if ($hih->story != null) dark @else light @endif windowHeight">
    <div class="buttons" style="cursor:pointer; position:fixed; top:128px; right:50px; z-index:100">
        @if (\App\User::havePermission(['PRESIDENT']))
        <a href="/aboutus/edit"><button style="color:#DDD;cursor:pointer; padding:10px 20px;" onmouseover="this.style.color='rgba(37, 98, 63,1)';" 
            onmouseout="this.style.color='#DDD';">Edit</button></a>
        <a class="changePresident"><button style="color:#DDD;cursor:pointer; padding:10px 20px;" onmouseover="this.style.color='rgba(37, 98, 63,1)';" 
            onmouseout="this.style.color='#DDD';">Change The President</button></a>
        @endif
    </div>
    <div class="innerBox" style="overflow:initial;">
        <div class="leftBox">
            <img src="mission.jpg" alt="" class="fullArea">
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h1>Our Mission</h1>
                <p style="font-size:1.5em;">{!!str_replace("\n","<br>",$hih->mission)!!}</p>
            </div>
            <div class="rightBoxBackground">
                    @include('inc.logo')
            </div>                
        </div>
    </div>
</div>
<div style="overflow:hidden;" class="outerBox @if ($hih->story != null) light @else dark @endif windowHeight">
    <div class="innerBox" style="overflow:initial;">
        <div class="leftBox">
            <img src="vision.jpg" alt="" class="fullArea">
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h1>Our Vision</h1>
                <p style="font-size:1.5em;">{!!str_replace("\n","<br>",$hih->vision)!!}</p>
            </div>
            <div class="rightBoxBackground">
                    @include('inc.logo')
            </div>
        </div>
    </div>
</div>
<div class="popUpWindow">
    <div class="search" class="dark">
        @include('inc.logo')
        <div class="inputContainer">
                <input placeholder="Search about member" type="text" name="searchKey">
        </div>
        <div class="members">
            <div class="results flexBox">

            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/hih-info.js') }}"></script>
@endsection