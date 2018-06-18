@extends('layouts.app')

@section('content')
<div class="outerBox masonryTwoColumn paddedBox">
    <div class="inputContainer Button"><a href="/workshop/create"><button class="add"><i class="fa fa-plus-square" aria-hidden="true"></i></button></a></div>
    <div class="masonryColumn">
            @for ($i = 0; $i < count($workshops); $i+=2)
            <a href="/workshop/{{$workshops[$i]->name}}" class="outerBox withoutOverflow" workshop="{{$workshops[$i]->id}}" style="
                @if ($workshops[$i]->cover) background-image:url(/storage/activitiesGallery/{{$workshops[$i]->cover->url}}); @endif" >
                <div class="innerBox darker">
                    <div class="rightBox">
                        <div class="tableCell">
                            <h1 class="data" placeholder="Enter the name" name="name">{{$workshops[$i]->name}}</h1>
                            <p style="text-align:center;">Number of forms: {!!$workshops[$i]->Audience()->count()!!}</p>
                            <p name="description" placeholder="Enter the description" class="data">{!!nl2br($workshops[$i]->description)!!}</p>
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
            @for ($i = 1; $i < count($workshops); $i+=2)
            <a href="/workshop/{{$workshops[$i]->name}}" class="outerBox withoutOverflow" workshop="{{$workshops[$i]->id}}"  style="
                @if ($workshops[$i]->cover) background-image:url(/storage/activitiesGallery/{{$workshops[$i]->cover->url}}); @endif">
                <div class="innerBox darker">
                    <div class="rightBox">
                        <div class="tableCell">
                            <h1 class="data" placeholder="Enter the name" name="name">{{$workshops[$i]->name}}</h1>
                            <p style="text-align:center;">Number of forms: {!!$workshops[$i]->Audience()->count()!!}</p>
                            <p name="description" placeholder="Enter the description" class="data">{!!nl2br($workshops[$i]->description)!!}</p>
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

@endsection