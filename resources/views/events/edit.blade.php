@extends('layouts.app')
@section('content')
{!! Form::open(['action' => ['EventsController@update',  $event->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
    {{ csrf_field() }}
    <div class="innerBox">
        <div class="rightBox">
            <div class="tableCell">
                <h1>
                    <div class="inputContainer">
                        <input style="text-align:center;" disabled value="{{ $event->name }}" type="text" name="name">
                        <label class="" for="name">Enter The name</label>
                    </div>
                </h1>
                <table class="eventWorkshopInfo">
                    <tr>
                        <td ><i class="fa fa-clock-o" aria-hidden="true"></i>From</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ (new DateTime($event->from))->format('H:i') }}" type="time" name="from">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-clock-o" aria-hidden="true"></i>To</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ (new DateTime($event->to))->format('H:i') }}" type="time" name="to">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Date</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ $event->date }}" type="date" name="date">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>Place</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ $event->place }}" type="text" name="place">
                                    <label class="" for="name">Enter The place address</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-money" aria-hidden="true"></i>Place Cost</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ $event->place_cost }}" type="number" name="place_cost">
                                    <label class="" for="name">Enter The place cost</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-sticky-note" aria-hidden="true"></i>Description</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <textarea required class="requiredInput" name="description">{{ $event->description }}</textarea>
                                    <label class="" for="name">Enter The description</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-microphone" aria-hidden="true"></i> Speakers</td>
                        <td class="speakers">
                            <div class="members">
                                <div class="flexBox">
                                    <div class="member addMember addSpeaker">
                                        <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                                        </button></div>
                                    </div>
                                    @if($event->Speakers) 
                                        @foreach ($event->Speakers as $speaker)
                                            <a target="blank" class="member" href="/speaker/{{$speaker->id}}" s="{{$speaker->id}}">
                                                <img src="/storage/speakersImages/{{$speaker->photo_url}}" alt="{{$speaker->title . ". " . $speaker->first_name . " " . $speaker->last_name}}">
                                                <h3 class="tableCell">{{$speaker->title . ". " . $speaker->first_name . " " . $speaker->last_name}}</h3>
                                                <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                                <input name="speaker[]" hidden type="integer" value="{{$speaker->id}}">
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-picture-o" aria-hidden="true"></i>Gallery</td>
                        <td>
                            <div class="gallery edit">
                                <input type="text" value="
                                    @if ($event->cover_id)
                                        {{$event->cover->url}}
                                    @endif" hidden name="coverName">
                                <div class="flexBox">
                                    @foreach ($event->gallery as $photo)
                                        <div class="photo 
                                            @if ($event->cover_id == $photo->id)
                                                cover
                                            @endif" name="{{$photo->url}}">
                                            <img src="/storage/activitiesGallery/{{$photo->url}}" class="galleryPhoto">
                                            <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                            <span class="makeCover"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                        </div>
                                    @endforeach
                                    {{--  --}}
                                    <div class="photo addPhoto">
                                        <div class="inputContainer Button fullHeight"><button type="button" class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                                        </button></div>
                                    </div>
                                    {{-- <input multiple type="file" id="gallery" accept="image/*" hidden name="gallery"> --}}
                                </div>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-question-circle" aria-hidden="true"></i>Questions</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                @if (count($event->questions) > 0) 
                                    @foreach ($event->questions as $question)
                                    <div q="{{$question->id}}" class="question">
                                        <div class="flexBox">
                                            <input required class="requiredInput" disabled value="{{$question->question_content}}" type="text" placeholder="Enter the question">
                                            <span style="cursor:initial;" class="req @if($question->required == 1) checked @endif">
                                            </span>
                                            <span class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                                            <span class="delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="question">
                                        <div class="flexBox">
                                            <input required class="requiredInput" disabled value="No questions!" type="text"  placeholder="Enter the question">
                                            <span class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></span>
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
                            <input name="sponsor[]" hidden type="integer" value="{{$sponsor->id}}"/>
                            <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                        </a>
                        @endforeach
                    @endif
                    <a class="member addMember addSponsor">
                        <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                        </button></div>
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="inputContainer submitInput">
                    <input type="submit" value="Submit">
                </div>
            </div>
            
            <div class="rightBoxBackground">
                @include('inc.logo')
            </div>
        </div>
    </div>
{!! Form::close() !!}
<div class="popUpWindow">
    <div class="search" class="dark">
        @include('inc.logo')
        <div class="inputContainer">
                <input placeholder="Search about speaker" type="text" name="searchKey">
        </div>
        <div class="members">
            <div class="results flexBox">
                <a target="blank" href="/speaker/create" class="member addMember">
                    <div class="inputContainer Button" style="height: inherit;">
                        <button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="popUpWindowSponsor">
    <div class="sponsorSearch" class="dark">
        @include('inc.logo')
        <div class="inputContainer">
                <input placeholder="Search about sponsor" type="text" name="searchKey">
        </div>
        <div class="members">
            <div class="results flexBox">
                <a target="blank" href="/sponsor/create" class="member addMember">
                    <div class="inputContainer Button" style="height: inherit;">
                        <button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('js/activity.js') }}"></script>
<script src="{{ asset('js/speaker.js') }}"></script>
<script src="{{ asset('js/sponsor.js') }}"></script>
@endsection