@extends('layouts.app')
@section('content')
<div style="display:inline-block">
    <a href='workshop/1'>
        <div class="outerBox dark eventWorkshopPanel">
            <div class="innerBox">
                <div class="leftBox">
                <img style="position:relative;border:none;border-radius:0;" src="{{asset('images/temp/tomhanks.jpg')}}">
                </div>
                <div class="rightBox">
                    <div class="tableCell">
                        <h1>Arduino</h1>
                        <p style="text-align:center">Number of Sessions: </p><br>
                        <p style="position:relative;z-index:100">Hint about the workshop</p>
                    </div>
                    <div class="rightBoxBackground">
                        @include('inc.logo')
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a href='workshop/2'>
        <div class="outerBox dark eventWorkshopPanel">
            <div class="innerBox">
                <div class="leftBox">
                <img style="position:relative;border:none;border-radius:0;" src="{{asset('images/temp/tomhanks.jpg')}}">
                </div>
                <div class="rightBox">
                    <div class="tableCell">
                        <h1>Web Design</h1>
                        <p style="text-align:center">Number of Sessions: </p><br>
                        <p style="position:relative;z-index:100">Hint about the workshop</p>
                    </div>
                    <div class="rightBoxBackground">
                        @include('inc.logo')
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a href='workshop/3'>
        <div class="outerBox dark eventWorkshopPanel">
            <div class="innerBox">
                <div class="leftBox">
                <img style="position:relative;border:none;border-radius:0;" src="{{asset('images/temp/tomhanks.jpg')}}">
                </div>
                <div class="rightBox">
                    <div class="tableCell">
                        <h1>Project Management</h1>
                        <p style="text-align:center">Number of Sessions: </p><br>
                        <p style="position:relative;z-index:100">Hint about the workshop</p>
                    </div>
                    <div class="rightBoxBackground">
                        @include('inc.logo')
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
@endsection