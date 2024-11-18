<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\XeroItem;

class XeroItemObserver
{
    /**
     * Handle the xeroItem "creating" event.
     *
     * @param  \Kv\MyCrm\Models\XeroItem  $xeroItem
     * @return void
     */
    public function creating(XeroItem $xeroItem)
    {
        $xeroItem->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the xeroItem "created" event.
     *
     * @param  \Kv\MyCrm\Models\XeroItem  $xeroItem
     * @return void
     */
    public function created(XeroItem $xeroItem)
    {
        //
    }

    /**
     * Handle the xeroItem "updating" event.
     *
     * @param  \Kv\MyCrm\Models\XeroItem  $xeroItem
     * @return void
     */
    public function updating(XeroItem $xeroItem)
    {
        //
    }

    /**
     * Handle the xeroItem "updated" event.
     *
     * @param  \Kv\MyCrm\Models\XeroItem  $xeroItem
     * @return void
     */
    public function updated(XeroItem $xeroItem)
    {
        //
    }

    /**
     * Handle the xeroItem "deleting" event.
     *
     * @param  \Kv\MyCrm\XeroItem  $xeroItem
     * @return void
     */
    public function deleting(XeroItem $xeroItem)
    {
        //
    }

    /**
     * Handle the xeroItem "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\XeroItem  $xeroItem
     * @return void
     */
    public function deleted(XeroItem $xeroItem)
    {
        //
    }

    /**
     * Handle the xeroItem "restored" event.
     *
     * @param  \Kv\MyCrm\Models\XeroItem  $xeroItem
     * @return void
     */
    public function restored(XeroItem $xeroItem)
    {
        //
    }

    /**
     * Handle the xeroItem "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\XeroItem  $xeroItem
     * @return void
     */
    public function forceDeleted(XeroItem $xeroItem)
    {
        //
    }
}
