@foreach ($contacts as $contact)
    <div class="contact" u="{{$contact->id}}" @if ($opened == $contact->id)
        id="opened"
    @endif>
        <img src="/storage/usersImages/{{$contact->photo_url}}" alt="">
        <h2 class="tableCell">{{$contact->first_name . " " . $contact->last_name}}</h2>
    </div>
@endforeach