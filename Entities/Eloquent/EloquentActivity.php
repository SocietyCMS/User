<?php namespace Modules\User\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentActivity extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user__activities';


    protected $fillable = ['subject_id', 'subject_type', 'name', 'user_id', 'template'];

    public function user()
    {
        $driver = config('society.user.config.driver', 'Sentinel');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\EloquentUser", 'user_id');
    }

    public function subject()
    {
        return $this->morphTo();
    }

}
