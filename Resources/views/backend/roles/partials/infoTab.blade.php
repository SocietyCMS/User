<div class="required field {{ $errors->has('name') ? 'error' : '' }}">
    <label for="name">@lang('user::roles.form.name')</label>
    <input type="text"
           id="name"
           name="name"
           value="{{ old('name',isset($role)?$role->name:null ) }}"
           placeholder="@lang('user::roles.form.name')">

    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
</div>

<div class="field">
    <label>{{ trans('user::roles.title.users with this roles') }}</label>
    <select class="ui fluid search dropdown" multiple="" name="users[]" id="usersMultiselect">
        @foreach ($users as $user)
            <option value="{{ $user->id }}" @if(isset($role) && $user->hasRoleId($role->id)) selected @endif >{{ $user->present()->fullname }}</option>
        @endforeach
    </select>
</div>
