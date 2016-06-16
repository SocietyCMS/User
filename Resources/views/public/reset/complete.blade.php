@extends('layouts.master')

@section('title')
    {{ trans('user::auth.reset password') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8 col-xs-12">
            @include('flash::message')
            {!! Form::open(['route' => 'reset.complete.post']) !!}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" class="form-control"
                           placeholder="{{ trans('user::auth.email') }}" value="{{ old('email')}}"/>
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error has-feedback' : '' }}">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('user::auth.password')]) !!}
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error has-feedback' : '' }}">
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('user::auth.password confirmation')]) !!}
                    {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                </div>

            <div class="form-group">
                <button type="submit"
                        class="btn btn-primary btn-block">{{ trans('user::auth.reset password') }}</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop
