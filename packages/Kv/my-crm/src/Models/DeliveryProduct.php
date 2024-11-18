<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class DeliveryProduct extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'delivery_products';
    }

    public function delivery()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Delivery::class);
    }

    public function orderProduct()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\OrderProduct::class);
    }
}
