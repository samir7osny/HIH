@extends('layouts.app')

@section('content')
{!! Form::open(['action' => ['UsersController@update', $user->username], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
    <input type="hidden" name="type" value="0">
    <div class="innerBox">
        <div class="leftBox">
            <div class="darkBackground">
                <div class="tableCell">
                    <div class="square">
                        <img id="userImage" src="/storage/usersImages/{{$user->photo_url}}" alt="">
                        <div class="inputImgHover"><span>Click To Edit</span></div>
                        <input type="file" accept="image/*" hidden name="userImage">
                    </div>
                    <div class="inputContainer name">
                        <input required class="requiredInput" value="{{$user->first_name}}" type="text" name="first_name">
                        <label class="" for="first_name">First Name</label>
                        <input required class="requiredInput" value="{{$user->last_name}}" type="text" name="last_name">
                        <label class="" for="last_name">Last Name</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">          
                <h2>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" disabled value="{{$user->username}}" type="text" name="username">
                            <label class="" for="username">Enter The Username</label>
                    </div>
                </h2>
                <hr>
                <h2>
                    <i class="fa fa-university" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <select required class="requiredInput" name="university">
                                <option value="0" disabled hidden>Choose The University</option>
                                @foreach ($universities as $university)
                                    <option @if ($university->id == $user->college->university->id)
                                                selected="selected"
                                            @endif
                                    value="{{$university->id}}">{{$university->name}}</option>
                                @endforeach
                            </select>
                    </div>
                </h2>
                <h2>
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <select required class="requiredInput" name="college">
                                <option value="0" disabled hidden>Choose The University First</option>
                                @foreach ($user->college->university->colleges as $college)
                                    <option @if ($college->id == $user->college->id)
                                            selected="selected"
                                            @endif
                                    value="{{$college->id}}">{{$college->name}}</option>
                                @endforeach
                            </select>
                    </div>
                </h2>
                <h2>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" value="{{$user->phone_number}}" type="text" name="phone_number">
                            <label class="" for="phone_number">Enter The Phone Number</label>
                    </div>
                </h2>
                <h2>
                    <i class="fa fa-address-book-o" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" value="{{$user->email}}" type="email" name="email">
                            <label class="" for="email">Enter The E-Mail</label>
                    </div>
                </h2>
                <h2>
                    <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <textarea contenteditable="true" name="about" class="CKEDITOR">{{$user->about}}</textarea>
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