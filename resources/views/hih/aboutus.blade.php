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
                <h2><i class="headerIcon fa fa-user" aria-hidden="true"></i>The President: {{$hih->president->user->first_name . " " .$hih->president->user->last_name }}</h2>
                <h2><i class="headerIcon fa fa-university" aria-hidden="true"></i>{{$hih->college->university->name}}</h2>
                <h2><i class="headerIcon fa fa-graduation-cap" aria-hidden="true"></i>{{$hih->college->name}}</h2>
                <h2><i class="headerIcon fa fa-calendar-check-o" aria-hidden="true"></i>Date Of Foundation: {{$hih->date_of_foundation}}</h2>
            </div>
            <div class="rightBoxBackground">
                    @include('inc.logo')
            </div>
        </div>
    </div>
</div>
@if ($hih->story != null)
<div style="overflow:hidden;" class="outerBox light windowHeight">
    <a href="/aboutus/edit" style="cursor:pointer; position:fixed; top:128px; right:50px; z-index:50"><button style="color:#DDD;cursor:pointer; padding:10px 20px;" onmouseover="this.style.color='rgba(37, 98, 63,1)';" 
        onmouseout="this.style.color='#DDD';">Edit</button></a>
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
    <a href="/aboutus/edit" style="cursor:pointer; position:fixed; top:128px; right:50px; z-index:50"><button style="color:#DDD;cursor:pointer; padding:10px 20px;" onmouseover="this.style.color='rgba(37, 98, 63,1)';" 
        onmouseout="this.style.color='#DDD';">Edit</button></a>
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

    <script src="{{ asset('js/hih-info.js') }}"></script>
@endsection