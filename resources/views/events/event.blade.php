@extends('layouts.app')
@section('content')

<div class="outerBox dark">
    <div class="innerBox">
        <div class="leftBox">
        <img style="position:relative;border:none;border-radius:0;" src="{{asset('images/temp/tomhanks.jpg')}}">
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h1>Mashrou3 Tefl</h1>
                <table class="eventWorkshopInfo">
                    <tr>
                        <td >From </td>
                        <td>3:00PM</td>
                    </tr>
                    <tr>
                        <td>To </td>
                        <td>7:00PM</td>
                    </tr>
                    <tr>
                        <td>Date </td>
                        <td>12/6/2018</td>
                    </tr>
                    <tr>
                        <td>Place </td>
                        <td>L dwe2a</td>
                    </tr>
                    <tr>
                        <td>Place Cost</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td>Description </td>
                        <td>Shwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l evenShwayet kalam 3n l even Shwayet kalam 3n l even</td>
                    </tr>
                </table>
                <div class="inputContainer Button">
                    <button class="eventEnrollButton">Enroll</button>
                    <button>Delete</button>
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo')
            </div>
        </div>
    </div>
</div>
@endsection