<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class LeadStatus extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'lead_statuses';
    }

    public function leads()
    {
        return $this->hasMany(\Kv\MyCrm\Models\Lead::class, 'lead_status_id');
    }
}
