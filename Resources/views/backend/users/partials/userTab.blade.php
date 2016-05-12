<div class="required field {{ $errors->has('first_name') ? 'error' : '' }}">
    <label for="first_name">@lang('user::users.form.first-name')</label>
    <input type="text"
           id="first_name"
           name="first_name"
           value="{{ old('first_name', isset($user)?$user->first_name:null ) }}"
           placeholder="@lang('user::users.form.first-name')">

    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
</div>

<div class="required field {{ $errors->has('last_name') ? 'error' : '' }}">
    <label for="first_name">@lang('user::users.form.last-name')</label>
    <input type="text"
           id="last_name"
           name="last_name"
           value="{{ old('last_name', isset($user)?$user->last_name:null) }}"
           placeholder="@lang('user::users.form.last-name')">

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
