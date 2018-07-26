@extends('layouts.app')

@section('content')
<div class="outerBox masonryTwoColumn committeesContainer paddedBox">
    @if (! \App\User::havePermission(['PRESIDENT','HIGHBOARD'])) <span style="display:none" id="headDisallowed"></span> @endif
    <div class="masonryColumn">
            @for ($i = 0; $i < count($committees); $i+=2)
            <div class="outerBox" committee="{{$committees[$i]->id}}" >
                <div class="innerBox haveSlide">
                    <div class="rightBox">
                        <div class="tableCell">
                            <h1 class="data" placeholder="Enter the name" name="name">{{$committees[$i]->name}}</h1>
                            <p name="description" placeholder="Enter the description" class="data">{!!$committees[$i]->description!!}</p>
                            <div class="inputContainer Button">
                                <button class="membersButton">Members</button>
                                @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD']))
                                    <button class="edit">Edit</button>
                                    <button class="delete">Delete</button>
                                @endif
                            </div>
                        </div>
                        <div class="rightBoxBackground">
                            @include('inc.logo')
                        </div>
                    </div>
                </div>
                <div class="innerBox members" style="display:block">
                    <div class="flexBox">
                        @foreach ($committees[$i]->members as $member)
                            <a href="/user/{{$member->user->username}}" id="{{$member->id}}" class="member @if ($committees[$i]->head && $committees[$i]->head->id == $member->id)
                                head
                                @endif ">
                                <img src="/storage/usersImages/{{$member->user->photo_url}}" alt="{{$member->user->first_name . " " . $member->user->last_name}}">
                                <h3 class="tableCell">{{$member->user->first_name . " " . $member->user->last_name}}</h3>
                                <span class="headButton @if (! \App\User::havePermission(['PRESIDENT','HIGHBOARD'])) disabled @endif"><i class="fa fa-header" aria-hidden="true"></i></span>
                                @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','TYPE_HEAD','HR','TYPE_MEMBER','HR']) && Auth::check() && Auth::user()->id != $member->user->id)
                                <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                @endif
                            </a>
                        @endforeach
                        @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','TYPE_HEAD','HR','TYPE_MEMBER','HR']))
                        <div class="member addMember">
                            <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                            </button></div>
                                <div class="chooseMember dropdown">
                                        
                                </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endfor
    </div>
    <div class="masonryColumn">
            @for ($i = 1; $i < count($committees); $i+=2)
            <div class="outerBox" committee="{{$committees[$i]->id}}" >
                <div class="innerBox haveSlide">
                    <div class="rightBox">
                        <div class="tableCell">
                            <h1 class="data" placeholder="Enter the name" name="name">{{$committees[$i]->name}}</h1>
                            <p name="description" placeholder="Enter the description" class="data">{!!$committees[$i]->description!!}</p>
                            <div class="inputContainer Button">
                                <button class="membersButton">Members</button>
                                @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD']))
                                    <button class="edit">Edit</button>
                                    <button class="delete">Delete</button>
                                @endif
                            </div>
                        </div>
                        <div class="rightBoxBackground">
                            @include('inc.logo')
                        </div>
                    </div>
                </div>
                <div class="innerBox members" style="display:block">
                    <div class="flexBox">
                        @foreach ($committees[$i]->members as $member)
                            <a href="/user/{{$member->user->username}}" id="{{$member->id}}" class="member @if ($committees[$i]->head && $committees[$i]->head->id == $member->id)
                                head
                                @endif ">
                                <img src="/storage/usersImages/{{$member->user->photo_url}}" alt="{{$member->user->first_name . " " . $member->user->last_name}}">
                                <h3 class="tableCell">{{$member->user->first_name . " " . $member->user->last_name}}</h3>
                                <span class="headButton @if (! \App\User::havePermission(['PRESIDENT','HIGHBOARD'])) disabled @endif"><i class="fa fa-header" aria-hidden="true"></i></span>
                                @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','TYPE_HEAD','HR','TYPE_MEMBER','HR']) && Auth::check() && Auth::user()->id != $member->user->id)
                                <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                @endif
                            </a>
                        @endforeach
                        @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','TYPE_HEAD','HR','TYPE_MEMBER','HR']))
                        <div class="member addMember">
                            <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                            </button></div>
                                <div class="chooseMember dropdown">
                                        
                                </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endfor
    </div>

    
    @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD']))
    <div class="inputContainer Button"><button class="add"><i class="fa fa-plus-square" aria-hidden="true"></i>
    </button></div> 
    @endif

</div>
<script>
    let members = $('.members');
    $('.members').slideToggle(0);
    $("body").on("click", "button.membersButton",function (e) {
        let members = $(this).parents('.outerBox[committee]').find('.members');
        members.css('transition','none');
        members.slideToggle("fast");
    });
</script>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
@if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','TYPE_HEAD','HR','TYPE_MEMBER','HR']))
<script src="{{ asset('js/committees.js') }}"></script>
@endif
@endsection