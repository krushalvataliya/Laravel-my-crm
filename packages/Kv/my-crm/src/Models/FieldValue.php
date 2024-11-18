<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class FieldValue extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'field_values';
    }

    public function field()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Field::class);
    }

    /**
     * Get all of the owning field value models.
     */
    public function fieldValueable()
    {
        return $this->morphTo();
    }
}
