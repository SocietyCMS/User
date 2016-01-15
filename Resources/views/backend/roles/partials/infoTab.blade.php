<div class="required field {{ $errors->has('name') ? 'error' : '' }}">
    <label for="display_name">@lang('user::roles.form.name')</label>
    <input type="text"
           id="display_name"
           name="display_name"
           value="{{ old('display_name',isset($role)?$role->display_name:null ) }}"
           placeholder="@lang('user::roles.form.name')">

    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
</div>

<div class="field {{ $errors->has('description') ? 'error' : '' }}">
    <label for="description">@lang('user::roles.form.description')</label>
    <input type="text"
           id="description"
           name="description"
           value="{{ old('description',isset($role)?$role->description:null ) }}"
           placeholder="@lang('user::roles.form.description')">

    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
</div>

<div class="field">
    <label>{{ trans('user::roles.title.users with this roles') }}</label>
    <select class="ui fluid search dropdown" multiple="" name="users[]" id="usersMultiselect">
        @foreach ($users as $user)
            <option value="{{ $user->id }}" @if(isset($role) && $user->hasRole($role->name)) selected @endif >{{ $user->present()->fullname }}</option>
        @endforeach
    </select>
</div>
