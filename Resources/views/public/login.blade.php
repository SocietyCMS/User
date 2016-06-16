@extends('layouts.master')
@section('title')
    {{ trans('user::auth.login') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8 col-xs-12">
            @include('flash::message')
            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" class="form-control"
                           placeholder="{{ trans('user::auth.email') }}" value="{{ Input::old('email')}}"/>
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password"
                           class="form-control" placeholder="Password"
                           value="{{ Input::old('password')}}"/>
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember_me" id="remember_me"/>
                    <label for="remember_me">{{ trans('user::auth.remember me') }}</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">{{ trans('user::auth.login') }}</button>
                </div>

                <p><a href="{{URL::route('reset')}}">{{ trans('user::auth.forgot password') }}</a></p>

                @if(Setting::get('user::enable-registration'))
                    <p><a href="{{URL::route('register')}}" class="text-center">{{ trans('user::auth.register')}}</a></p>
                @endif
            {!! Form::close() !!}
        </div>
    </div>
@stop
