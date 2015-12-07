<?php

namespace Modules\User\Entities\Sentinel;

use Cartalyst\Sentinel\Activations\ActivationInterface;
use Cartalyst\Sentinel\Activations\EloquentActivation as SentinelActivation;

class EloquentActivation extends SentinelActivation implements ActivationInterface
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'user__activations';
}
