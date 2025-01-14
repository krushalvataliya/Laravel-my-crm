<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\XeroInvoice;

class XeroInvoiceObserver
{
    /**
     * Handle the xeroInvoice "creating" event.
     *
     * @param  \Kv\MyCrm\Models\XeroInvoice  $xeroInvoice
     * @return void
     */
    public function creating(XeroInvoice $xeroInvoice)
    {
        $xeroInvoice->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the xeroInvoice "created" event.
     *
     * @param  \Kv\MyCrm\Models\XeroInvoice  $xeroInvoice
     * @return void
     */
    public function created(XeroInvoice $xeroInvoice)
    {
        //
    }

    /**
     * Handle the xeroInvoice "updating" event.
     *
     * @param  \Kv\MyCrm\Models\XeroInvoice  $xeroInvoice
     * @return void
     */
    public function updating(XeroInvoice $xeroInvoice)
    {
        //
    }

    /**
     * Handle the xeroInvoice "updated" event.
     *
     * @param  \Kv\MyCrm\Models\XeroInvoice  $xeroInvoice
     * @return void
     */
    public function updated(XeroInvoice $xeroInvoice)
    {
        //
    }

    /**
     * Handle the xeroInvoice "deleting" event.
     *
     * @param  \Kv\MyCrm\XeroInvoice  $xeroInvoice
     * @return void
     */
    public function deleting(XeroInvoice $xeroInvoice)
    {
        //
    }

    /**
     * Handle the xeroInvoice "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\XeroInvoice  $xeroInvoice
     * @return void
     */
    public function deleted(XeroInvoice $xeroInvoice)
    {
        //
    }

    /**
     * Handle the xeroInvoice "restored" event.
     *
     * @param  \Kv\MyCrm\Models\XeroInvoice  $xeroInvoice
     * @return void
     */
    public function restored(XeroInvoice $xeroInvoice)
    {
        //
    }

    /**
     * Handle the xeroInvoice "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\XeroInvoice  $xeroInvoice
     * @return void
     */
    public function forceDeleted(XeroInvoice $xeroInvoice)
    {
        //
    }
}
