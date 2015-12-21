<?php

namespace Modules\User\Events\Handlers;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Modules\User\Events\UserHasBegunResetProcess;
use Setting;

class SendResetCodeEmail
{
    public function handle(UserHasBegunResetProcess $event)
    {
        $user = $event->user;
        $code = $event->code;

        Mail::queue('user::emails.reminder', compact('user', 'code'), function (Message $message) use ($user) {
            $message->from(Setting::get('core::mail-from'),Setting::get('core::site-name'));
            $message->to($user->email)->subject('Reset your account password.');
        });
    }
}
