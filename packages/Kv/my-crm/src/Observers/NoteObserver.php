<?php

namespace Kv\MyCrm\Observers;

use Kv\MyCrm\Models\Note;

class NoteObserver
{
    /**
     * Handle the note "creating" event.
     *
     * @param  \Kv\MyCrm\Models\Note  $note
     * @return void
     */
    public function creating(Note $note)
    {
        if (! app()->runningInConsole()) {
            $note->user_created_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the note "created" event.
     *
     * @param  \Kv\MyCrm\Models\Note  $note
     * @return void
     */
    public function created(Note $note)
    {
        //
    }

    /**
     * Handle the note "updating" event.
     *
     * @param  \Kv\MyCrm\Models\Note  $note
     * @return void
     */
    public function updating(Note $note)
    {
        if (! app()->runningInConsole()) {
            $note->user_updated_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the note "updated" event.
     *
     * @param  \Kv\MyCrm\Models\Note  $note
     * @return void
     */
    public function updated(Note $note)
    {
        //
    }

    /**
     * Handle the note "deleting" event.
     *
     * @param  \Kv\MyCrm\Models\Note  $note
     * @return void
     */
    public function deleting(Note $note)
    {
        if (! app()->runningInConsole()) {
            $note->user_deleted_id = auth()->user()->id ?? null;
            $note->saveQuietly();

            if ($note->activity) {
                $note->activity->delete();
            }
        }
    }

    /**
     * Handle the note "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Note  $note
     * @return void
     */
    public function deleted(Note $note)
    {
        //
    }

    /**
     * Handle the note "restoring" event.
     *
     * @param  \Kv\MyCrm\Models\Note  $note
     * @return void
     */
    public function restoring(Note $note)
    {
    }

    /**
     * Handle the note "restored" event.
     *
     * @param  \Kv\MyCrm\Models\Note  $note
     * @return void
     */
    public function restored(Note $note)
    {
        if (! app()->runningInConsole()) {
            $note->user_restored_id = auth()->user()->id ?? null;
            $note->saveQuietly();
        }
    }

    /**
     * Handle the note "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Note  $note
     * @return void
     */
    public function forceDeleted(Note $note)
    {
        //
    }
}
