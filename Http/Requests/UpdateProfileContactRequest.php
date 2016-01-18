<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Contracts\Authentication;

class UpdateProfileContactRequest extends FormRequest
{
    public function rules()
    {
        return [
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
