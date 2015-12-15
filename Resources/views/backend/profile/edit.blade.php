@extends('layouts.master')

@section('title')
    {{ trans('user::profile.title.profile') }}
@endsection
@section('subTitle')
    {{ $user->present()->fullname }}
@endsection

@section('content')

    <div class="ui grid">
        <div class="three wide column">
            <div class="ui vertical fluid tabular menu">

                <a data-tab="profile"
                   class="item active">
                    @lang('user::profile.title.profile')
                </a>

                <a data-tab="password"
                   class="item">
                    @lang('user::profile.title.password')
                </a>

            </div>
        </div>
        <div class="thirteen wide stretched column" id="profileContainer">
                <div class="ui tab active" data-tab="profile">
                    <form class="ui form" role="form" method="POST" action="">
                        <h5 class="ui top attached header">
                            {!! csrf_field() !!}
                            <div class="content">
                                {{ $user->present()->fullname }}
                            </div>
                        </h5>
                        <div class="ui attached segment">
                            <div class="field">
                                <label>@lang('user::profile.profile.picture')</label>

                                <div class="ui grid">
                                    <div class="two wide column">
                                        <img class="ui tiny bordered image" src="{{ $user->profile->present()->avatar }}"
                                             id="userProfilePicture">
                                    </div>
                                    <div class="fourteen wide column">

                                        <button class="ui basic button" id="uploadImageButton">
                                            @lang('user::profile.profile.upload new profile picture')
                                        </button>
                                        <div class="ui basic loading button" id="uploadInProgress">Loading</div>
                                        <p> @lang('core::messages.info.upload picture by drag and drop')</p>

                                    </div>

                                </div>
                            </div>

                            <div class="ui divider"></div>

                            <div class="required field {{ $errors->has('first_name') ? 'error' : '' }}">
                                <label for="first_name">@lang('user::users.form.first-name')</label>
                                <input type="text"
                                       id="first_name"
                                       name="first_name"
                                       value="{{ old('first_name', isset($user)?$user->first_name:null ) }}"
                                       placeholder="@lang('user::users.form.first-name')"
                                       disabled
                                >

                                {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="required field {{ $errors->has('last_name') ? 'error' : '' }}">
                                <label for="first_name">@lang('user::users.form.last-name')</label>
                                <input type="text"
                                       id="last_name"
                                       name="last_name"
                                       value="{{ old('last_name', isset($user)?$user->last_name:null) }}"
                                       placeholder="@lang('user::users.form.last-name')"
                                       disabled
                                >

                                {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="required field {{ $errors->has('email') ? 'error' : '' }}">
                                <label for="email">@lang('user::users.form.email')</label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email',isset($user)?$user->email:null) }}"
                                       placeholder="@lang('user::users.form.email')">

                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>

                        </div>
                        <div class="ui bottom attached segment">

                            <button type="submit" class="ui primary button">
                                {{ trans('core::elements.button.update') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="ui tab" data-tab="password">
                    <form class="ui form" role="form" method="POST" action="{{route('backend::user.profile.update.password', ['id' => $user->id])}}">
                        <h5 class="ui top attached header">
                            {{ method_field('PUT') }}
                            {!! csrf_field() !!}
                            <div class="content">
                                @lang('user::profile.password.change password')
                            </div>
                        </h5>
                        <div class="ui attached segment">

                            <div class="field">
                                <label>@lang('user::profile.password.old password')</label>
                                <input type="password" name="old_password" placeholder="">
                            </div>
                            <div class="field">
                                <label>@lang('user::profile.password.new password')</label>
                                <input type="password" name="password" placeholder="">
                            </div>
                            <div class="field">
                                <label>@lang('user::profile.password.confirm new password')</label>
                                <input type="password" name="password_confirmation" placeholder="">
                            </div>

                        </div>
                        <div class="ui bottom attached segment">

                            <button type="submit" class="ui primary button">
                                {{ trans('core::elements.button.update') }}
                            </button>
                        </div>
                    </form>
                </div>

        </div>
    </div>


@endsection

@section('javascript')
    <script>$('.tabular.menu .item').tab();</script>
    <script>

        var dragAndDropModule = new fineUploader.DragAndDrop({
            dropZoneElements: [document.getElementById('profileContainer')],
            callbacks: {
                processingDroppedFilesComplete: function (files, dropTarget) {
                    fineUploaderBasicInstanceImages.addFiles(files);
                }
            }
        });

        var fineUploaderBasicInstanceImages = new fineUploader.FineUploaderBasic({
            button: document.getElementById('uploadImageButton'),
            request: {
                endpoint: '{{ apiRoute('v1', 'api.user.profile.store', ['profile' => $user->id])}}',
                inputName: 'image',
                customHeaders: {
                    "Authorization": "Bearer {{$jwtoken}}"
                }
            },
            callbacks: {
                onComplete: function (id, name, responseJSON) {
                    VueInstanceImage.complete(responseJSON)
                },
                onUpload: function () {
                    $('#uploadImageButton').hide();
                    $('#uploadInProgress').show();
                },
                onAllComplete: function (succeeded, failed) {
                    $('#uploadImageButton').show();
                    $('#uploadInProgress').hide();
                }
            }
        });

        $('#uploadInProgress').hide();
        VueInstanceImage = new Vue({
            el: '#profileContainer',
            data: {},
            ready: function () {

            },
            methods: {
                complete: function (responseJSON) {
                    $('#userProfilePicture').attr("src", responseJSON.data.thumbnail.square);
                    $('#sidebarUserProfilePicture').attr("src", responseJSON.data.thumbnail.square);
                }
            }

        });


    </script>
@endsection
