<?php

namespace Modules\User\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

/**
 * Class UserProfilePresenter
 * @package Modules\User\Presenters
 */
class UserProfilePresenter extends Presenter
{

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

        return $this->entity->getFirstMediaUrl('profile', 'square')?:"http://semantic-ui.com/images/avatar/large/elliot.jpg";
    }

    /**
     * @return mixed
     */
    public function largeAvatar()
    {
        return $this->entity->getFirstMediaUrl('profile', 'original250')?:"http://semantic-ui.com/images/avatar/large/elliot.jpg";
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

}
