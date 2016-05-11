@extends('layouts.master')
@section('title')
    {{ trans('user::auth.register') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            @include('flash::message')
            {!! Form::open(array('route' => 'register.post')) !!}
                <div class="form-group{{ $errors->has('first_name') ? ' has-error has-feedback' : '' }}">
                    {!! Form::label('first_name', trans('user::auth.first-name')) !!}
                    {!! Form::text('first_name', Input::old('first_name'), ['class' => 'form-control', 'placeholder' => trans('user::auth.first-name')]) !!}
                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error has-feedback' : '' }}">
                    {!! Form::label('last_name', trans('user::auth.last-name')) !!}
                    {!! Form::text('last_name', Input::old('last_name'), ['class' => 'form-control', 'placeholder' => trans('user::auth.last-name')]) !!}
                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                    {!! Form::label('email', trans('user::auth.email')) !!}
                    {!! Form::text('email', Input::old('email'), ['class' => 'form-control', 'placeholder' => trans('user::auth.email')]) !!}
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error has-feedback' : '' }}">
                    {!! Form::label('password', trans('user::auth.password')) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('user::auth.password')]) !!}
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error has-feedback' : '' }}">
                    {!! Form::label('password_confirmation', trans('user::auth.password confirmation')) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('user::auth.password confirmation')]) !!}
                    {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">{{ trans('user::auth.register me')}}</button>
                </div>

                <a href="{{ URL::route('login') }}" class="text-center">{{ trans('user::auth.I already have a membership') }}</a>

            {!! Form::close() !!}
        </div>
    </div>
@stop
