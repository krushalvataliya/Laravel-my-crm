<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\Contact;

class ContactObserver
{
    /**
     * Handle the contact "creating" event.
     *
     * @param  \Kv\MyCrm\Contact  $contact
     * @return void
     */
    public function creating(Contact $contact)
    {
        $contact->external_id = Uuid::uuid4()->toString();

        if (! app()->runningInConsole()) {
            $contact->user_created_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the contact "created" event.
     *
     * @param  \Kv\MyCrm\Models\Contact  $contact
     * @return void
     */
    public function created(Contact $contact)
    {
        //
    }

    /**
     * Handle the contact "updating" event.
     *
     * @param  \Kv\MyCrm\Contact  $contact
     * @return void
     */
    public function updating(Contact $contact)
    {
        if (! app()->runningInConsole()) {
            $contact->user_updated_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the contact "updated" event.
     *
     * @param  \Kv\MyCrm\Models\Contact  $contact
     * @return void
     */
    public function updated(Contact $contact)
    {
        //
    }

    /**
     * Handle the contact "deleting" event.
     *
     * @param  \Kv\MyCrm\Contact  $contact
     * @return void
     */
    public function deleting(Contact $contact)
    {
        if (! app()->runningInConsole()) {
            $contact->user_deleted_id = auth()->user()->id ?? null;
            $contact->saveQuietly();
        }
    }

    /**
     * Handle the contact "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Contact  $contact
     * @return void
     */
    public function deleted(Contact $contact)
    {
        //
    }

    /**
     * Handle the contact "restored" event.
     *
     * @param  \Kv\MyCrm\Models\Contact  $contact
     * @return void
     */
    public function restored(Contact $contact)
    {
        if (! app()->runningInConsole()) {
            $contact->user_restored_id = auth()->user()->id ?? null;
            $contact->saveQuietly();
        }
    }

    /**
     * Handle the contact "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Contact  $contact
     * @return void
     */
    public function forceDeleted(Contact $contact)
    {
        //
    }
}
