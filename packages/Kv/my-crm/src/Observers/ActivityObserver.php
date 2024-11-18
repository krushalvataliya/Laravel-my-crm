<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\Activity;

class ActivityObserver
{
    /**
     * Handle the activity "creating" event.
     *
     * @param  \Kv\MyCrm\Activity  $activity
     * @return void
     */
    public function creating(Activity $activity)
    {
        $activity->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the activity "created" event.
     *
     * @param  \Kv\MyCrm\Models\Activity  $activity
     * @return void
     */
    public function created(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "updating" event.
     *
     * @param  \Kv\MyCrm\Activity  $activity
     * @return void
     */
    public function updating(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "updated" event.
     *
     * @param  \Kv\MyCrm\Models\Activity  $activity
     * @return void
     */
    public function updated(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "deleting" event.
     *
     * @param  \Kv\MyCrm\Activity  $activity
     * @return void
     */
    public function deleting(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Activity  $activity
     * @return void
     */
    public function deleted(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "restored" event.
     *
     * @param  \Kv\MyCrm\Models\Activity  $activity
     * @return void
     */
    public function restored(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Activity  $activity
     * @return void
     */
    public function forceDeleted(Activity $activity)
    {
        //
    }
}
