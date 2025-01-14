<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\File;

class FileObserver
{
    /**
     * Handle the file "creating" event.
     *
     * @param  \Kv\MyCrm\Models\File  $file
     * @return void
     */
    public function creating(File $file)
    {
        $file->external_id = Uuid::uuid4()->toString();

        if (! app()->runningInConsole()) {
            $file->user_created_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the file "created" event.
     *
     * @param  \Kv\MyCrm\Models\File  $file
     * @return void
     */
    public function created(File $file)
    {
        //
    }

    /**
     * Handle the file "updating" event.
     *
     * @param  \Kv\MyCrm\Models\File  $file
     * @return void
     */
    public function updating(File $file)
    {
        if (! app()->runningInConsole()) {
            $file->user_updated_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the file "updated" event.
     *
     * @param  \Kv\MyCrm\Models\File  $file
     * @return void
     */
    public function updated(File $file)
    {
        //
    }

    /**
     * Handle the file "deleting" event.
     *
     * @param  \Kv\MyCrm\File  $file
     * @return void
     */
    public function deleting(File $file)
    {
        if (! app()->runningInConsole()) {
            $file->user_deleted_id = auth()->user()->id ?? null;
            $file->saveQuietly();

            if ($file->activity) {
                $file->activity->delete();
            }
        }
    }

    /**
     * Handle the file "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\File  $file
     * @return void
     */
    public function deleted(File $file)
    {
        //
    }

    /**
     * Handle the file "restored" event.
     *
     * @param  \Kv\MyCrm\Models\File  $file
     * @return void
     */
    public function restored(File $file)
    {
        if (! app()->runningInConsole()) {
            $file->user_deleted_id = auth()->user()->id ?? null;
            $file->saveQuietly();
        }
    }

    /**
     * Handle the file "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\File  $file
     * @return void
     */
    public function forceDeleted(File $file)
    {
        //
    }
}
