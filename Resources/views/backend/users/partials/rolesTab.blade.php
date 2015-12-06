<div class="field">
    <label>{{ trans('user::users.tabs.roles') }}</label>
    <select class="ui fluid search dropdown" multiple="" name="roles[]" id="rolesMultiselect">
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @if(isset($user) && $user->hasRoleId($role->id)) selected @endif >{{ $role->name }}</option>
        @endforeach
    </select>
</div>