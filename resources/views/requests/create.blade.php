@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'RequestsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
        @csrf
        <div class="innerBox">
                <div class="rightBox">
                        <div class="tableCell">
                                @if (isset($userToDelete))
                                    <input type="text" hidden name="userid" value="{{$userToDelete->id}}">
                                    <h1>Why you want to delete "{{$userToDelete->first_name . " " . $userToDelete->last_name}}" profile ?</h1>
                                    <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                            <textarea contenteditable="true" name="content" class="CKEDITOR"></textarea>
                                            <label class="" for="content">content</label>
                                            {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                                    </div>
                                    <div class="inputContainer fullWidth submitInput">
                                            <input type="submit" style="margin-top: 30px;" value="Send Request">
                                    </div>
                                @else
                                    <h1>No thing to show !</h1>
                                @endif
                        </div>
                        
                        <div class="rightBoxBackground">
                                @include('inc.logo')
                        </div>
                </div>
        </div>
{!! Form::close() !!}
<script src="{{ asset('js/form.js') }}"></script>
@endsection
