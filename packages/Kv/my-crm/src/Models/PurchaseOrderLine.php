<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class PurchaseOrderLine extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'purchase_order_lines';
    }

    public function setPriceAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['price'] = $value * 100;
        } else {
            $this->attributes['price'] = null;
        }
    }

    public function setTaxAmountAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['tax_amount'] = $value * 100;
        } else {
            $this->attributes['tax_amount'] = null;
        }
    }

    public function setAmountAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['amount'] = $value * 100;
        } else {
            $this->attributes['amount'] = null;
        }
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\PurchaseOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Product::class);
    }

    public function productVariation()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\ProductVariation::class);
    }
}
