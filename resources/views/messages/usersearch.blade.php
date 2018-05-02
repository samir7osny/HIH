@foreach ($users as $user)
    <div class="contact" u="{{$user->id}}">
        <img src="/storage/usersImages/{{$user->photo_url}}" alt="">
        <h2 class="tableCell">{{$user->first_name . " " . $user->last_name}}</h2>
    </div>
@endforeach