<div class="field">
    @if(!isset($label) || $label != false)
        <label>{{ isset($label)?$label:trans('user::users.tabs.roles') }}</label>
    @endif
    <select class="ui fluid search dropdown" multiple="" name="roles[]" id="rolesMultiselect" @if(isset($v_model)) v-model="{{$v_model}}"@endif>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @if(isset($user) && $user->hasRole($role->name)) selected @endif >{{ $role->display_name }}</option>
        @endforeach
    </select>
</div>
