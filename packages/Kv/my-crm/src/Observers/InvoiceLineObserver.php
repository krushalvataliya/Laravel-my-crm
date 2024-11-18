<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\InvoiceLine;

class InvoiceLineObserver
{
    /**
     * Handle the invoiceLine "creating" event.
     *
     * @param  \Kv\MyCrm\Models\InvoiceLine  $invoiceLine
     * @return void
     */
    public function creating(InvoiceLine $invoiceLine)
    {
        $invoiceLine->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the invoiceLine "created" event.
     *
     * @param  \Kv\MyCrm\Models\InvoiceLine  $invoiceLine
     * @return void
     */
    public function created(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Handle the invoiceLine "updating" event.
     *
     * @param  \Kv\MyCrm\Models\InvoiceLine  $invoiceLine
     * @return void
     */
    public function updating(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Handle the invoiceLine "updated" event.
     *
     * @param  \Kv\MyCrm\Models\InvoiceLine  $invoiceLine
     * @return void
     */
    public function updated(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Handle the invoiceLine "deleting" event.
     *
     * @param  \Kv\MyCrm\InvoiceLine  $invoiceLine
     * @return void
     */
    public function deleting(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Handle the invoiceLine "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\InvoiceLine  $invoiceLine
     * @return void
     */
    public function deleted(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Handle the invoiceLine "restored" event.
     *
     * @param  \Kv\MyCrm\Models\InvoiceLine  $invoiceLine
     * @return void
     */
    public function restored(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Handle the invoiceLine "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\InvoiceLine  $invoiceLine
     * @return void
     */
    public function forceDeleted(InvoiceLine $invoiceLine)
    {
        //
    }
}
