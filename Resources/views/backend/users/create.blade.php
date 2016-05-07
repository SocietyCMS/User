@extends('layouts.master')

@section('title')
    {{ trans('user::users.title.users') }}
@endsection
@section('subTitle')
    {{trans('core::elements.action.create resource', ['name'=>trans('user::users.title.user')])}}
@endsection

@section('content')
    <form class="ui form" role="form" method="POST" action="{{route('backend::user.user.store')}}">
        {!! csrf_field() !!}

        <div class="ui top attached tabular menu">
            <a class="active item" data-tab="user">{{ trans('user::users.tabs.user') }}</a>
            <a class="item" data-tab="roles">{{ trans('user::users.tabs.roles') }}</a>
        </div>

        <div class="ui bottom attached active tab segment" data-tab="user">
            @include('user::backend.users.partials.userTab')
        </div>

        <div class="ui bottom attached tab segment" data-tab="roles">
            @include('user::backend.users.partials.rolesTab')
        </div>

        <div class="ui clearing segment">
            <a href="{{ route('backend::user.user.index') }}" class="ui right floated button">
                {{ trans('core::elements.button.cancel') }}
            </a>
            <button class="ui primary right floated button" type="submit">
                {{ trans('core::elements.button.update') }}
            </button>
        </div>

    </form>

@endsection

@section('javascript')
    <script>
        $('.tabular.menu .item')
                .tab();
        $('.pupup.button')
                .popup();
        $('#rolesMultiselect')
                .dropdown();
    </script>
@endsection
