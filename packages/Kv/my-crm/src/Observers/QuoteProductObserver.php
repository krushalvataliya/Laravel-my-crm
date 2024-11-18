<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\QuoteProduct;

class QuoteProductObserver
{
    /**
     * Handle the quoteProduct "creating" event.
     *
     * @param  \Kv\MyCrm\Models\QuoteProduct  $quoteProduct
     * @return void
     */
    public function creating(QuoteProduct $quoteProduct)
    {
        $quoteProduct->external_id = Uuid::uuid4()->toString();
    }

    /**
     * Handle the quoteProduct "created" event.
     *
     * @param  \Kv\MyCrm\Models\QuoteProduct  $quoteProduct
     * @return void
     */
    public function created(QuoteProduct $quoteProduct)
    {
        //
    }

    /**
     * Handle the quoteProduct "updating" event.
     *
     * @param  \Kv\MyCrm\Models\QuoteProduct  $quoteProduct
     * @return void
     */
    public function updating(QuoteProduct $quoteProduct)
    {
        //
    }

    /**
     * Handle the quoteProduct "updated" event.
     *
     * @param  \Kv\MyCrm\Models\QuoteProduct  $quoteProduct
     * @return void
     */
    public function updated(QuoteProduct $quoteProduct)
    {
        //
    }

    /**
     * Handle the quoteProduct "deleting" event.
     *
     * @param  \Kv\MyCrm\QuoteProduct  $quoteProduct
     * @return void
     */
    public function deleting(QuoteProduct $quoteProduct)
    {
        //
    }

    /**
     * Handle the quoteProduct "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\QuoteProduct  $quoteProduct
     * @return void
     */
    public function deleted(QuoteProduct $quoteProduct)
    {
        //
    }

    /**
     * Handle the quoteProduct "restored" event.
     *
     * @param  \Kv\MyCrm\Models\QuoteProduct  $quoteProduct
     * @return void
     */
    public function restored(QuoteProduct $quoteProduct)
    {
        //
    }

    /**
     * Handle the quoteProduct "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\QuoteProduct  $quoteProduct
     * @return void
     */
    public function forceDeleted(QuoteProduct $quoteProduct)
    {
        //
    }
}
