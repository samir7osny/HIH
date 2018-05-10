@extends('layouts.app')
@section('content')
<div class="outerBox windowHeight">
    @if($workshop)
        <div class="innerBox">
            <div class="rightBox">
                <div class="tableCell">
                    <h1>
                        {{$workshop['name']}}
                        <p style="font-size:0.4em;text-align:center">Number of Forms: {{$workshop->Audience()->count()}}</p>
                    </h1>
                    <div class="inputContainer Button between">
                        @if(Auth::user()->type==1)
                        {!! Form::open(['action' => ['WorkshopsController@enroll',$workshop->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                            {{ csrf_field() }}
                            {{Form::submit('Enroll',['class'=>'enroll'])}}
                        {!! Form::close() !!}
                        @endif
                        <a href="/workshop/{{$workshop['name']}}/edit"><button >Edit</button></a>
                        <button class="delete">Delete</button>
                    </div>
                    <table class="eventWorkshopInfo">
                        <tr>
                            <td><i class="fa fa-map-marker" aria-hidden="true"></i> Place</td>
                            <td>{{$workshop['place']}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-money" aria-hidden="true"></i> Place Cost</td>
                            <td>{{$workshop['place_cost']}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-money" aria-hidden="true"></i> Place Cost</td>
                            <td>{{$workshop['cost']}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-sticky-note" aria-hidden="true"></i> Description</td>
                            <td>{{$workshop['description']}}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i>Timeline</td>
                            <td>
                                <div class="timelineHeader">
                                    <div class="flexBox">
                                        <h5 class="date">Date</h5>
                                        <h5 class="time">From</h5>
                                        <h5 class="time">To</h5>
                                    </div>
                                </div>
                                @foreach ($workshop->timelines as $timeline)
                                    <div class="timeline">
                                        <div class="flexBox">
                                            <h4 class="date">{{$timeline->date_of_session}}</h4>
                                            <h4 class="time">{{$timeline->from}}</h4>
                                            <h4 class="time">{{$timeline->to}}</h4>
                                        </div>
                                    </div>
                                @endforeach    
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-picture-o" aria-hidden="true"></i> Gallery</td>
                            <td>
                                <div class="panelContainer" panel='panel'>
                                    <div class="panel">
                                        @for ($i = $workshop->gallery->count() - 1; $i >= 0 ; $i--)
                                            <div class="panelItem" style="background-image:url('/storage/activitiesGallery/{{$workshop->gallery[$i]->url}}');"></div>
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
                                    @foreach ($workshop->gallery as $photo)
                                        <img src="{{asset('/storage/activitiesGallery/'.$photo->url)}}">
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @else
            <h1>No Workshop found with this name </h1>
    @endif
</div>
<div class="popUpWindow">
    <div class="confirmationPopup">
        <h1>Confirm</h1>
        <p>Do you want to delete "{{ $workshop->name }}"  workshop? </p>
        <div class="inputContainer Button between">
                {!! Form::open(['action' => ['WorkshopsController@destroy', $workshop->id], 'method' => 'POST']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    <button class="delete confirmYes">Confirm</button>
                {!! Form::close() !!}
                <button class="confirmCancel">Cancel</button>
        </div>
    </div>
</div>
<script src="{{asset('js/panelCreator.js')}}"></script>
<script>addPanelS()</script>
@endsection