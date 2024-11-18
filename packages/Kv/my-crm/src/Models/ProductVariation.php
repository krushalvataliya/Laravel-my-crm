<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class ProductVariation extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'product_variations';
    }

    public function product()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Product::class);
    }

    public function productPrices()
    {
        return $this->hasMany(\Kv\MyCrm\Models\ProductPrice::class);
    }
}
