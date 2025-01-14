<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;

class File extends Model
{
    use SoftDeletes;
    use BelongsToTeams;

    protected $guarded = ['id'];

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'files';
    }

    /**
     * Get all of the owning fileable models.
     */
    public function fileable()
    {
        return $this->morphTo('fileable');
    }

    public function createdByUser()
    {
        return $this->belongsTo(\App\User::class, 'user_created_id');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(\App\User::class, 'user_updated_id');
    }

    public function deletedByUser()
    {
        return $this->belongsTo(\App\User::class, 'user_deleted_id');
    }

    public function restoredByUser()
    {
        return $this->belongsTo(\App\User::class, 'user_restored_id');
    }

    public function relatedFile()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\File::class, 'related_file_id');
    }

    public function activity()
    {
        return $this->morphOne(\Kv\MyCrm\Models\Activity::class, 'recordable');
    }
}
