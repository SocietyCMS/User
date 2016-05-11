@extends('layouts.master')
@section('title')
    {{ trans('user::auth.reset password') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            @include('flash::message')
            {!! Form::open(['route' => 'reset.post']) !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" class="form-control"
                           placeholder="{{ trans('user::auth.email') }}" value="{{ Input::old('email')}}"
                           required=""/>
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group">
                    <button type="submit"
                            class="btn btn-primary btn-block">{{ trans('user::auth.reset password') }}</button>
                </div>

                <p><a href="{{URL::route('login')}}">{{ trans('user::auth.I remembered my password') }}</a></p>

            {!! Form::close() !!}
        </div>
    </div>
@stop
