@extends('layouts.master')

@section('title')
    {{ trans('user::auth.reset password') }} | @parent
@stop

@section('content')
    <div class=" col-md-offset-3 col-md-6">
        <h1>{{ trans('user::auth.reset password') }}</h1>
        @include('flash::message')
        <div class="well bs-component">
            {!! Form::open() !!}
            <div class="body bg-gray">
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
            </div>
            <div class="footer">
                <button type="submit" class="btn btn-info btn-block">{{ trans('user::auth.reset password') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
