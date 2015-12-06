@extends('layouts.master')

@section('title')
    {{ trans('user::roles.title.roles') }}
@endsection
@section('subTitle')
    {{ trans('user::roles.title.roles') }}
@endsection

@section('content')

    <a class="ui primary button" href="{{route('backend::user.role.create')}}">
        <i class="users icon"></i>
        {{ trans('user::roles.button.new role') }}
    </a>

    <table class="ui selectable compact celled table">
        <thead>
        <tr>
            <th>{{ trans('user::roles.table.name') }}</th>
            <th>{{ trans('user::roles.table.created-at') }}</th>
            <th>{{ trans('user::roles.table.updated-at') }}</th>
            <th class="collapsing">{{ trans('user::roles.table.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>

                    <h4 class="ui header">
                        <div class="content">
                            <a href="{{route('backend::user.role.edit', $role->id)}}">
                                {{ $role->name }}
                            </a>
                            <div class="sub header">
                                {{trans_choice('user::roles.table.members', $role->users()->count())}}
                            </div>
                        </div>
                    </h4>

                </td>
                <td>
                    {{ $role->present()->createdAt }}
                </td>
                <td>
                    {{ $role->present()->updatedAt }}
                </td>
                <td>
                    <div class="ui icon top right pointing dropdown button">
                        <i class="wrench icon"></i>
                        <div class="menu">
                            <a class="item" href="{{route('backend::user.role.edit', $role->id)}}">@lang('core::elements.button.edit')</a>
                            <a class="item">@lang('core::elements.button.delete')</a>
                        </div>
                    </div>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@section('javascript')
    <script>
        $('.dropdown')
                .dropdown({
                    // you can use any ui transition
                    transition: 'drop'
                });
    </script>
@endsection
