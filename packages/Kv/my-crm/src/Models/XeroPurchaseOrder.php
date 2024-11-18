<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class XeroPurchaseOrder extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'xero_purchase_orders';
    }

    /**
     * Get the invoice that owns the xero invoice.
     */
    public function purchaseOrder()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\PurchaseOrder::class);
    }
}
