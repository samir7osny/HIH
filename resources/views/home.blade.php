@extends('layouts.app')


@section('intro')
    <div class="headerVideoContainer">
        {{-- <video poster="{{ asset('images/HIH.png') }}" class="headerVideo" video="video" autobuffer="autobuffer" autoplay="autoplay" onloadstart="this.volume=0.0" onclick="if (this.paused) {this.play();} else {this.pause();}">
            <source src="{{ asset('videos/intro.mp4') }}" type="video/mp4">
        </video> --}}
        <img src="{{ asset('images/HIH.png') }}" alt="" style="display:block; width:100%; height:100%; object-fit:cover;">
        <div class="text">
            <h1>Hand In Hand</h1>
            <p>Hint about Hand In Hand</p>
        </div>
        <span id="toContent"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
    </div>
    <script src="{{ asset('js/intro.js') }}"></script>
@endsection

@section('content')
    <div class="slide dark">
        <div class="container">
            <div class="text">
                <h1>Upcoming Events</h1>
            </div>
            <div class="panelContainer" panel='panel'>
                    <div class="panel">
                        @foreach($upcomingEvents as $upcomingEvent)
                        <div class="panelItem" style="background-image:url(/storage/activitiesGallery/{{$upcomingEvent->cover->url}});">
                            <div class="panelItemDarker">
                                <div class="panelItemText">
                                    <h1 class="panelItemTitle">{{$upcomingEvent->name}}</h1>
                                    <p class="panelItemContent">{{$upcomingEvent->description}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="panelControl">
                            <span class="panelPause">
                                <i class="fa fa-pause" aria-hidden="true"></i>
                            </span>
                            <span class="panelPlay">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </span>
                            <div class="panelControlArrows">
                                <span class="panelArrow panelLeftArrow">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </span>
                                <span class="panelArrow panelRightArrow">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
                            </div>
                            <span class="panelTimer">
                                <span></span>
                            </span>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="slide light">
        <div class="container">
            <div class="panelContainer" panel='panel'>
                <div class="panel">
                    <div class="panelItem" style="background-image:url(background.jpg);">
                        <div class="panelItemDarker">
                            <div class="panelItemText">
                                <h1 class="panelItemTitle">Item Title</h1>
                                <p class="panelItemContent">Item Content, feeh klam kteeer gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn</p>
                            </div>
                        </div>
                    </div>
                    <div class="panelItem" style="background-image:url(background2.jpg);">
                        <div class="panelItemDarker">
                            <div class="panelItemText">
                                <h1 class="panelItemTitle">Item Title</h1>
                                <p class="panelItemContent">Item Content, feeh klam kteeer gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn</p>
                            </div>
                        </div>
                    </div>
                    <div class="panelItem" style="background-image:url(background3.jpg);">
                        <div class="panelItemDarker">
                            <div class="panelItemText">
                                <h1 class="panelItemTitle">Item Title</h1>
                                <p class="panelItemContent">Item Content, feeh klam kteeer gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn</p>
                            </div>
                        </div>
                    </div>
                    <div class="panelItem" style="background-image:url(background3.jpg);">
                        <div class="panelItemDarker">
                            <div class="panelItemText">
                                <h1 class="panelItemTitle">Item Title</h1>
                                <p class="panelItemContent">Item Content, feeh klam kteeer gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn</p>
                            </div>
                        </div>
                    </div>
                    <div class="panelItem" style="background-image:url(background3.jpg);">
                        <div class="panelItemDarker">
                            <div class="panelItemText">
                                <h1 class="panelItemTitle">Item Title</h1>
                                <p class="panelItemContent">Item Content, feeh klam kteeer gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn</p>
                            </div>
                        </div>
                    </div>
                    <div class="panelItem" style="background-image:url(background3.jpg);">
                        <div class="panelItemDarker">
                            <div class="panelItemText">
                                <h1 class="panelItemTitle">Item Title</h1>
                                <p class="panelItemContent">Item Content, feeh klam kteeer gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn</p>
                            </div>
                        </div>
                    </div>
                    <div class="panelItem" style="background-image:url(background3.jpg);">
                        <div class="panelItemDarker">
                            <div class="panelItemText">
                                <h1 class="panelItemTitle">Item Title</h1>
                                <p class="panelItemContent">Item Content, feeh klam kteeer gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn</p>
                            </div>
                        </div>
                    </div>
                    <div class="panelItem" style="background-image:url(background3.jpg);">
                        <div class="panelItemDarker">
                            <div class="panelItemText">
                                <h1 class="panelItemTitle">Item Title</h1>
                                <p class="panelItemContent">Item Content, feeh klam kteeer gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn</p>
                            </div>
                        </div>
                    </div>
                    <div class="panelItem" style="background-image:url(background3.jpg);">
                        <div class="panelItemDarker">
                            <div class="panelItemText">
                                <h1 class="panelItemTitle">Item Title</h1>
                                <p class="panelItemContent">Item Content, feeh klam kteeer gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn
                                    gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn gdn</p>
                            </div>
                        </div>
                    </div>
                    <div class="panelControl">
                        <span class="panelPause">
                            <i class="fa fa-pause" aria-hidden="true"></i>
                        </span>
                        <span class="panelPlay">
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </span>
                        <div class="panelControlArrows">
                            <span class="panelArrow panelLeftArrow">
                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            </span>
                            <span class="panelArrow panelRightArrow">
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </span>
                        </div>
                        <span class="panelTimer">
                            <span></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="text">
                <h1>Upcoming Workshops</h1>
                <p>Hint about Workshops</p>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/panelCreator.js') }}"></script>
    <script>addPanelS()</script>
@endsection
