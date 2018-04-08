@extends('layouts.app')
@section('content')
<div style="display:inline-block">
    <a href='event/1'>
        <div class="outerBox dark eventWorkshopPanel">
            <div class="innerBox">
                <div class="leftBox">
                <img style="position:relative;border:none;border-radius:0;" src="{{asset('images/temp/tomhanks.jpg')}}">
                </div>
                <div class="rightBox">
                    <div class="tableCell">
                        <h1>Mashrou3 Tefl</h1>
                        <p style="text-align:center">Number of Forms: </p><br>
                        <p style="position:relative;z-index:100">Shwayet kalam 3n Shwayet kalam 3n l event</p>
                    </div>
                    <div class="rightBoxBackground">
                        @include('inc.logo')
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a href='event/2'>
        <div class="outerBox dark eventWorkshopPanel">
            <div class="innerBox">
                <div class="leftBox">
                <img style="position:relative;border:none;border-radius:0;" src="{{asset('images/temp/tomhanks.jpg')}}">
                </div>
                <div class="rightBox">
                    <div class="tableCell">
                        <h1>Mashrou3 Tefl</h1>
                        <p style="text-align:center">Number of Forms: </p><br>
                        <p style="position:relative;z-index:100">Shwayet kalam 3n Shwayet kalam 3n l event</p>
                    </div>
                    <div class="rightBoxBackground">
                        @include('inc.logo')
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a href='event/3'>
        <div class="outerBox dark eventWorkshopPanel">
            <div class="innerBox">
                <div class="leftBox">
                <img style="position:relative;border:none;border-radius:0;" src="{{asset('images/temp/tomhanks.jpg')}}">
                </div>
                <div class="rightBox">
                    <div class="tableCell">
                        <h1>Mashrou3 Tefl</h1>
                        <p style="text-align:center">Number of Forms: </p><br>
                        <p style="position:relative;z-index:100">Shwayet kalam 3n Shwayet kalam 3n l event</p>
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