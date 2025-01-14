<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\Client;

class ClientObserver
{
    /**
     * Handle the client "creating" event.
     *
     * @param  \Kv\MyCrm\Client  $client
     * @return void
     */
    public function creating(Client $client)
    {
        $client->external_id = Uuid::uuid4()->toString();

        if (! app()->runningInConsole()) {
            $client->user_created_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the client "created" event.
     *
     * @param  \Kv\MyCrm\Client  $client
     * @return void
     */
    public function created(Client $client)
    {
        //
    }

    /**
     * Handle the client "updating" event.
     *
     * @param  \Kv\MyCrm\Client  $client
     * @return void
     */
    public function updating(Client $client)
    {
        if (! app()->runningInConsole()) {
            $client->user_updated_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the client "updated" event.
     *
     * @param  \Kv\MyCrm\Client  $client
     * @return void
     */
    public function updated(Client $client)
    {
        //
    }

    /**
     * Handle the client "deleting" event.
     *
     * @param  \Kv\MyCrm\Client  $client
     * @return void
     */
    public function deleting(Client $client)
    {
        if (! app()->runningInConsole()) {
            $client->user_deleted_id = auth()->user()->id ?? null;
            $client->saveQuietly();
        }
    }

    /**
     * Handle the client "deleted" event.
     *
     * @param  \Kv\MyCrm\Client  $client
     * @return void
     */
    public function deleted(Client $client)
    {
        //
    }

    /**
     * Handle the client "restoring" event.
     *
     * @param  \Kv\MyCrm\Client  $client
     * @return void
     */
    public function restoring(Client $client)
    {
    }

    /**
     * Handle the client "restored" event.
     *
     * @param  \Kv\MyCrm\Client  $client
     * @return void
     */
    public function restored(Client $client)
    {
        if (! app()->runningInConsole()) {
            $client->user_restored_id = auth()->user()->id ?? null;
            $client->saveQuietly();
        }
    }

    /**
     * Handle the client "force deleted" event.
     *
     * @param  \Kv\MyCrm\Client  $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }
}
