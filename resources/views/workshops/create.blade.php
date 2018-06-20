@extends('layouts.app')
@section('content')
{!! Form::open(['action' => 'WorkshopsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
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
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>Place</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input required class="requiredInput" value="{{ old('place') }}" type="text" name="place">
                                    <label class="" for="name">Enter The place address</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-money" aria-hidden="true"></i>Cost</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input value="{{ old('cost') }}" type="number" name="cost">
                                    <label class="" for="name">Enter The cost</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-money" aria-hidden="true"></i>Place Cost</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <input value="{{ old('place_cost') }}" type="number" name="place_cost">
                                    <label class="" for="name">Enter The place cost</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-sticky-note" aria-hidden="true"></i>Description</td>
                        <td>
                            <div class="inputContainer fullWidth">
                                    <textarea required class="requiredInput" name="description">{{ old('description') }}</textarea>
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
                                <div class="timeline">
                                    <div class="flexBox">
                                        <input required class="requiredInput" type="date" name="timelineDate[]">
                                        <input required class="requiredInput" type="time" name="timelineFrom[]">
                                        <input required class="requiredInput" type="time" name="timelineTo[]">
                                        <span class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                                        <span class="delete"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                    </div>
                                </div>
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
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-picture-o" aria-hidden="true"></i>Gallery</td>
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