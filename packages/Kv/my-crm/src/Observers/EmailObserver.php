<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\Email;

class EmailObserver
{
    /**
     * Handle the email "creating" event.
     *
     * @param  \Kv\MyCrm\Email  $email
     * @return void
     */
    public function creating(Email $email)
    {
        $email->external_id = Uuid::uuid4()->toString();

        if (! app()->runningInConsole()) {
            $email->user_created_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the email "created" event.
     *
     * @param  \Kv\MyCrm\Models\Email  $email
     * @return void
     */
    public function created(Email $email)
    {
        //
    }

    /**
     * Handle the email "updating" event.
     *
     * @param  \Kv\MyCrm\Email  $email
     * @return void
     */
    public function updating(Email $email)
    {
        if (! app()->runningInConsole()) {
            $email->user_updated_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the email "updated" event.
     *
     * @param  \Kv\MyCrm\Models\Email  $email
     * @return void
     */
    public function updated(Email $email)
    {
        //
    }

    /**
     * Handle the email "deleting" event.
     *
     * @param  \Kv\MyCrm\Email  $email
     * @return void
     */
    public function deleting(Email $email)
    {
        if (! app()->runningInConsole()) {
            $email->user_deleted_id = auth()->user()->id ?? null;
            $email->saveQuietly();
        }
    }

    /**
     * Handle the email "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Email  $email
     * @return void
     */
    public function deleted(Email $email)
    {
        //
    }

    /**
     * Handle the email "restored" event.
     *
     * @param  \Kv\MyCrm\Models\Email  $email
     * @return void
     */
    public function restored(Email $email)
    {
        if (! app()->runningInConsole()) {
            $email->user_restored_id = auth()->user()->id ?? null;
            $email->saveQuietly();
        }
    }

    /**
     * Handle the email "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Email  $email
     * @return void
     */
    public function forceDeleted(Email $email)
    {
        //
    }
}
