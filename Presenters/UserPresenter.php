<?php

namespace Modules\User\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;
use Laravolt\Avatar\Facade as Avatar;


/**
 * Class UserPresenter
 * @package Modules\User\Presenters
 */
class UserPresenter extends Presenter
{
    /**
     * @return string
     */
    public function fullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return mixed
     */
    public function avatar()
    {
        return $this->entity->getFirstMediaUrl('profile', 'square') ?: Avatar::create($this->fullname())->toBase64();
    }

    /**
     * @return string
     */
    public function createdAt()
    {
        $created = $this->created_at;

        return Carbon::createFromFormat('Y-m-d H:i:s', $created)
            ->formatLocalized('%d %b. %Y');
    }

    /**
     * @return string
     */
    public function updatedAt()
    {
        $updated = $this->updated_at;

        return Carbon::createFromFormat('Y-m-d H:i:s', $updated)
            ->formatLocalized('%d %b. %Y');
    }

    /**
     * @return string
     */
    public function lastLogin()
    {
        if ($this->last_login) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->last_login)
                ->diffForHumans();
        }
    }
}
