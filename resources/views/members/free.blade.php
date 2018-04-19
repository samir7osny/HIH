@foreach ($members as $item)
@if ($item->user)
<div class="member freeMember" id="{{$item->id}}">
    <img src="/storage/usersImages/{{$item->user->photo_url}}" alt="{{$item->user->username}}">
    <h3 class="tableCell">{{$item->user->first_name . " " . $item->user->last_name}}</h3>
</div>
@endif
@endforeach
