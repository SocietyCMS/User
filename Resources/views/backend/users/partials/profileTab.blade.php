<div class="field {{ $errors->has('title') ? 'error' : '' }}">
    <label for="gender">@lang('user::users.form.title')</label>

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

<div class="field {{ $errors->has('description') ? 'error' : '' }}">
    <label for="description">@lang('user::users.form.description')</label>
    <textarea id="description"
              name="description"
              rows="2">{{ old('description', isset($user)?$user->description:null ) }}</textarea>

    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
</div>

<div class="field {{ $errors->has('office') ? 'error' : '' }}">
    <label for="office">@lang('user::users.form.office')</label>
    <input type="text"
           id="office"
           name="office"
           value="{{ old('office', isset($user)?$user->office:null) }}"
           placeholder="@lang('user::users.form.office')">

    {!! $errors->first('office', '<span class="help-block">:message</span>') !!}
</div>

<div class="field {{ $errors->has('bio') ? 'error' : '' }}">
    <label for="bio">@lang('user::users.form.bio')</label>
    <input type="text"
           id="bio"
           name="bio"
           value="{{ old('bio', isset($user)?$user->bio:null) }}"
           placeholder="@lang('user::users.form.bio')">

    {!! $errors->first('bio', '<span class="help-block">:message</span>') !!}
</div>

<div class="field {{ $errors->has('street') ? 'error' : '' }}">
    <label for="street">@lang('user::users.form.street')</label>
    <input type="text"
           id="street"
           name="street"
           value="{{ old('street', isset($user)?$user->street:null) }}"
           placeholder="@lang('user::users.form.street')">

    {!! $errors->first('street', '<span class="help-block">:message</span>') !!}
</div>

<div class="field {{ $errors->has('city') ? 'error' : '' }}">
    <label for="city">@lang('user::users.form.city')</label>
    <input type="text"
           id="city"
           name="city"
           value="{{ old('city', isset($user)?$user->city:null) }}"
           placeholder="@lang('user::users.form.city')">

    {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
</div>