@extends('layouts.app')
@section('content')
{!! Form::open(['action' => ['WorkshopsController@update',  $workshop->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
    {{ csrf_field() }}
    <div class="innerBox">
        <div class="rightBox">
            <div class="tableCell">
                <h1>
                    <div class="inputContainer">
                        <input style="text-align:center;" disabled value="{{ $workshop->name }}" type="text" name="name">
                        <label class="" for="name">Enter The name</label>
                    </div>
                </h1>
                <table class="eventWorkshopInfo">
                    <tr>
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>Place</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ $workshop->place }}" type="text" name="place">
                                    <label class="" for="name">Enter The place address</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-money" aria-hidden="true"></i>Cost</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ $workshop->cost }}" type="number" name="cost">
                                    <label class="" for="name">Enter The cost</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-money" aria-hidden="true"></i>Place Cost</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ $workshop->place_cost }}" type="number" name="place_cost">
                                    <label class="" for="name">Enter The place cost</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-sticky-note" aria-hidden="true"></i>Description</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <textarea required class="requiredInput" name="description">{{ $workshop->description }}</textarea>
                                    <label class="" for="name">Enter The description</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-calendar" aria-hidden="true"></i>Timeline</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                <div class="timelineHeader">
                                    <div class="flexBox">
                                        <h5 class="date">Date</h5>
                                        <h5 class="time">From</h5>
                                        <h5 class="time">To</h5>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    
                                </div>
                                @foreach ($workshop->timelines as $timeline)
                                    <div class="timeline">
                                        <div class="flexBox">
                                            <input required class="requiredInput" value="{{$timeline->date_of_session}}" type="date" name="timelineDate[]">
                                            <input required class="requiredInput" value="{{ (new DateTime($timeline->from))->format('H:i') }}" type="time" name="timelineFrom[]">
                                            <input required class="requiredInput" value="{{ (new DateTime($timeline->to))->format('H:i') }}" type="time" name="timelineTo[]">
                                            <span class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                                            <span class="delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                            <td><i class="fa fa-users" aria-hidden="true"></i> Modirators</td>
                            <td class="modirators">
                                <div class="members">
                                    <div class="flexBox">
                                        <div class="member addMember addModirator">
                                            <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                                            </button></div>
                                        </div>
                                        @if($workshop->moderatedBy) 
                                            @foreach ($workshop->moderatedBy as $modirator)
                                                <a target="blank" class="member" href="/user/{{$modirator->user->username}}" m="{{$modirator->id}}">
                                                    <img src="/storage/usersImages/{{$modirator->user->photo_url}}" alt="{{$modirator->user->first_name . " " . $modirator->user->last_name}}">
                                                    <h3 class="tableCell">{{$modirator->user->first_name . " " . $modirator->user->last_name}}</h3>
                                                    <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                                    <input name="modirator[]" hidden type="integer" value="{{$modirator->id}}">
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
                                    @if ($workshop->cover_id)
                                        {{$workshop->cover->url}}
                                    @endif" hidden name="coverName">
                                <div class="flexBox">
                                    @foreach ($workshop->gallery as $photo)
                                        <div class="photo 
                                            @if ($workshop->cover_id == $photo->id)
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
                </table>
                <div class="sponsors">
                    @if ($workshop->Sponsors)
                        @foreach($workshop->Sponsors as $sponsor)
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
        </div>
    </div>
{!! Form::close() !!}
<div class="popUpWindow">
    <div class="search" class="dark">
        @include('inc.logo')
        <div class="inputContainer">
                <input placeholder="Search about member" type="text" name="searchKey">
        </div>
        <div class="members">
            <div class="results flexBox">

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
<script src="{{ asset('js/modirator.js') }}"></script>
<script src="{{ asset('js/sponsor.js') }}"></script>
@endsection