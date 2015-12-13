@extends('layouts.master')

@section('title')
    {{ trans('user::profile.title.profile') }}
@endsection
@section('subTitle')
    {{ $currentUser->present()->fullname }}
@endsection

@section('content')


    <div class="ui special card">

        <div class="blurring dimmable image">
            <div class="ui dimmer">
                <div class="content">
                    <div class="center">
                        <a href="{{route('backend::user.profile.edit')}}" class="ui inverted button">Edit Profile</a>
                    </div>
                </div>
            </div>
            <img src="{{ $currentUser->profile->present()->largeAvatar }}">
        </div>

        <div class="content">
            <a class="header"> {{ $currentUser->present()->fullname }}</a>
            <div class="meta">
                <span class="date">{{$currentUser->profile->present()->createdAt}}</span>
            </div>
            <div class="description">
                {{$currentUser->profile->description}}
            </div>
        </div>
        <div class="extra content">
            <a href="{{route('backend::user.profile.edit')}}" class="right floated star">
              <i class="pencil icon"></i>
              Edit
            </a>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $('.special.card .image').dimmer({
            on: 'hover'
        });
    </script>
@endsection
