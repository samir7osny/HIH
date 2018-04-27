@extends('layouts.app')

@section('content')
<div class="outerBox masonryTwoColumn paddedBox">
    <div class="inputContainer Button"><a href="/event/create"><button class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></button></a></div>
    <div class="masonryColumn">
            @for ($i = 0; $i < count($events); $i+=2)
            <a href="/event/{{$events[$i]->name}}" class="outerBox withoutOverflow" event="{{$events[$i]->id}}" style="
                @if ($events[$i]->cover) background-image:url(/storage/activitiesGallery/{{$events[$i]->cover->url}}); @endif" >
                <div class="innerBox darker">
                    <div class="rightBox">
                        <div class="tableCell">
                            <h1 class="data" placeholder="Enter the name" name="name">{{$events[$i]->name}}</h1>
                            <p>Number of forms: {!!$events[$i]->Audience()->count()!!}</p>
                            <p name="description" placeholder="Enter the description" class="data">{!!$events[$i]->description!!}</p>
                        </div>
                        <div class="rightBoxBackground">
                            @include('inc.logo')
                        </div>
                    </div>
                </div>
            </a>
            @endfor
    </div>
    <div class="masonryColumn">
            @for ($i = 1; $i < count($events); $i+=2)
            <a href="/event/{{$events[$i]->name}}" class="outerBox withoutOverflow" event="{{$events[$i]->id}}"  style="
                @if ($events[$i]->cover) background-image:url(/storage/activitiesGallery/{{$events[$i]->cover->url}}); @endif">
                <div class="innerBox darker">
                    <div class="rightBox">
                        <div class="tableCell">
                            <h1 class="data" placeholder="Enter the name" name="name">{{$events[$i]->name}}</h1>
                            <p>Number of forms: {!!$events[$i]->Audience()->count()!!}</p>
                            <p name="description" placeholder="Enter the description" class="data">{!!$events[$i]->description!!}</p>
                        </div>
                        <div class="rightBoxBackground">
                            @include('inc.logo')
                        </div>
                    </div>
                </div>
            </a>
            @endfor
    </div>
</div>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/events.js') }}"></script>

@endsection