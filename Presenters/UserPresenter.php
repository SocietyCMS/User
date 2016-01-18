<?php

namespace Modules\User\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;
use Laravolt\Avatar\Facade as Avatar;


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
        return Avatar::create($this->fullname())->toBase64();
    }

    public function createdAt()
    {
        $created = $this->created_at;

        return Carbon::createFromFormat('Y-m-d H:i:s', $created)
            ->formatLocalized('%d %b. %Y');
    }

    public function updatedAt()
    {
        $updated = $this->updated_at;

        return Carbon::createFromFormat('Y-m-d H:i:s', $updated)
            ->formatLocalized('%d %b. %Y');
    }

    public function lastLogin()
    {
        if ($this->last_login) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->last_login)
                ->diffForHumans();
        }
    }
}
