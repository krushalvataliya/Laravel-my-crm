<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class Field extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'fields';
    }

    public function fieldGroup()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\FieldGroup::class);
    }

    public function fieldOptions()
    {
        return $this->hasMany(\Kv\MyCrm\Models\FieldOption::class);
    }
}
