<div class="ui tab active" data-tab="profile">
    <form class="ui form" role="form" method="POST" action="{{route('backend::user.profile.update.user')}}">
        <h5 class="ui top attached header">
            {{ method_field('PUT') }}
            {!! csrf_field() !!}
            <div class="content">
                {{ $user->present()->fullname }}
            </div>
        </h5>
        <div class="ui attached segment">
            @if(\Entrust::can('user::change-own-profile-picture'))
                <div class="field">
                    <label>@lang('user::profile.profile.picture')</label>

                    <div class="ui grid">
                        <div class="two wide column">
                            <img class="ui small bordered image" src="{{ $user->present()->avatar }}"
                                 id="userProfilePicture">
                        </div>
                        <div class="fourteen wide column">

                            <a class="ui basic button" id="uploadImageButton">
                                @lang('user::profile.profile.upload new profile picture')
                            </a>
                            <div class="ui basic loading button" id="uploadInProgress">Loading</div>
                            <p>@lang('user::profile.message.upload profile picture by drag-drop')</p>

                        </div>

                    </div>
                </div>

                <div class="ui divider"></div>
            @endif

            <div class="required field {{ $errors->has('first_name') ? 'error' : '' }}">
                <label for="first_name">@lang('user::users.form.first-name')</label>
                <input type="text"
                       id="first_name"
                       name="first_name"
                       value="{{ old('first_name', isset($user)?$user->first_name:null ) }}"
                       placeholder="@lang('user::users.form.first-name')"
                       @if(!\Entrust::can('user::change-own-name'))
                       disabled
                        @endif
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
                       @if(!\Entrust::can('user::change-own-name'))
                       disabled
                        @endif
                >

                {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="required field {{ $errors->has('email') ? 'error' : '' }}">
                <label for="email">@lang('user::users.form.email')</label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email',isset($user)?$user->email:null) }}"
                       placeholder="@lang('user::users.form.email')"
                       @if(!\Entrust::can('user::change-own-email'))
                       disabled
                        @endif
                >
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
