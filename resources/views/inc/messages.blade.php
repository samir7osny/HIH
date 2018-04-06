<div class="notification">
@if (count($errors) > 0 || session('success') || session('error'))
    @if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <p class="notification error">
            {{$error}}
        </p>
    @endforeach
    @endif

    @if (session('success'))
    <p class="notification">
        {{session('success')}}
    </p>
    @endif

    @if (session('error'))
    <p class="notification error">
        {{session('error')}}
    </p>
    @endif
@endif
<button><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
</div>
