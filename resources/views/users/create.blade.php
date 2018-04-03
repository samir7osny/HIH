@extends('layouts.app')

@section('content')
<form action="" class="outerBox">
    <div class="leftBox">
        <div class="darkBackground">
            <div class="tableCell">
                <div class="square">
                    <img id="userImage" src="tomhanks.jpg" alt="">
                    <div class="inputImgHover"><span>Click To Edit</span></div>
                    <input type="file" accept="image/*" hidden name="userImage">
                </div>
                <div class="inputContainer">
                    <input class="requiredInput" type="text" name="userName">
                    <label for="userName">Enter The Name</label>
                </div>
            </div>
        </div>
    </div>
    <div class="rightBox">
        <div class="tableCell">
            <h2>
                <i class="fa fa-university" aria-hidden="true"></i>
                <div class="inputContainer">
                        <select class="requiredInput" name="university" id="">
                            <option value="0" selected disabled hidden>Choose The University</option>
                            <option value="1">Cairo University</option>
                        </select>
                </div>
            </h2>
            <h2>
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <div class="inputContainer">
                        <select class="requiredInput" name="college" id="">
                            <option value="0" selected disabled hidden>Choose The University First</option>
                            <option value="1">Faculty Of Engineering</option>
                        </select>
                </div>
            </h2>
            <h2>
                <i class="fa fa-phone" aria-hidden="true"></i>
                <div class="inputContainer">
                        <input class="requiredInput" type="text" name="phoneNumber">
                        <label for="phoneNumber">Enter The Phone Number</label>
                </div>
            </h2>
            <h2>
                <i class="fa fa-address-book-o" aria-hidden="true"></i>
                <div class="inputContainer">
                        <input class="requiredInput" type="email" name="email">
                        <label for="email">Enter The E-Mail</label>
                </div>
            </h2>
            <div class="inputContainer submitInput">
                <input type="submit" value="Submit">
            </div>
        </div>
        <div class="rightBoxBackground">
            @include('inc.logo')
        </div>
    </div>
</form>
@endsection