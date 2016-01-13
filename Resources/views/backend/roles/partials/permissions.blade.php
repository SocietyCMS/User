@foreach ($permissions as $name => $value)
    <h2 class="ui dividing header">{{ ucfirst($name) }}</h2>

    @foreach ($value as $subPermissionTitle => $permissionActions)

        @if (count($value) > 1 )
            <h4 class="ui header">{{ ucfirst($subPermissionTitle) }}</h4>
        @endif

        <div class="ui four column  stackable divided grid segment">
            @foreach ($permissionActions as $permissionAction => $permission)
                <div class="column">
                    <div class="ui toggle checkbox">
                        <input type="checkbox"
                               id="{{ "$name.$subPermissionTitle.$permissionAction" }}"
                               name="permissions[{{ "$name.$subPermissionTitle.$permissionAction" }}]"
                               @if(isset($model) && $model->hasPermission("$name.$subPermissionTitle.$permissionAction")) checked="checked" @endif
                               value="true" >
                        <label for="{{"$name.$subPermissionTitle.$permissionAction"}}">{{ ucfirst($permissionAction) }}</label>
                    </div>
                </div>
            @endforeach
        </div>

    @endforeach

@endforeach
