<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Kv\MyCrm\Traits\BelongsToTeams;

class Label extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'labels';
    }

    public function setHexAttribute($value)
    {
        $this->attributes['hex'] = Str::after($value, '#');
    }

    /**
     * Get all of the leads that are assigned this labels.
     */
    public function leads()
    {
        return $this->morphedByMany(\Kv\MyCrm\Models\Lead::class, config('laravel-crm.db_table_prefix').'labelable');
    }

    /**
     * Get all of the deals that are assigned this labels.
     */
    public function deals()
    {
        return $this->morphedByMany(\Kv\MyCrm\Models\Deal::class, config('laravel-crm.db_table_prefix').'labelable');
    }

    /**
     * Get all of the people that are assigned this labels.
     */
    public function people()
    {
        return $this->morphedByMany(\Kv\MyCrm\Models\Person::class, config('laravel-crm.db_table_prefix').'labelable');
    }

    /**
     * Get all of the organisations that are assigned this labels.
     */
    public function organisations()
    {
        return $this->morphedByMany(\Kv\MyCrm\Models\Organisation::class, config('laravel-crm.db_table_prefix').'labelable');
    }
}
