@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'HomeController@update', 'method' => 'Put', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
        @csrf
        <div class="innerBox">
                <div class="rightBox">
                        <div class="tableCell">
                                <h1>Edit the about information.</h1>
                                {{-- <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <select required class="requiredInput" name="university">
                                            <option value="0" disabled hidden>Choose The University</option>
                                            @foreach ($universities as $university)
                                                <option @if ($university->id == $hih->college->university->id)
                                                            selected="selected"
                                                        @endif
                                                value="{{$university->id}}">{{$university->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <select required class="requiredInput" name="college">
                                            <option value="0" disabled hidden>Choose The University First</option>
                                            @foreach ($hih->college->university->colleges as $college)
                                                <option @if ($college->id == $hih->college->id)
                                                        selected="selected"
                                                        @endif
                                                value="{{$college->id}}">{{$college->name}}</option>
                                            @endforeach
                                        </select>
                                </div> --}}

                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <span>mission</span>
                                        <textarea contenteditable="true" class="requiredInput" name="mission" class="CKEDITOR">{{$hih->mission}}</textarea>
                                        <label class="" for="mission">mission</label>
                                        {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <span>vision</span>
                                        <textarea contenteditable="true" class="requiredInput" name="vision" class="CKEDITOR">{{$hih->vision}}</textarea>
                                        <label class="" for="vision">vision</label>
                                        {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                                </div>
                                <div class="inputContainer fullWidth submitInput">
                                        <input type="submit" style="margin-top: 30px;" value="Save The information">
                                </div>
                        </div>
                        
                        <div class="rightBoxBackground">
                                @include('inc.logo')
                        </div>
                </div>
        </div>
{!! Form::close() !!}
<script src="{{ asset('js/form.js') }}"></script>
@endsection
