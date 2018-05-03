@if ($chat->count() != 0)
    @for ($i = $chat->count() - 1; $i >= 0 ; $i--)
        <div class=" @if($chat[$i]->sender == Auth::user()->id) send @else receive @endif" m="{{$chat[$i]->id}}">
            <p>{{$chat[$i]->content}}</p>
            <span><i class="fa @if($chat[$i]->seen == 1) fa-check-square-o @else fa-square-o @endif " aria-hidden="true"></i>{{$chat[$i]->created_at}}</span>
        </div>
        <br>
    @endfor
@else
        <h1 class="nothing">No thing to show !</h1>
@endif