@extends('layouts.master')

@section('title')
    {{ trans('user::roles.title.roles') }}
@endsection
@section('subTitle')
    {{trans('core::elements.action.create resource', ['name'=>trans('user::roles.title.role')])}}
@endsection

@section('content')
    <form class="ui form" role="form" method="POST" action="{{route('backend::user.role.store')}}">
        {!! csrf_field() !!}

        <div class="ui top attached tabular menu">
            <a class="active item" data-tab="info">{{ trans('user::roles.tabs.info') }}</a>
            <a class="item" data-tab="permissions">{{ trans('user::roles.tabs.permissions') }}</a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="info">
            @include('user::backend.roles.partials.infoTab')
        </div>

        <div class="ui bottom attached tab segment" data-tab="permissions">
            @include('user::backend.roles.partials.permissions')
        </div>

        <div class="ui clearing segment">
            <a href="{{ route('backend::user.role.index') }}" class="ui right floated button">
                {{ trans('core::elements.button.cancel') }}
            </a>
            <button class="ui primary right floated button" type="submit">
                {{ trans('core::elements.button.create') }}
            </button>
        </div>

    </form>

@endsection

@section('javascript')
    <script>
        $('.menu .item')
                .tab();
        $('.pupup.button')
                .popup();
        $('#usersMultiselect')
                .dropdown();
    </script>
@endsection








@section('content2')
{!! Form::open(['route' => 'backend::user.role.store', 'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">{{ trans('user::roles.tabs.data') }}</a></li>
                <li class=""><a href="#tab_2-2" data-toggle="tab">{{ trans('user::roles.tabs.permissions') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('name', trans('user::roles.form.name')) !!}
                                    {!! Form::text('name', Input::old('name'), ['class' => 'form-control slugify', 'placeholder' => trans('user::roles.form.name')]) !!}
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                    {!! Form::label('slug', trans('user::roles.form.slug')) !!}
                                    {!! Form::text('slug', Input::old('slug'), ['class' => 'form-control slug', 'placeholder' => trans('user::roles.form.slug')]) !!}
                                    {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::elements.button.create') }}</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('backend::user.role.index')}}"><i class="fa fa-times"></i> {{ trans('core::elements.button.cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
