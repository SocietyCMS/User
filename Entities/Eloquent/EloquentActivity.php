<?php

namespace Modules\User\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentActivity
 * @package Modules\User\Entities\Eloquent
 */
class EloquentActivity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user__activities';

    /**
     * @var array
     */
    protected $fillable = ['subject_id', 'subject_type', 'name', 'user_id', 'template'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['user'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        $driver = config('society.user.config.driver', 'Sentinel');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\EloquentUser", 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subject()
    {
        return $this->morphTo();
    }
}
