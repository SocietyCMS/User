<?php

namespace Modules\User\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;
use Laravolt\Avatar\Facade as Avatar;

/**
 * Class UserPresenter.
 */
class UserPresenter extends Presenter
{
    /**
     * @return string
     */
    public function fullname()
    {
        return $this->first_name.' '.$this->last_name;
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
        if (! $this->created_at || $this->created_at == '0000-00-00 00:00:00') {
            return;
        }

        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)
            ->formatLocalized('%d %b. %Y');
    }

    /**
     * @return string
     */
    public function updatedAt()
    {
        if (! $this->updated_at || $this->updated_at == '0000-00-00 00:00:00') {
            return;
        }

        return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)
            ->formatLocalized('%d %b. %Y');
    }

    /**
     * @return string
     */
    public function lastLogin()
    {
        if (! $this->last_login || $this->last_login == '0000-00-00 00:00:00') {
            return;
        }

        return Carbon::createFromFormat('Y-m-d H:i:s', $this->last_login)
                ->diffForHumans();
    }
}
