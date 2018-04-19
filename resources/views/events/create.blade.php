@extends('layouts.app')
@section('content')
<div class="outerBox dark">
    <div class="innerBox">
        <div class="rightBox">
            <div class="tableCell">
                <input type="text" name="eventName" placeholder="Enter Event Name">
                <table class="eventWorkshopInfo">
                    <tr>
                        <td >From </td>
                        <td ><input type="time" name="from" placeholder="From"></td>
                    </tr>
                    <tr>
                        <td>To </td>
                        <td ><input type="time" name="to" placeholder="To"></td>
                    </tr>
                    <tr>
                        <td>Date </td>
                        <td ><input type="date" name="date" placeholder="Date"></td>
                    </tr>
                    <tr>
                        <td>Place </td>
                        <td ><input type="text" name="place" placeholder="Place"></td>
                    </tr>
                    <tr>
                        <td>Place Cost</td>
                        <td ><input type="number" name="place_cost" placeholder="Place Cost"></td>
                    </tr>
                    <tr>
                        <td>Description </td>
                        <td ><input type="text" name="description" placeholder="Description"></td>
                    </tr>
                </table>
                <div class="eventGallery">
                    <h2 style="font-size:2em;font-weight:bold;margin-left: 0;margin-bottom: 5px;">Gallery</h2>
                    <hr style="    width: 100%;margin:0;margin-bottom:29px">
                    <div class="eventGalleryImage">
                        <img src="{{asset('images/temp/tomhanks.jpg')}}"> 
                    </div>
                    <div class="eventGalleryImage">
                        <img src="{{asset('images/temp/tomhanks.jpg')}}">
                    </div>
                    <div class="eventGalleryImage">
                        <img src="{{asset('images/temp/tomhanks.jpg')}}">
                    </div>
                    <div class="eventGalleryImage">
                        <img src="{{asset('images/temp/tomhanks.jpg')}}">
                    </div>
                    <div class="eventGalleryImage">
                        <img src="{{asset('images/temp/tomhanks.jpg')}}">
                    </div>
                    <div class="eventGalleryImage">
                        <img src="{{asset('images/temp/tomhanks.jpg')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/event.js')}}"></script>
@endsection