@extends('layouts.app')

@section('content')
    <div class="outerBox windowHeight">
        <div class="innerBox">
            <div class="rightBox paddedBox">
                <div class="flexBox">
                    <div class="Table">
                            <div class="TableHeader">
                                <div class="TableColumn seen-answered">
                                    <h4>S</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>From</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>Email</h4>
                                </div>
                                <div class="TableColumn">
                                    <h4>Content</h4>
                                </div>
                            </div>
                            @foreach ($messages as $message)
                                <a href="/contactus/{{$message->id}}" class="TableRow">
                                    <div class="TableColumn seen-answered"
                                    style="background:
                                    @if ($message->seen)
                                        #31c531
                                    @else
                                        #d02727  
                                    @endif">
                                        S
                                    </div>
                                    <div class="TableColumn">
                                        {{ $message->sender_name }}
                                    </div>
                                    <div class="TableColumn">
                                        {{ $message->sender_email }}
                                    </div>
                                    <div class="TableColumn">
                                        {{substr(preg_replace( "/\r|\n/", "", $message->content), 0, 100) . "... "}}
                                    </div>
                                </a>                           
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection