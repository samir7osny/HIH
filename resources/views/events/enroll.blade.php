@extends('layouts.app')

@section('content')
{!! Form::open(['action' => ['EventsController@enrollWithAnswers',  $event->name], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
        @csrf
        <div class="innerBox">
                <div class="rightBox">
                        <div class="tableCell">
                                <h1>Enroll in "{{$event->name}}" Event</h1>
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
                                @foreach ($event->questions as $question)
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <span>{{$question->question_content}}
                                        @if ($question->required)
                                                        <span style="color:#F00;">*</span>
                                        @endif</span>
                                        <textarea placeholder="Enter your answer" @if ($question->required)
                                            required class="requiredInput"
                                        @endif contenteditable="true" name="answer[{{$question->id}}]" class="CKEDITOR"></textarea>
                                        {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                                </div>
                                @endforeach
                                <div class="inputContainer fullWidth submitInput">
                                        <input type="submit" style="margin-top: 30px;" value="Enroll">
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
