@extends('layouts.app')


@section('content')
<div class="outerBox dark windowHeight">
        <a href="/aboutus/edit" style="cursor:pointer; position:fixed; top:128px; right:50px; z-index:50"><button style="color:#DDD;cursor:pointer; padding:10px 20px;" onmouseover="this.style.color='rgba(37, 98, 63,1)';" 
            onmouseout="this.style.color='#DDD';">Edit</button></a>
        <div class="innerBox">
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
    <div class="outerBox light windowHeight">
        <div class="innerBox">
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