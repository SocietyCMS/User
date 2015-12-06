
<div class="ui two column middle aligned very relaxed stackable grid">

    <div class="column">

        <h3 class="ui dividing header">{{ trans('user::users.new password setup') }}</h3>

        <div class="required field  @if($errors->has('password')) 'error' @endif">
            <label for="password">{{trans('user::users.form.new password')}}</label>
            <div class="ui left icon input">
                <input type="password" name="password" id="password">
                <i class="lock icon"></i>
            </div>
            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="required field @if( $errors->has('password_confirmation')) 'error' @endif">
            <label for="password_confirmation">{{trans('user::users.form.new password confirmation')}}</label>
            <div class="ui left icon input">
                <input type="password" name="password_confirmation" id="password_confirmation">
                <i class="lock icon"></i>
            </div>
            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
        </div>

    </div>
    <div class="ui vertical divider">
        @lang('core::elements.separator.or')
    </div>
    <div class="center aligned column">
        <div class="ui big pink labeled icon pupup button" data-content="Coming soon" data-variation="inverted">
            <i class="mail outline icon"></i>
            {{ trans('user::users.send reset password email') }}
        </div>
    </div>

</div>
