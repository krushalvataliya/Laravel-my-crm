<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\LeadSource;

class LeadSourceObserver
{
    /**
     * Handle the leadSource "creating" event.
     *
     * @param  \Kv\MyCrm\Models\LeadSource  $leadSource
     * @return void
     */
    public function creating(LeadSource $leadSource)
    {
        $leadSource->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the leadSource "created" event.
     *
     * @param  \Kv\MyCrm\Models\LeadSource  $leadSource
     * @return void
     */
    public function created(LeadSource $leadSource)
    {
        //
    }

    /**
     * Handle the leadSource "updating" event.
     *
     * @param  \Kv\MyCrm\Models\LeadSource  $leadSource
     * @return void
     */
    public function updating(LeadSource $leadSource)
    {
        //
    }

    /**
     * Handle the leadSource "updated" event.
     *
     * @param  \Kv\MyCrm\Models\LeadSource  $leadSource
     * @return void
     */
    public function updated(LeadSource $leadSource)
    {
        //
    }

    /**
     * Handle the leadSource "deleting" event.
     *
     * @param  \Kv\MyCrm\LeadSource  $leadSource
     * @return void
     */
    public function deleting(LeadSource $leadSource)
    {
        //
    }

    /**
     * Handle the leadSource "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\LeadSource  $leadSource
     * @return void
     */
    public function deleted(LeadSource $leadSource)
    {
        //
    }

    /**
     * Handle the leadSource "restored" event.
     *
     * @param  \Kv\MyCrm\Models\LeadSource  $leadSource
     * @return void
     */
    public function restored(LeadSource $leadSource)
    {
        //
    }

    /**
     * Handle the leadSource "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\LeadSource  $leadSource
     * @return void
     */
    public function forceDeleted(LeadSource $leadSource)
    {
        //
    }
}
