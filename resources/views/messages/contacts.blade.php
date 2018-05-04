<?php
use Illuminate\Support\Facades\DB;
?>

@foreach ($contacts as $contact)
    <?php
        $lastM = DB::table('messages')->where('sender',$contact->id)->where('receiver',Auth::user()->id)->orderBy('created_at','DESC')->first();
    ?>
    <div class="contact
    @if ($lastM != null && $lastM->seen==0)
        unseen
    @endif" u="{{$contact->id}}" @if ($opened == $contact->id)
        id="opened"
    @endif>
        <img src="/storage/usersImages/{{$contact->photo_url}}" alt="">
        <h2 class="tableCell">{{$contact->first_name . " " . $contact->last_name}}</h2>
    </div>
@endforeach