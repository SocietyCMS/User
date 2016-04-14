<?php

namespace Modules\User\Transformers;

use League\Fractal;
use Modules\User\Entities\Entrust\EloquentUser;

class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(EloquentUser $user)
    {
        return [
            'id'         => (int) $user->id,
            'email'      => $user->email,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'last_login' => $user->last_login,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,

            'present' => [
                'fullname'  => $user->present()->fullname,
                'createdAt' => $user->present()->createdAt,
                'updatedAt' => $user->present()->updatedAt,
                'lastLogin' => $user->present()->lastLogin,
            ],
        ];
    }
}
