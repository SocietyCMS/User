<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Contracts\Authentication;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
        ];
    }

    public function authorize(Authentication $auth)
    {
        $userId = $this->route('id');

        return $auth->check()->id == $userId;
    }

    public function messages()
    {
        return [];
    }
}
