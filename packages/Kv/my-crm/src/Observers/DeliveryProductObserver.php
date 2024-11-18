<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\DeliveryProduct;

class DeliveryProductObserver
{
    /**
     * Handle the deliveryProduct "creating" event.
     *
     * @param  \Kv\MyCrm\Models\DeliveryProduct  $deliveryProduct
     * @return void
     */
    public function creating(DeliveryProduct $deliveryProduct)
    {
        $deliveryProduct->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the deliveryProduct "created" event.
     *
     * @param  \Kv\MyCrm\Models\DeliveryProduct  $deliveryProduct
     * @return void
     */
    public function created(DeliveryProduct $deliveryProduct)
    {
        //
    }

    /**
     * Handle the deliveryProduct "updating" event.
     *
     * @param  \Kv\MyCrm\Models\DeliveryProduct  $deliveryProduct
     * @return void
     */
    public function updating(DeliveryProduct $deliveryProduct)
    {
        //
    }

    /**
     * Handle the deliveryProduct "updated" event.
     *
     * @param  \Kv\MyCrm\Models\DeliveryProduct  $deliveryProduct
     * @return void
     */
    public function updated(DeliveryProduct $deliveryProduct)
    {
        //
    }

    /**
     * Handle the deliveryProduct "deleting" event.
     *
     * @param  \Kv\MyCrm\DeliveryProduct  $deliveryProduct
     * @return void
     */
    public function deleting(DeliveryProduct $deliveryProduct)
    {
        //
    }

    /**
     * Handle the deliveryProduct "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\DeliveryProduct  $deliveryProduct
     * @return void
     */
    public function deleted(DeliveryProduct $deliveryProduct)
    {
        //
    }

    /**
     * Handle the deliveryProduct "restored" event.
     *
     * @param  \Kv\MyCrm\Models\DeliveryProduct  $deliveryProduct
     * @return void
     */
    public function restored(DeliveryProduct $deliveryProduct)
    {
        //
    }

    /**
     * Handle the deliveryProduct "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\DeliveryProduct  $deliveryProduct
     * @return void
     */
    public function forceDeleted(DeliveryProduct $deliveryProduct)
    {
        //
    }
}
