<?php

namespace Modules\User\Events\Handlers;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Modules\Core\Contracts\Authentication;
use Modules\User\Events\UserHasRegistered;
use Setting;

class SendRegistrationConfirmationEmail
{
    /**
     * @var AuthenticationRepository
     */
    private $auth;

    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(UserHasRegistered $event)
    {
        $user = $event->user;

        $activationCode = $this->auth->createActivation($user);

        $data = [
            'user'           => $user,
            'activationcode' => $activationCode,
        ];

        Mail::queue('user::emails.welcome', $data,
            function (Message $message) use ($user) {
                $message->from(Setting::get('core::mail-from'),Setting::get('core::site-name'));
                $message->to($user->email)->subject('Welcome.');
            }
        );
    }
}
