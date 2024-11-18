<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\OrderProduct;

class OrderProductObserver
{
    /**
     * Handle the orderProduct "creating" event.
     *
     * @param  \Kv\MyCrm\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function creating(OrderProduct $orderProduct)
    {
        $orderProduct->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the orderProduct "created" event.
     *
     * @param  \Kv\MyCrm\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function created(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the orderProduct "updating" event.
     *
     * @param  \Kv\MyCrm\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function updating(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the orderProduct "updated" event.
     *
     * @param  \Kv\MyCrm\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function updated(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the orderProduct "deleting" event.
     *
     * @param  \Kv\MyCrm\OrderProduct  $orderProduct
     * @return void
     */
    public function deleting(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the orderProduct "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function deleted(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the orderProduct "restored" event.
     *
     * @param  \Kv\MyCrm\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function restored(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the orderProduct "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\OrderProduct  $orderProduct
     * @return void
     */
    public function forceDeleted(OrderProduct $orderProduct)
    {
        //
    }
}
