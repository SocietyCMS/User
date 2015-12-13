<?php

namespace Modules\User\Transformers;

use League\Fractal;
use Spatie\MediaLibrary\Media;

class ProfilePictureTransformer extends Fractal\TransformerAbstract
{
    public function transform(Media $profilePicture)
    {
        return [
            'id'        => $profilePicture->id,
            'name'      => $profilePicture->name,
            'file_name' => $profilePicture->file_name,
            'size'      => $profilePicture->size,
            'image'     => $profilePicture->getUrl(),
            'thumbnail' => [
                'square' => $profilePicture->getUrl('square'),
                'small'  => $profilePicture->getUrl('original180'),
                'medium' => $profilePicture->getUrl('original250'),
                'large'  => $profilePicture->getUrl('original400'),
            ],
        ];
    }
}
