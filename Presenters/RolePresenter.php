<?php namespace Modules\User\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class RolePresenter extends Presenter
{
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
}
