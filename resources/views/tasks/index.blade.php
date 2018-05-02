@extends('layouts.app')

@section('content')
    <div class="outerBox windowHeight">
        <div class="innerBox">
            <div class="rightBox paddedBox">
                <div class="flexBox">
                    <a class="messageControll" href="/task/inbox" content="Inbox" @if($section == 'inbox')id="activeSection"@endif>Inbox</a>
                    <a class="messageControll" href="/task/outbox" content="Outbox" @if($section == 'outbox')id="activeSection"@endif>Outbox</a>
                    <div class="Table">
                        @if ($section == 'inbox')
                            <div class="TableHeader">
                                <div class="TableColumn seen-answered">
                                    <h4>A</h4>
                                </div>
                                <div class="TableColumn seen-answered">
                                    <h4>S</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>From</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>Content</h4>
                                </div>
                            </div>
                            @foreach ($tasks as $task)
                                <a href="/task/{{$task->id}}" class="TableRow">
                                    <div class="TableColumn seen-answered"
                                    @if ($task->answered)
                                        style="background:
                                        @if ($task->answer)
                                            #31c531
                                        @else
                                            #d02727  
                                        @endif
                                        "
                                    @endif>
                                        A
                                    </div>
                                    <div class="TableColumn seen-answered"
                                    @if ($task->seen)
                                        style="background:
                                        #31c531
                                    @else
                                        #d02727  
                                        "
                                    @endif>
                                        S
                                    </div>
                                    <div class="TableColumn">
                                        {{ $task->sender->first_name . " " . $task->sender->last_name }}
                                    </div>
                                    <div class="TableColumn">
                                        {{substr(preg_replace( "/\r|\n/", "", $task->content), 0, 100) . "... "}}
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
                                    <h4>To</h4>
                                </div>                               
                                <div class="TableColumn">
                                    <h4>Content</h4>
                                </div>
                            </div>
                            @foreach ($tasks as $task)
                                <a href="/task/{{$task->id}}" class="TableRow">
                                    <div class="TableColumn seen-answered"
                                    @if ($task->answered)
                                        style="background:
                                        @if ($task->answer)
                                            #31c531
                                        @else
                                            #d02727  
                                        @endif
                                        "
                                    @endif>
                                        A
                                    </div>
                                    <div class="TableColumn seen-answered"
                                    @if ($task->seen)
                                        style="background:
                                        #31c531
                                    @else
                                        #d02727  
                                        "
                                    @endif>
                                        S
                                    </div>
                                    <div class="TableColumn">
                                        {{ $task->receiver->first_name . " " . $task->receiver->last_name }}
                                    </div>
                                    <div class="TableColumn">
                                        {{substr(preg_replace( "/\r|\n/", "", $task->content), 0, 100) . "... "}}
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