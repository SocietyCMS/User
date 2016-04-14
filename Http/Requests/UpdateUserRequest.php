<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        $userId = $this->route()->getParameter('users');

        $this->sanitize();

        return [
            'email'      => "required|email|unique:user__users,email,{$userId}",
            'first_name' => 'required',
            'last_name'  => 'required',
            'password'   => 'sometimes|required|confirmed',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function sanitize()
    {
        $input = $this->all();

        if (empty($input['password'])) {
            unset($input['password']);
            unset($input['password_confirmation']);
        }

        $this->replace($input);
    }
}
