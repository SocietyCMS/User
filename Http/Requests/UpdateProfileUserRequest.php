<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Contracts\Authentication;

class UpdateProfileUserRequest extends FormRequest
{
    public function rules(Authentication $auth)
    {
        return [
            'email'      => "required|email|unique:user__users,email,{$auth->id()}",
            'first_name' => 'required',
            'last_name'  => 'required',
        ];
    }

    public function authorize(Authentication $auth)
    {
        return true;
    }

    public function messages()
    {
        return [];
    }
}
