<div class="ui tab" data-tab="contact">
    <form class="ui form" role="form" method="POST" action="{{route('backend::user.profile.update.contact')}}">
        <h5 class="ui top attached header">
            {{ method_field('PUT') }}
            {!! csrf_field() !!}
            <div class="content">
                @lang('user::profile.title.contact information')
            </div>
        </h5>
        <div class="ui attached segment">

            <div class="field {{ $errors->has('title') ? 'error' : '' }}">
                <label for="gender">@lang('user::profile.profile.title')</label>

                <div class="ui search selection dropdown additions">
                    <input name="title" type="hidden" value="{{ old('title', isset($user)?$user->title:null ) }}">
                    <i class="dropdown icon"></i>
                    <div class="text">{{ old('title', isset($user)?$user->title:null ) }}</div>
                    <div class="menu">
                        @foreach(trans('user::users.personTitle') as $key => $lang )
                            <div class="item" data-value="{{$lang}}">{{$lang}}</div>
                        @endforeach
                    </div>
                </div>

                {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="field {{ $errors->has('office') ? 'error' : '' }}">
                <label for="office">@lang('user::profile.profile.office')</label>
                <input type="text"
                       id="office"
                       name="office"
                       value="{{ old('office', isset($user)?$user->office:null) }}"
                       placeholder="@lang('user::profile.profile.office')">

                {!! $errors->first('office', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="field {{ $errors->has('bio') ? 'error' : '' }}">
                <label for="bio">@lang('user::profile.profile.bio')</label>
                <input type="text"
                       id="bio"
                       name="bio"
                       value="{{ old('bio', isset($user)?$user->bio:null) }}"
                       placeholder="@lang('user::profile.profile.bio')">

                {!! $errors->first('bio', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="field {{ $errors->has('street') ? 'error' : '' }}">
                <label for="street">@lang('user::profile.profile.street')</label>
                <input type="text"
                       id="street"
                       name="street"
                       value="{{ old('street', isset($user)?$user->street:null) }}"
                       placeholder="@lang('user::profile.profile.street')">

                {!! $errors->first('street', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="two fields">
                <div class="four wide field {{ $errors->has('zip') ? 'error' : '' }}">
                    <label for="zip">@lang('user::profile.profile.zip')</label>
                    <input type="text"
                           id="zip"
                           name="zip"
                           value="{{ old('zip', isset($user)?$user->zip:null) }}"
                           placeholder="@lang('user::profile.profile.zip')">

                    {!! $errors->first('zip', '<span class="help-block">:message</span>') !!}
                </div>

                <div class="twelve wide field {{ $errors->has('city') ? 'error' : '' }}">
                    <label for="city">@lang('user::profile.profile.city')</label>
                    <input type="text"
                           id="city"
                           name="city"
                           value="{{ old('city', isset($user)?$user->city:null) }}"
                           placeholder="@lang('user::profile.profile.city')">

                    {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="field {{ $errors->has('country') ? 'error' : '' }}">
                <label for="country">@lang('user::profile.profile.country')</label>
                <input type="text"
                       id="country"
                       name="country"
                       value="{{ old('country', isset($user)?$user->country:null) }}"
                       placeholder="@lang('user::profile.profile.country')">

                {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="field {{ $errors->has('phone') ? 'error' : '' }}">
                <label for="phone">@lang('user::profile.profile.phone')</label>
                <input type="text"
                       id="phone"
                       name="phone"
                       value="{{ old('phone', isset($user)?$user->phone:null) }}"
                       placeholder="@lang('user::profile.profile.phone')">

                {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="field {{ $errors->has('mobile') ? 'error' : '' }}">
                <label for="mobile">@lang('user::profile.profile.mobile')</label>
                <input type="text"
                       id="mobile"
                       name="mobile"
                       value="{{ old('mobile', isset($user)?$user->mobile:null) }}"
                       placeholder="@lang('user::profile.profile.mobile')">

                {!! $errors->first('mobile', '<span class="help-block">:message</span>') !!}
            </div>

        </div>
        <div class="ui bottom attached segment">

            <button type="submit" class="ui primary button">
                {{ trans('core::elements.button.update') }}
            </button>
        </div>
    </form>
</div>
