<div class="field">
    <label>{{ trans('user::users.tabs.roles') }}</label>
    <select class="ui fluid search dropdown" multiple="" name="roles[]" id="rolesMultiselect">
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @if(isset($user) && $user->hasRole($role->name)) selected @endif >{{ $role->display_name }}</option>
        @endforeach
    </select>
</div>
