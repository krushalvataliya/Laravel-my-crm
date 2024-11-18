<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;
use Kv\MyCrm\Traits\HasCrmFields;

class ProductAttribute extends Model
{
    use SoftDeletes;
    use BelongsToTeams;
    use HasCrmFields;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'product_attributes';
    }

    /*public function products()
    {
        return $this->hasMany(\Kv\MyCrm\Models\Product::class);
    }*/
}
