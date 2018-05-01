@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">
        <div class="leftBox">
            <div class="darkBackground">
                <div class="tableCell">
                    <div class="square">
                        <img src="/storage/sponsorsImages/{{$sponsor->photo_url}}" alt="">
                        <span>@include('inc.money')</span>
                    </div>
                    <h1>{{$sponsor->name}}</h1>
                </div>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h2><i class="headerIcon fa fa-phone" aria-hidden="true"></i>{{$sponsor->phone_number}}</h2>
                <h2><i class="headerIcon fa fa-address-book-o" aria-hidden="true"></i>{{$sponsor->email}}</h2>
                @if ($sponsor->about != null)
                    <p><i class="headerIcon fa fa-sticky-note-o" aria-hidden="true"></i>{{$sponsor->about}}</p>
                @endif
                <div class="inputContainer submitInput">
                    <a href="/sponsor/{{$sponsor->id}}/edit"><button>Edit</button></a>
                    {!! Form::open(['action' => ['SponsorsController@destroy', $sponsor->id], 'method' => 'POST','onsubmit'=>'return confirm("Do you want to delete \"' . $sponsor->name . '\" profile? ")']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        <input class="delete" type="submit" value="Delete">
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo');
            </div>
        </div>
    </div>
</div>
@endsection