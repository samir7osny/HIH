@extends('layouts.app')
@section('content')
<div class="outerBox dark">
    @if($event->count()!=0)
        <div class="innerBox">
            <div class="rightBox">
                <div class="tableCell">
                    <h1>
                        {{$event['name']}}
                        <p style="font-size:0.4em;text-align:center">Number of Forms: {{$event->Audience()->count()}}</p>
                    </h1>
                    <table class="eventWorkshopInfo">
                        <tr>
                            <td >From </td>
                            <td>{{substr($event['from'],11,5)}}</td>
                        </tr>
                        <tr>
                            <td>To </td>
                            <td>{{substr($event['to'],11,5)}}</td>
                        </tr>
                        <tr>
                            <td>Date </td>
                            <td>{{$event['date']}}</td>
                        </tr>
                        <tr>
                            <td>Place </td>
                            <td>{{$event['place']}}</td>
                        </tr>
                        <tr>
                            <td>Place Cost</td>
                            <td>{{$event['place_cost']}}</td>
                        </tr>
                        <tr>
                            <td>Description </td>
                            <td>{{$event['description']}}</td>
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
                    <div class="inputContainer Button">
                        <button class="eventEnrollButton">Enroll</button>
                        {!! Form::open(['action'=>['EventsController@destroy',$event['id']],'onsubmit'=>'return confirm("Do you want to delete this event?");','method'=>'POST'])!!}    
                            {{Form::submit('Delete',['id'=>'555','class'=>'delete'])}}
                            {!!Form::hidden('_method','DELETE')!!}
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    @else
            <h1>No Event found with this name </h1>
    @endif
</div>
<div class="popUpWindow">
</div>
<script src="{{asset('js/event.js')}}"></script>
@endsection