<a target="blank" href="/speaker/create" class="member addMember">
    <div class="inputContainer Button" style="height: inherit;">
        <button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
    </div>
</a>
@foreach ($speakers as $speaker)
    <a target="blank" href="/speaker/{{$speaker->id}}" class="member" s="{{$speaker->id}}">
        <img src="/storage/speakersImages/{{$speaker->photo_url}}" alt="">
        <h3 class="tableCell">{{$speaker->title . ". " . $speaker->first_name . " " . $speaker->last_name}}</h3>
    </a>
@endforeach