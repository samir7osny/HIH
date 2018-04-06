<option value="0" selected disabled hidden>Choose The College</option>
@foreach ($colleges as $college)
    <option value="{{$college->id}}">{{$college->name}}</option>
@endforeach