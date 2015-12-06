@extends('layouts.master')

@section('title')
    {{ trans('user::auth.reset password') }} | @parent
@stop

@section('content')
    <div class=" col-md-offset-3 col-md-6">
        <h1>{{ trans('user::auth.reset password') }}</h1>
        @include('flash::message')
        <div class="well bs-component">
            {!! Form::open(array('route' => 'reset.post')) !!}
            <div class="body bg-gray">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" class="form-control"
                           placeholder="{{ trans('user::auth.email') }}" value="{{ Input::old('email')}}" required=""/>
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="footer">
                <button type="submit" class="btn btn-info btn-block">{{ trans('user::auth.reset password') }}</button>
                <p><a href="{{URL::route('login')}}">{{ trans('user::auth.I remembered my password') }}</a></p>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
