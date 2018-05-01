@extends('layouts.app')

@section('content')
    <div class="outerBox windowHeight">
        <div class="innerBox">
            <div class="rightBox paddedBox">
                <div class="flexBox">
                    <a class="messageControll" href="/request/inbox" content="Inbox" @if($section == 'inbox')id="activeSection"@endif>Inbox</a>
                    <a class="messageControll" href="/request/outbox" content="Outbox" @if($section == 'outbox')id="activeSection"@endif>Outbox</a>
                    <div class="Table">
                        @if ($section == 'inbox')
                            <div class="TableHeader">
                                <div class="TableColumn seen-answered">
                                    <h4>A</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>From</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>To Delete</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>Content</h4>
                                </div>
                            </div>
                            @foreach ($requests as $request)
                                <a href="/request/{{$request->id}}" class="TableRow">
                                    <div class="TableColumn seen-answered"
                                    @if ($request->answered)
                                        style="background:
                                        @if ($request->answer)
                                            #31c531
                                        @else
                                            #d02727  
                                        @endif
                                        "
                                    @endif>
                                        A
                                    </div>
                                    <div class="TableColumn">
                                        {{ $request->userSender->first_name . " " . $request->userSender->last_name }}
                                    </div>
                                    <div class="TableColumn">
                                        @if ($request->userToDelete)
                                            {{ $request->userToDelete->first_name . " " . $request->userToDelete->last_name }}
                                        @else
                                            {{$request->deleted_user_name}}
                                        @endif
                                    </div>
                                    <div class="TableColumn">
                                        {{substr(preg_replace( "/\r|\n/", "", $request->content), 0, 100) . "... "}}
                                    </div>
                                </a>                           
                            @endforeach
                        @elseif ($section == 'outbox')
                            <div class="TableHeader">
                                <div class="TableColumn seen-answered">
                                    <h4>A</h4>
                                </div>
                                <div class="TableColumn seen-answered">
                                    <h4>S</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>To Delete</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>Content</h4>
                                </div>
                            </div>
                            @foreach ($requests as $request)
                                <a href="/request/{{$request->id}}" class="TableRow">
                                    <div class="TableColumn seen-answered"
                                    @if ($request->answered)
                                        style="background:
                                        @if ($request->answer)
                                            #31c531
                                        @else
                                            #d02727  
                                        @endif
                                        "
                                    @endif>
                                        A
                                    </div>
                                    <div class="TableColumn seen-answered"
                                        style="background:
                                        @if ($request->seen)
                                            #31c531
                                        @else
                                            #d02727  
                                        @endif">
                                        S
                                    </div>
                                    <div class="TableColumn">
                                            @if ($request->userToDelete)
                                                {{ $request->userToDelete->first_name . " " . $request->userToDelete->last_name }}
                                            @else
                                                {{$request->deleted_user_name}}
                                            @endif
                                    </div>
                                    <div class="TableColumn">
                                        {{substr(preg_replace( "/\r|\n/", "", $request->content), 0, 100) . "... "}}
                                    </div>
                                </a>                           
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection