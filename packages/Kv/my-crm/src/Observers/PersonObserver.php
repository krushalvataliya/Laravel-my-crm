<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\Person;

class PersonObserver
{
    /**
     * Handle the person "creating" event.
     *
     * @param  \Kv\MyCrm\Person  $person
     * @return void
     */
    public function creating(Person $person)
    {
        $person->external_id = Uuid::uuid4()->toString();

        if (! app()->runningInConsole()) {
            $person->user_created_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the person "created" event.
     *
     * @param  \Kv\MyCrm\Person  $person
     * @return void
     */
    public function created(Person $person)
    {
        //
    }

    /**
     * Handle the person "updating" event.
     *
     * @param  \Kv\MyCrm\Person  $person
     * @return void
     */
    public function updating(Person $person)
    {
        if (! app()->runningInConsole()) {
            $person->user_updated_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the person "updated" event.
     *
     * @param  \Kv\MyCrm\Person  $person
     * @return void
     */
    public function updated(Person $person)
    {
        //
    }

    /**
     * Handle the person "deleting" event.
     *
     * @param  \Kv\MyCrm\Person  $person
     * @return void
     */
    public function deleting(Person $person)
    {
        if (! app()->runningInConsole()) {
            $person->user_deleted_id = auth()->user()->id ?? null;
            $person->saveQuietly();
        }
    }

    /**
     * Handle the person "deleted" event.
     *
     * @param  \Kv\MyCrm\Person  $person
     * @return void
     */
    public function deleted(Person $person)
    {
        //
    }

    /**
     * Handle the person "restoring" event.
     *
     * @param  \Kv\MyCrm\Person  $person
     * @return void
     */
    public function restoring(Person $person)
    {
    }

    /**
     * Handle the person "restored" event.
     *
     * @param  \Kv\MyCrm\Person  $person
     * @return void
     */
    public function restored(Person $person)
    {
        if (! app()->runningInConsole()) {
            $person->user_restored_id = auth()->user()->id ?? null;
            $person->saveQuietly();
        }
    }

    /**
     * Handle the person "force deleted" event.
     *
     * @param  \Kv\MyCrm\Person  $person
     * @return void
     */
    public function forceDeleted(Person $person)
    {
        //
    }
}
