<?php

namespace Kv\MyCrm\Observers;

use Ramsey\Uuid\Uuid;
use Kv\MyCrm\Models\Product;
use Kv\MyCrm\Models\Setting;
use Kv\MyCrm\Models\TaxRate;

class ProductObserver
{
    /**
     * Handle the product "creating" event.
     *
     * @param  \Kv\MyCrm\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->external_id = Uuid::uuid4()->toString();

        if(! $product->tax_rate_id) {
            $taxRate = TaxRate::where('default', 1)->first();

            $product->tax_rate_id = $taxRate->id ?? null;
            $product->tax_rate = $taxRate->rate ?? Setting::where('name', 'tax_rate')->first()->value ?? null;
        }

        if (! app()->runningInConsole()) {
            $product->user_created_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the product "created" event.
     *
     * @param  \Kv\MyCrm\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the product "updating" event.
     *
     * @param  \Kv\MyCrm\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        if (! app()->runningInConsole()) {
            $product->user_updated_id = auth()->user()->id ?? null;
        }
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \Kv\MyCrm\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleting" event.
     *
     * @param  \Kv\MyCrm\Product  $product
     * @return void
     */
    public function deleting(Product $product)
    {
        if (! app()->runningInConsole()) {
            $product->user_deleted_id = auth()->user()->id ?? null;
            $product->saveQuietly();
        }
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \Kv\MyCrm\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        if (! app()->runningInConsole()) {
            $product->user_deleted_id = auth()->user()->id ?? null;
            $product->saveQuietly();
        }
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \Kv\MyCrm\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
