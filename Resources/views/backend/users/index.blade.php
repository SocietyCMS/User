@extends('layouts.master')

@section('title')
    {{ trans('user::users.title.users') }}
@endsection
@section('subTitle')
    {{ trans('user::users.title.users') }}
@endsection

@section('content')

    <a class="ui primary button" href="{{route('backend::user.user.create')}}">
        <i class="add user icon"></i>
        {{trans('core::elements.action.create resource', ['name'=>trans('user::users.title.user')])}}
    </a>

    <table class="ui selectable compact celled table">
        <thead>
            <tr><th>{{ trans('user::users.tabs.user') }}</th>
                <th>{{ trans('user::users.form.email') }}</th>
                <th>{{ trans('user::users.table.last_login') }}</th>
                <th class="collapsing">{{ trans('core::elements.table.actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>

                    <h4 class="ui image header">
                        <img src="{{ $user->present()->avatar }}" class="ui mini rounded image">
                        <div class="content">
                            <a href="{{ route('backend::user.user.edit', [$user->id]) }}" id="userFullname_{{$user->id}}">
                                {{ $user->present()->fullname }}
                            </a>
                            <div class="sub header">
                                <div class="ui horizontal divided list">
                                    @foreach($user->roles as $role)
                                        <span class="item">
                                            {{$role->display_name}}
                                        </span>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </h4>

                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->present()->lastLogin }}
                </td>
                <td>
                    <div class="ui icon top right pointing dropdown button">
                        <i class="wrench icon"></i>
                        <div class="menu">
                            <a class="item" href="{{route('backend::user.user.edit', $user->id)}}">@lang('core::elements.button.edit')</a>
                            <a v-on:click="openModal({{$user->id}})" class="@if($user->id == $currentUser->id) disabled @endif item">@lang('core::elements.button.delete')</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="ui small basic test modal">
        <div class="ui icon header">
            <i class="user icon"></i>
            @{{ user.first_name }} @{{ user.last_name }}
        </div>
        <div class="ui center aligned content">
           You are about to delete this user, are you sure?
        </div>
        <div class="actions">
            <div class="ui basic cancel inverted button">
                <i class="remove icon"></i>
                No
            </div>
            <div class="ui red approve inverted button">
                <i class="checkmark icon"></i>
                Yes
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $('.dropdown')
                .dropdown({
                    // you can use any ui transition
                    transition: 'drop'
                });


        new Vue({
            el: '#societyAdmin',
            data: {
                users: {!! $users !!},
                user: {
                    first_name: null,
                    last_name: null
                    }
                },
            methods: {
                openModal: function (id) {

                   this.user = this.users.filter(function( user ) {
                                return user.id == id;
                            })[0];

                    vueInstance = this;

                    $('.basic.test.modal')
                            .modal({
                                closable  : false,
                                onApprove : function() {
                                    vueInstance.deleteUser(id)
                                }
                            })
                            .modal('show');
                },
                deleteUser: function(id) {

                    var resource = this.$resource('{{apiRoute('v1', 'api.user.user.destroy', ['users' => ':id'])}}');

                    resource.delete({id: id}, function (data, status, request) {
                        location.reload();
                    }).error(function (data, status, request) {
                    });

                }
            }
        })

    </script>
@endsection
