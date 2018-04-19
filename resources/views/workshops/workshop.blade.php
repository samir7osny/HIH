@extends('layouts.app') @section('content')

<div class="outerBox dark">
    <div class="innerBox">
        <div class="leftBox">
            <img style="position:relative;border:none;border-radius:0;" src="{{asset('images/temp/tomhanks.jpg')}}">
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h1>Arduino</h1>
                <table class="eventWorkshopInfo">
                    <tr>
                        <td>From </td>
                        <td>3:00PM</td>
                    </tr>
                    <tr>
                        <td>To </td>
                        <td>7:00PM</td>
                    </tr>
                    <tr>
                        <td>Place </td>
                        <td>L dwe2a</td>
                    </tr>
                    <tr>
                        <td>Place Cost</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td>Cost</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td>Description </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
                <div class="inputContainer Button">
                    <button class="workshopTimelineButton">Timeline</button>
                    <button class="workshopEnrollButton">Enroll</button>
                    <button>Delete</button>
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo')
            </div>
        </div>
    </div>
</div>
<div class="popUpWindow">
    <div class="workshopTimeline">
        <div class="workshopTimelineRow">
            <div class="workshopTimelineColumn">
                <h1>Session #</h1>
            </div>
            <div class="workshopTimelineColumn">
                <h1>Date</h1>
            </div>
            <div class="workshopTimelineColumn">
                <h1>From</h1>
            </div>
            <div class="workshopTimelineColumn">
                <h1>To</h1>
            </div>
        </div>
        <div class="workshopTimelineRow">
            <div class="workshopTimelineColumn">
                1
            </div>
            <div class="workshopTimelineColumn">
                12/5/2018
            </div>
            <div class="workshopTimelineColumn">
                9:00 AM
            </div>
            <div class="workshopTimelineColumn">
                9:00 PM
            </div>
        </div>
        <div class="workshopTimelineRow">
            <div class="workshopTimelineColumn">
                1
            </div>
            <div class="workshopTimelineColumn">
                12/5/2018
            </div>
            <div class="workshopTimelineColumn">
                9:00 AM
            </div>
            <div class="workshopTimelineColumn">
                9:00 PM
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/workshop.js') }}"></script>
@endsection