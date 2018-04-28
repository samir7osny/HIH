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
                </table>
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
</div>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('js/activity.js') }}"></script>
@endsection