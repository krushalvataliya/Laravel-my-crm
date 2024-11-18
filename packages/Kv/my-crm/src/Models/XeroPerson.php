<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class XeroPerson extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'xero_people';
    }

    /**
     * Get the person that owns the xero people.
     */
    public function person()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Person::class);
    }
}
