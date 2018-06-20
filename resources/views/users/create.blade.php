@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'UsersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
    <input type="hidden" name="type" value="{{$type}}">
    <div class="innerBox">
        <div class="leftBox">
            <div class="darkBackground">
                <div class="tableCell">
                    <div class="square">
                        <img id="userImage" src="/storage/usersImages/user.jpg" alt="">
                        <div class="inputImgHover" id="inputImgHover"><span>Click To Edit</span></div>
                        <input type="file" accept="image/*" hidden name="userImage">
                    </div>
                    <div class="inputContainer name">
                        <input required class="requiredInput" value="{{ old('first_name') }}" type="text" name="first_name">
                        <label class="" for="first_name">First Name</label>
                        <input required class="requiredInput" value="{{ old('last_name') }}" type="text" name="last_name">
                        <label class="" for="last_name">Last Name</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">          
                <h2>
                    <i class="headerIcon fa fa-user" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" value="{{ old('username') }}" type="text" name="username" onkeyup="(function(e){e.value=e.value.toLowerCase();})(this)">
                            <label class="" for="username">Enter The Username</label>
                    </div>
                </h2>
                <h2>
                    <i class="headerIcon fa fa-key" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" minlength="8" maxlength="16" type="password" name="password">
                            <label class="" for="username">Enter The Password</label>
                    </div>
                </h2>
                <h2>
                    <i class="headerIcon fa fa-key" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" type="password" name="password_confirmation">
                            <label class="" for="password_confirmation">Enter The Password Again</label>
                    </div>
                </h2>
                <hr>
                <h2>
                    <i class="headerIcon fa fa-university" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <select required class="requiredInput" name="university">
                                <option value="0" selected disabled hidden>Choose The University</option>
                                @foreach ($universities as $university)
                                    <option value="{{$university->id}}">{{$university->name}}</option>
                                @endforeach
                            </select>
                    </div>
                </h2>
                <h2>
                    <i class="headerIcon fa fa-graduation-cap" aria-hidden="true"></i>
                    <div class="inputContainer">
                        <select required class="requiredInput" name="college">
                            <option value="0" selected disabled hidden>Choose The University First</option>
                        </select>
                    </div>
                </h2>
                @if ($type == 1)
                <h2>
                    <i class="headerIcon fa fa-calendar" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" value="{{ old('year_of_graduation') }}" type="number" name="year_of_graduation">
                            <label class="" for="year_of_graduation">Enter The Year Of Graduation</label>
                    </div>
                </h2>
                @endif
                <h2>
                    <i class="headerIcon fa fa-phone" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" value="{{ old('phone_number') }}" type="text" name="phone_number">
                            <label class="" for="phone_number">Enter The Phone Number</label>
                    </div>
                </h2>
                <h2>
                    <i class="headerIcon fa fa-address-book-o" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" value="{{ old('email') }}" type="email" name="email">
                            <label class="" for="email">Enter The E-Mail</label>
                    </div>
                </h2>
                <h2>
                    <i class="headerIcon fa fa-sticky-note-o" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <textarea contenteditable="true" name="about" class="CKEDITOR"></textarea>
                            <label class="" for="email">about</label>
                            {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                    </div>
                </h2>
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
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
@endsection