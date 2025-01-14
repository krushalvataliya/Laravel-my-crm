<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class InvoiceLine extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'invoice_lines';
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

    public function invoice()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Invoice::class);
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
