<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\XeroPurchaseOrder;

class XeroPurchaseOrderObserver
{
    /**
     * Handle the xeroPurchaseOrder "creating" event.
     *
     * @param  \Kv\MyCrm\Models\XeroPurchaseOrder  $xeroPurchaseOrder
     * @return void
     */
    public function creating(XeroPurchaseOrder $xeroPurchaseOrder)
    {
        $xeroPurchaseOrder->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the xeroPurchaseOrder "created" event.
     *
     * @param  \Kv\MyCrm\Models\XeroPurchaseOrder  $xeroPurchaseOrder
     * @return void
     */
    public function created(XeroPurchaseOrder $xeroPurchaseOrder)
    {
        //
    }

    /**
     * Handle the xeroPurchaseOrder "updating" event.
     *
     * @param  \Kv\MyCrm\Models\XeroPurchaseOrder  $xeroPurchaseOrder
     * @return void
     */
    public function updating(XeroPurchaseOrder $xeroPurchaseOrder)
    {
        //
    }

    /**
     * Handle the xeroPurchaseOrder "updated" event.
     *
     * @param  \Kv\MyCrm\Models\XeroPurchaseOrder  $xeroPurchaseOrder
     * @return void
     */
    public function updated(XeroPurchaseOrder $xeroPurchaseOrder)
    {
        //
    }

    /**
     * Handle the xeroPurchaseOrder "deleting" event.
     *
     * @param  \Kv\MyCrm\XeroPurchaseOrder  $xeroPurchaseOrder
     * @return void
     */
    public function deleting(XeroPurchaseOrder $xeroPurchaseOrder)
    {
        //
    }

    /**
     * Handle the xeroPurchaseOrder "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\XeroPurchaseOrder  $xeroPurchaseOrder
     * @return void
     */
    public function deleted(XeroPurchaseOrder $xeroPurchaseOrder)
    {
        //
    }

    /**
     * Handle the xeroPurchaseOrder "restored" event.
     *
     * @param  \Kv\MyCrm\Models\XeroPurchaseOrder  $xeroPurchaseOrder
     * @return void
     */
    public function restored(XeroPurchaseOrder $xeroPurchaseOrder)
    {
        //
    }

    /**
     * Handle the xeroPurchaseOrder "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\XeroPurchaseOrder  $xeroPurchaseOrder
     * @return void
     */
    public function forceDeleted(XeroPurchaseOrder $xeroPurchaseOrder)
    {
        //
    }
}
