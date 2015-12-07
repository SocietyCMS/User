<?php

namespace Modules\User\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * Return the gravatar link for the users email.
     *
     * @param int $size
     *
     * @return string
     */
    public function gravatar($size = 90)
    {
        $email = md5($this->email);

        return "//www.gravatar.com/avatar/$email?s=$size";
    }

    /**
     * @return string
     */
    public function fullname()
    {
        return $this->name ?: $this->first_name.' '.$this->last_name;
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
