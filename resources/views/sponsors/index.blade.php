@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">
        <div class="rightBox">
            <h1>
                Sponsors
            </h1>
            <div class="flexBox">
                    @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','TYPE_HEAD','FR','TYPE_MEMBER','FR']))
                    <a href="/sponsor/create" class="flexChild addMember">
                        <div class="inputContainer Button" style="height:inherit;">
                            <button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                        </div>
                    </a>
                    @endif
                    @foreach ($sponsors as $sponsor)
                        <a href="/sponsor/{{$sponsor->id}}" class="flexChild">
                            <img src="/storage/sponsorsImages/{{$sponsor->photo_url}}" alt="{{$sponsor->name}}">
                            <h3 class="tableCell">{{$sponsor->name}}</h3>
                        </a>
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection