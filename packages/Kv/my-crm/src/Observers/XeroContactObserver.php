<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\XeroContact;

class XeroContactObserver
{
    /**
     * Handle the xeroContact "creating" event.
     *
     * @param  \Kv\MyCrm\Models\XeroContact  $xeroContact
     * @return void
     */
    public function creating(XeroContact $xeroContact)
    {
        $xeroContact->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the xeroContact "created" event.
     *
     * @param  \Kv\MyCrm\Models\XeroContact  $xeroContact
     * @return void
     */
    public function created(XeroContact $xeroContact)
    {
        //
    }

    /**
     * Handle the xeroContact "updating" event.
     *
     * @param  \Kv\MyCrm\Models\XeroContact  $xeroContact
     * @return void
     */
    public function updating(XeroContact $xeroContact)
    {
        //
    }

    /**
     * Handle the xeroContact "updated" event.
     *
     * @param  \Kv\MyCrm\Models\XeroContact  $xeroContact
     * @return void
     */
    public function updated(XeroContact $xeroContact)
    {
        //
    }

    /**
     * Handle the xeroContact "deleting" event.
     *
     * @param  \Kv\MyCrm\XeroContact  $xeroContact
     * @return void
     */
    public function deleting(XeroContact $xeroContact)
    {
        //
    }

    /**
     * Handle the xeroContact "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\XeroContact  $xeroContact
     * @return void
     */
    public function deleted(XeroContact $xeroContact)
    {
        //
    }

    /**
     * Handle the xeroContact "restored" event.
     *
     * @param  \Kv\MyCrm\Models\XeroContact  $xeroContact
     * @return void
     */
    public function restored(XeroContact $xeroContact)
    {
        //
    }

    /**
     * Handle the xeroContact "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\XeroContact  $xeroContact
     * @return void
     */
    public function forceDeleted(XeroContact $xeroContact)
    {
        //
    }
}
