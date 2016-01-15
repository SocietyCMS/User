@foreach ($permissions as $name => $permissionGroup)
    <h2 class="ui dividing header">{{ ucfirst($name) }}</h2>

    <table class="ui compact celled definition table">
        <thead>
        <tr>
            <th></th>
            <th>Permission</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($permissionGroup as  $permission)
            <tr>
                <td class="collapsing">
                    <div class="ui fitted toggle checkbox">
                        <input type="checkbox"
                               id="{{ $permission->name }}"
                               name="permissions[{{ $permission->id }}]"
                               @if(isset($model) && $model->hasPermission($permission->name)) checked="checked" @endif
                               value="true" ><label></label>
                    </div>
                </td>
                <td>
                    <h4 class="ui left floated header">
                        <div class="content">
                            @lang($permission->display_name)

                            <div class="sub header">
                                @lang($permission->description)
                            </div>
                        </div>
                    </h4>
                </td>
            </tr>
        @endforeach
    </table>

@endforeach
