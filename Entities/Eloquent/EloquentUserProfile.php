<?php

namespace Modules\User\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\Media\baseMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

/**
 * Class EloquentUserProfile
 * @package Modules\User\Entities\Eloquent
 */
class EloquentUserProfile extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    use PresentableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user__userprofiles';

    /**
     * @var array
     */
    protected $fillable = [
        'description',
        'office',
        'bio',
        'street',
        'city',
        'zip',
        'country',
        'phone',
        'mobile'
    ];

    /**
     * Presenter Class.
     *
     * @var string
     */
    protected $presenter = 'Modules\User\Presenters\UserProfilePresenter';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("Modules\\User\\Entities\\Entrust\\EloquentUser", 'user_id');
    }

    public function registerMediaConversions()
    {
        $this->addMediaConversion('square')
            ->setManipulations(['w' => 200, 'h' => 200, 'fit' => 'crop'])
            ->performOnCollections('profile');

        $this->addMediaConversion('original180')
            ->setManipulations(['w' => 180, 'h' => 180, 'fit' => 'max'])
            ->performOnCollections('profile');

        $this->addMediaConversion('original250')
            ->setManipulations(['w' => 250, 'h' => 250, 'fit' => 'max'])
            ->performOnCollections('profile');

        $this->addMediaConversion('original400')
            ->setManipulations(['w' => 400, 'h' => 400, 'fit' => 'max'])
            ->performOnCollections('profile');

    }
}
