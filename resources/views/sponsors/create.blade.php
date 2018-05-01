@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'SponsorsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
    <input type="hidden" name="type" value="0">
    <div class="innerBox">
        <div class="leftBox">
            <div class="darkBackground">
                <div class="tableCell">
                    <div class="square">
                        <img id="userImage" src="/storage/sponsorsImages/sponsor.jpg" alt="">
                        <div class="inputImgHover" id="inputImgHover"><span>Click To Edit</span></div>
                        <input type="file" accept="image/*" hidden name="userImage">
                        <span>@include('inc.money')</span>
                    </div>
                    <div class="inputContainer name">
                        <input required class="requiredInput" value="{{ old('name') }}" type="text" name="name">
                        <label class="" for="name">Name</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">
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
                            <label class="" for="about">about</label>
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