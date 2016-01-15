@extends('layouts.master')

@section('title')
    {{ trans('user::roles.title.roles') }}
@endsection
@section('subTitle')
    {{ trans('user::roles.title.edit') }}
@endsection

@section('content')
    <form class="ui form" role="form" method="POST" action="{{route('backend::user.role.update', $role->id)}}">
        <input type="hidden" name="_method" value="PUT">
        {!! csrf_field() !!}

        <div class="ui top attached tabular menu">
            <a class="active item" data-tab="info">{{ trans('user::roles.tabs.info') }}</a>
            <a class="item" data-tab="permissions">{{ trans('user::roles.tabs.permissions') }}</a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="info">
            @include('user::backend.roles.partials.infoTab')
        </div>

        <div class="ui bottom attached tab segment" data-tab="permissions">
            @include('user::backend.roles.partials.permissions', ['model' => $role])
        </div>

        <div class="ui clearing segment">
            <a href="{{ route('backend::user.role.index') }}" class="ui right floated button">
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
        $('.menu .item')
                .tab();
        $('.pupup.button')
                .popup();
        $('#usersMultiselect')
                .dropdown();

        @if($role->name == 'admin')
            $('.ui.fitted.slider.checkbox').checkbox( 'set disabled' );
        @endif


    </script>
@endsection
