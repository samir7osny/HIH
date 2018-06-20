@extends('layouts.app')
@section('content')
{!! Form::open(['action' => 'EventsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
    {{ csrf_field() }}
    <div class="innerBox">
        <div class="rightBox">
            <div class="tableCell">
                <h1>
                    <div class="inputContainer">
                        <input style="text-align:center;" required class="requiredInput" value="{{ old('name') }}" type="text" name="name">
                        <label class="" for="name">Enter The name</label>
                    </div>
                </h1>
                <table class="eventWorkshopInfo">
                    <tr>
                        <td ><i class="fa fa-clock-o" aria-hidden="true"></i> From</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required value="18:00" class="requiredInput" value="{{ old('from') }}" type="time" name="from">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-clock-o" aria-hidden="true"></i> To</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required value="20:00" class="requiredInput" value="{{ old('to') }}" type="time" name="to">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Date</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ old('date') }}" type="date" name="date">
                                    <script>
                                        // Set the date input default value
                                        $('input[type="date"]').get(0).valueAsDate = new Date((new Date()).getTime() + 7*24*60*60*1000);
                                    </script>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i> Place</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ old('place') }}" type="text" name="place">
                                    <label class="" for="name">Enter The place address</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-money" aria-hidden="true"></i> Place Cost</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ old('place_cost') }}" type="number" name="place_cost">
                                    <label class="" for="name">Enter The place cost</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-sticky-note" aria-hidden="true"></i> Description</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <textarea required class="requiredInput" name="description">{{ old('description') }}</textarea>
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
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-picture-o" aria-hidden="true"></i> Gallery</td>
                        <td>
                            <div class="gallery edit">
                                <input type="text" hidden name="coverName">
                                <div class="flexBox">
                                    {{-- <div class="photo">
                                        <img src="/images/temp/tomhanks.jpg" class="galleryPhoto" id="cover">
                                        <div class="inputImgHover"><span>Click To Edit</span></div>
                                        <input type="file" accept="image/*" hidden name="galleryPhoto[]">
                                        <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                        <span class="makeCover"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                    </div> --}}
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
                                    <div class="question">
                                        <div class="flexBox">
                                            <input required class="requiredInput" type="text" name="question[]" placeholder="Enter the question">
                                            <span class="req" onclick="$(this).find('input').val($(this).find('input').val() === '1' ? '0' : '1'); $(this).toggleClass('checked');">
                                                <input style="display:none;" hidden type="text" value="0" name="req[]" {{ old('req[]') ? 'checked' : '' }}>
                                            </span>
                                            <span class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                                            <span class="delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                </table>
                <div class="sponsors">
                    <div class="member addMember addSponsor">
                        <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                        </button></div>
                    </div>
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