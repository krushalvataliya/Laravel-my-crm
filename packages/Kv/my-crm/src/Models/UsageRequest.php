<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class UsageRequest extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix') . 'usage_requests';
    }
}
