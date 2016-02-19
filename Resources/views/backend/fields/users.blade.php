<div class="field">
    @if(!isset($label) || $label != false)
        <label>{{ isset($label)?$label:trans('user::roles.title.users with this roles') }}</label>
    @endif
    <select class="ui fluid search dropdown" multiple="" name="users[]" id="usersMultiselect" @if(isset($v_model)) v-model="{{$v_model}}"@endif @if(isset($v_change))v-on:change="{{$v_change}}"@endif>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" @if(isset($role) && $user->hasRole($role->name)) selected @endif >{{ $user->present()->fullname }}</option>
        @endforeach
    </select>
</div>
