<div class=" @if($message->sender == Auth::user()->id) send @else receive @endif "   m="{{$message->id}}">
    <p>{{$message->content}}</p>
    <span><i class="fa @if($message->seen) fa-check-square-o @else fa-square-o @endif " aria-hidden="true"></i>{{$message->created_at}}</span>
</div>
<br>