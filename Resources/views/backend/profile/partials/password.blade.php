<div class="ui tab" data-tab="password">
    <form class="ui form" role="form" method="POST" action="{{route('backend::user.profile.update.password')}}">
        <h5 class="ui top attached header">
            {{ method_field('PUT') }}
            {!! csrf_field() !!}
            <div class="content">
                @lang('user::profile.password.change password')
            </div>
        </h5>
        <div class="ui attached segment">

            <div class="field">
                <label>@lang('user::profile.password.old password')</label>
                <input type="password" name="old_password" placeholder="">
            </div>
            <div class="field">
                <label>@lang('user::profile.password.new password')</label>
                <input type="password" name="password" placeholder="">
            </div>
            <div class="field">
                <label>@lang('user::profile.password.confirm new password')</label>
                <input type="password" name="password_confirmation" placeholder="">
            </div>

        </div>
        <div class="ui bottom attached segment">

            <button type="submit" class="ui primary button">
                {{ trans('core::elements.button.update') }}
            </button>
        </div>
    </form>
</div>
