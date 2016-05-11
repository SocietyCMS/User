<?php
namespace Modules\User\Http\Controllers;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Modules\Core\Http\Controllers\PublicBaseController;
use Modules\User\Http\Requests\ResetCompleteRequest;
use Modules\User\Http\Requests\ResetRequest;

class PasswordController extends PublicBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords;


    protected $redirectPath;
    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.guest');
        $this->redirectPath = route(config('society.user.config.redirect_route_after_login'));
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
        return view('user::public.reset.begin');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param ResetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(ResetRequest $request)
    {
        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     * @return \Illuminate\Http\Response
     * @throws NotFoundHttpException
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('user::public.reset.complete')->with('token', $token);
    }

    /**
     * Reset the given user's password.
     *
     * @param  ResetCompleteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(ResetCompleteRequest $request)
    {
        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect($this->redirectPath())->with('status', trans($response));

            default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }
}