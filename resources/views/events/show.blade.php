@extends('layouts.app')
@section('content')
<div class="outerBox windowHeight">
    @if($event)
        <div class="innerBox">
            <div class="rightBox">
                <div class="tableCell">
                    <h1>
                        {{$event['name']}}
                        <p style="font-size:0.4em;text-align:center">Number of Forms: {{$event->Audience()->count()}}</p>
                    </h1>
                    <div class="inputContainer Button between">
                        @if(Auth::user()->type==1)
                            {!! Form::open(['action' => ['EventsController@enroll',$event->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                                {{ csrf_field() }}
                                {{Form::submit('Enroll',['class'=>'enroll'])}}
                            {!! Form::close() !!}
                        @endif
                        <a href="/event/{{$event['name']}}/edit"><button >Edit</button></a>
                        <button class="delete">Delete</button>
                    </div>
                    <table class="eventWorkshopInfo">
                        <tr>
                            <td ><i class="fa fa-clock-o" aria-hidden="true"></i> From</td>
                            <td>{{\Carbon\Carbon::createFromFormat('H:i:s',$event['from'])->format('h:i A')}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-clock-o" aria-hidden="true"></i> To</td>
                            <td>{{\Carbon\Carbon::createFromFormat('H:i:s',$event['to'])->format('h:i A')}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Date</td>
                            <td>{{$event['date']}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-map-marker" aria-hidden="true"></i> Place</td>
                            <td>{{$event['place']}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-money" aria-hidden="true"></i> Place Cost</td>
                            <td>{{$event['place_cost']}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-sticky-note" aria-hidden="true"></i> Description</td>
                            <td>{{$event['description']}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-picture-o" aria-hidden="true"></i> Gallery</td>
                            <td>
                                <div class="panelContainer" panel='panel'>
                                    <div class="panel">
                                        @for ($i = $event->gallery->count() - 1; $i >= 0 ; $i--)
                                            <div class="panelItem" style="background-image:url('/storage/activitiesGallery/{{$event->gallery[$i]->url}}');"></div>
                                        @endfor
                                        <div class="panelControl">
                                            <span class="panelPause">
                                                <i class="fa fa-pause" aria-hidden="true"></i>
                                            </span>
                                            <span class="panelPlay">
                                                <i class="fa fa-play" aria-hidden="true"></i>
                                            </span>
                                            <div class="panelControlArrows">
                                                <span class="panelArrow panelLeftArrow">
                                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                                </span>
                                                <span class="panelArrow panelRightArrow">
                                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <span class="panelTimer">
                                                <span></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="gallery flexBox">
                                    @foreach ($event->gallery as $photo)
                                        <img src="{{asset('/storage/activitiesGallery/'.$photo->url)}}">
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="innerBox members" style="display:block;margin-top:50px">
                        <div class="flexBox">
                            @if($event->Sponsors) 
                                @foreach ($event->Sponsors as $sponsor)
                                    <a href="/sponsor/{{$sponsor->id}}" id="{{$sponsor->id}}">
                                        <img src="/storage/sponsorsImages/{{$sponsor->photo_url}}" alt="{{$sponsor->name}}">
                                        <h3 class="tableCell">{{$sponsor->name}}</h3>
                                        <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                    </a>
                                @endforeach
                            @endif
                            <div class="member addMember">
                                <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                                </button></div>
                                    <div class="chooseMember dropdown">
                                            
                                    </div>
                            </div>
                        </div>
                    </div>    
                </div>
            
                <div class="rightBoxBackground">
                    @include('inc.logo')
                </div>
            </div>
        </div>
    @else
            <h1>No Event found with this name </h1>
    @endif
</div>
<div class="popUpWindow">
    <div class="confirmationPopup">
        <h1>Confirm</h1>
        <p>Do you want to delete "{{ $event->name }}"  event? </p>
        <div class="inputContainer Button between">
                {!! Form::open(['action' => ['EventsController@destroy', $event->id], 'method' => 'POST']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    <button class="delete confirmYes">Confirm</button>
                {!! Form::close() !!}
                <button class="confirmCancel">Cancel</button>
        </div>
    </div>
</div>
<script src="{{asset('js/event.js')}}"></script>
<script src="{{asset('js/panelCreator.js')}}"></script>
<script>addPanelS()</script>
@endsection