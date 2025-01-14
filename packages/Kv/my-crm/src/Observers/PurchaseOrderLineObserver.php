<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\PurchaseOrderLine;

class PurchaseOrderLineObserver
{
    /**
     * Handle the purchaseOrderLine "creating" event.
     *
     * @param  \Kv\MyCrm\Models\PurchaseOrderLine  $purchaseOrderLine
     * @return void
     */
    public function creating(PurchaseOrderLine $purchaseOrderLine)
    {
        $purchaseOrderLine->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the purchaseOrderLine "created" event.
     *
     * @param  \Kv\MyCrm\Models\PurchaseOrderLine  $purchaseOrderLine
     * @return void
     */
    public function created(PurchaseOrderLine $purchaseOrderLine)
    {
        //
    }

    /**
     * Handle the purchaseOrderLine "updating" event.
     *
     * @param  \Kv\MyCrm\Models\PurchaseOrderLine  $purchaseOrderLine
     * @return void
     */
    public function updating(PurchaseOrderLine $purchaseOrderLine)
    {
        //
    }

    /**
     * Handle the purchaseOrderLine "updated" event.
     *
     * @param  \Kv\MyCrm\Models\PurchaseOrderLine  $purchaseOrderLine
     * @return void
     */
    public function updated(PurchaseOrderLine $purchaseOrderLine)
    {
        //
    }

    /**
     * Handle the purchaseOrderLine "deleting" event.
     *
     * @param  \Kv\MyCrm\PurchaseOrderLine  $purchaseOrderLine
     * @return void
     */
    public function deleting(PurchaseOrderLine $purchaseOrderLine)
    {
        //
    }

    /**
     * Handle the purchaseOrderLine "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\PurchaseOrderLine  $purchaseOrderLine
     * @return void
     */
    public function deleted(PurchaseOrderLine $purchaseOrderLine)
    {
        //
    }

    /**
     * Handle the purchaseOrderLine "restored" event.
     *
     * @param  \Kv\MyCrm\Models\PurchaseOrderLine  $purchaseOrderLine
     * @return void
     */
    public function restored(PurchaseOrderLine $purchaseOrderLine)
    {
        //
    }

    /**
     * Handle the purchaseOrderLine "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\PurchaseOrderLine  $purchaseOrderLine
     * @return void
     */
    public function forceDeleted(PurchaseOrderLine $purchaseOrderLine)
    {
        //
    }
}
