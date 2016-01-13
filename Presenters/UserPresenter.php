<?php

namespace Modules\User\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * @return string
     */
    public function fullname()
    {
        return $this->name ?: $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return mixed
     */
    public function avatar()
    {
        return $this->smallAvatar();
    }

    /**
     * @return mixed
     */
    public function smallAvatar()
    {

        return $this->entity->getFirstMediaUrl('profile', 'square') ?: "http://semantic-ui.com/images/avatar/large/elliot.jpg";
    }

    /**
     * @return mixed
     */
    public function largeAvatar()
    {
        return $this->entity->getFirstMediaUrl('profile', 'original250') ?: "http://semantic-ui.com/images/avatar/large/elliot.jpg";
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
