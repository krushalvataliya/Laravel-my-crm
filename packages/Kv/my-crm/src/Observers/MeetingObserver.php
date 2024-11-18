<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\Meeting;

class MeetingObserver
{
    /**
     * Handle the meeting "creating" event.
     *
     * @param  \Kv\MyCrm\Models\Meeting  $meeting
     * @return void
     */
    public function creating(Meeting $meeting)
    {
        $meeting->external_id = Uuid::uuid4()->toString();

        if (! app()->runningInConsole()) {
            $meeting->user_created_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the meeting "created" event.
     *
     * @param  \Kv\MyCrm\Models\Meeting  $meeting
     * @return void
     */
    public function created(Meeting $meeting)
    {
        //
    }

    /**
     * Handle the meeting "updating" event.
     *
     * @param  \Kv\MyCrm\Models\Meeting  $meeting
     * @return void
     */
    public function updating(Meeting $meeting)
    {
        if (! app()->runningInConsole()) {
            $meeting->user_updated_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the meeting "updated" event.
     *
     * @param  \Kv\MyCrm\Models\Meeting  $meeting
     * @return void
     */
    public function updated(Meeting $meeting)
    {
        //
    }

    /**
     * Handle the meeting "deleting" event.
     *
     * @param  \Kv\MyCrm\Meeting  $meeting
     * @return void
     */
    public function deleting(Meeting $meeting)
    {
        if (! app()->runningInConsole()) {
            $meeting->user_deleted_id = auth()->user()->id ?? null;
            $meeting->saveQuietly();

            if ($meeting->activity) {
                $meeting->activity->delete();
            }
        }
    }

    /**
     * Handle the meeting "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Meeting  $meeting
     * @return void
     */
    public function deleted(Meeting $meeting)
    {
        //
    }

    /**
     * Handle the meeting "restored" event.
     *
     * @param  \Kv\MyCrm\Models\Meeting  $meeting
     * @return void
     */
    public function restored(Meeting $meeting)
    {
        if (! app()->runningInConsole()) {
            $meeting->user_deleted_id = auth()->user()->id ?? null;
            $meeting->saveQuietly();
        }
    }

    /**
     * Handle the meeting "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Meeting  $meeting
     * @return void
     */
    public function forceDeleted(Meeting $meeting)
    {
        //
    }
}
