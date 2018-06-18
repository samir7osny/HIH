@foreach ($members as $member)
    <a target="blank" href="/user/{{$member->user->username}}" class="member" m="{{$member->id}}">
        <img src="/storage/usersImages/{{$member->user->photo_url}}" alt="{{$member->user->first_name . " " . $member->user->last_name}}">
        <h3 class="tableCell">{{$member->user->first_name . " " . $member->user->last_name}}</h3>
    </a>
@endforeach