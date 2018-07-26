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
                        <div style="font-size:0.4em;text-align:center" class="rateBar" totalValue="{{ sprintf('%4.2f', ($event->totalRate())*100.0/5.0) }}%">
                            <div class="bar" style="width:{{ sprintf('%4.2f', ($event->totalRate())*100.0/5.0) }}%">
                                @include('inc.RateB')
                            </div>
                            @include('inc.RateS')
                        </div>
                        <p class="userRate" style="font-size:0.4em;text-align:center"> @if (Auth::check() && $event->isGuestRate(Auth::user()->id)) You give it <span>{{round(($event->guestRate(Auth::user()->id))*10.0)/10.0}}</span>/5 @endif</p>
                    </h1>
                    <div class="inputContainer Button between">
                        @if (\App\User::havePermission(['GUEST']))
                            @if (Auth::check() && $event->enrolled(Auth::user()->id) && count($event->questions) == 0)
                                <button>Enrolled</button>
                            @elseif (Auth::check() && $event->enrolled(Auth::user()->id))
                                <a href="/event/{{$event['name']}}/enroll"><button >Enroll Form</button></a>
                            @else
                                <a href="/event/{{$event['name']}}/enroll"><button >Enroll</button></a>
                            @endif
                        @endif
                        @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','BOARD','MEMBER']))
                        <a href="/event/{{$event['name']}}/audience"><button >Audience</button></a>
                        @endif
                        @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','TYPE_HEAD','MK']))
                        <a href="/event/{{$event['name']}}/edit"><button >Edit</button></a>
                        <button class="delete">Delete</button>
                        @endif
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
                            <td>{!!nl2br($event['description'])!!}</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-microphone" aria-hidden="true"></i> Speakers</td>
                            <td>
                                <div class="members">
                                    <div class="flexBox">
                                        @if($event->Speakers) 
                                            @foreach ($event->Speakers as $speaker)
                                                <a target="blank" class="member" href="/speaker/{{$speaker->id}}" s="{{$speaker->id}}">
                                                    <img src="/storage/speakersImages/{{$speaker->photo_url}}" alt="{{$speaker->title . ". " . $speaker->first_name . " " . $speaker->last_name}}">
                                                    <h3 class="tableCell">{{$speaker->title . ". " . $speaker->first_name . " " . $speaker->last_name}}</h3>
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </td>
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
                        <tr>
                            <td><i class="fa fa-question-circle" aria-hidden="true"></i> Questions</td>
                            <td>
                                <div class="inputContainer fullWidth">
                                    @if (count($event->questions) > 0) 
                                        @foreach ($event->questions as $question)
                                        <div q="{{$question->id}}" class="question">
                                            <div class="flexBox">
                                                <input required class="requiredInput" disabled value="{{$question->question_content}}" type="text" placeholder="Enter the question">
                                                <span style="cursor:initial;" class="req @if($question->required == 1) checked @endif">
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="question">
                                            <div class="flexBox">
                                                <input required class="requiredInput" disabled value="No questions!" type="text"  placeholder="Enter the question">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <div class="sponsors">
                        @if ($event->Sponsors)
                            @foreach($event->Sponsors as $sponsor)
                            <a target="blank" href="/sponsor/{{$sponsor->id}}" class="member" s="{{$sponsor->id}}">
                                <img src="{{asset('/storage/sponsorsImages/'.$sponsor->photo_url)}}"/>
                            </a>
                            @endforeach
                        @endif
                    </div>
                    <div class="clearfix"></div>
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
@if (\App\User::havePermission(['GUEST']) && 
    (\App\EventEnrollment::where('event_id', $event->id)->where('guest_id', Auth::user()->userInfo->id)->first()))
<script src="{{asset('js/event.js')}}"></script>
@endif
<script src="{{asset('js/panelCreator.js')}}"></script>
<script>addPanelS()</script>
@endsection