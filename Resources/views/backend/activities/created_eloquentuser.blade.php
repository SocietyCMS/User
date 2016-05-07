<div class="event {{$activity->privacy}}">
    <div class="label">
        <i class="user icon"></i>
    </div>
    <div class="content">
        <div class="summary">
            {{trans('user::activities.created_object',['user' => $activity->subject->present()->fullname,])}}
            <div class="date">
                {{$activity->created_at->diffForHumans()}}
            </div>
        </div>
        <div class="extra text">

        </div>
    </div>
</div>