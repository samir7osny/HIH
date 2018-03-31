@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        {{-- 'username', 'password','type','id_of','first_name', 'last_name', 'email', 'phone_number', 'photo_url','college_id' --}}
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">phone_number</label>
        
                                    <div class="col-md-6">
                                        <input id="phone_number" type="phone_number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>
        
                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="photo_url" class="col-md-4 col-form-label text-md-right">photo_url</label>
            
                                        <div class="col-md-6">
                                            <input id="photo_url" type="photo_url" class="form-control{{ $errors->has('photo_url') ? ' is-invalid' : '' }}" name="photo_url" value="{{ old('photo_url') }}" required>
            
                                            @if ($errors->has('photo_url'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('photo_url') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                            <label for="college_id" class="col-md-4 col-form-label text-md-right">college_id</label>
                
                                            <div class="col-md-6">
                                                <input id="college_id" type="college_id" class="form-control{{ $errors->has('college_id') ? ' is-invalid' : '' }}" name="college_id" value="{{ old('college_id') }}" required>
                
                                                @if ($errors->has('college_id'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('college_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">first_name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">last_name</label>
    
                                <div class="col-md-6">
                                    <input id="last_name" type="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
    
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">type</label>

                            <div class="col-md-6">
                                <input id="type" type="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}" required>

                                @if ($errors->has('type'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_of" class="col-md-4 col-form-label text-md-right">id_of</label>

                            <div class="col-md-6">
                                <input id="id_of" id_of="id_of" class="form-control{{ $errors->has('id_of') ? ' is-invalid' : '' }}" name="id_of" value="{{ old('id_of') }}" required>

                                @if ($errors->has('id_of'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('id_of') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
