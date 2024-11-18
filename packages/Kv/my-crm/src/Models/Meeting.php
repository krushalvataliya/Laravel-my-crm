<?php

namespace Kv\MyCrm\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;
use Kv\MyCrm\Traits\HasCrmFields;
use Kv\MyCrm\Traits\HasGlobalSettings;
use Kv\MyCrm\Traits\SearchFilters;

class Meeting extends Model
{
    use SoftDeletes;
    use HasCrmFields;
    use BelongsToTeams;
    use SearchFilters;
    use HasGlobalSettings;

    protected $guarded = ['id'];

    protected $casts = [
        'start_at' => 'datetime',
        'finish_at' => 'datetime',
    ];

    protected $searchable = [
        'name',
        'description',
    ];

    public function getSearchable()
    {
        return $this->searchable;
    }

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'meetings';
    }

    public function setStartAtAttribute($value)
    {
        if ($value) {
            $this->attributes['start_at'] = Carbon::createFromFormat($this->dateFormat().' H:i', $value);
        }
    }

    public function setFinishAtAttribute($value)
    {
        if ($value) {
            $this->attributes['finish_at'] = Carbon::createFromFormat($this->dateFormat().' H:i', $value);
        }
    }

    /**
     * Get all of the owning meetingable models.
     */
    public function meetingable()
    {
        return $this->morphTo('meetingable');
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

    public function ownerUser()
    {
        return $this->belongsTo(\App\User::class, 'user_owner_id');
    }

    public function assignedToUser()
    {
        return $this->belongsTo(\App\User::class, 'user_assigned_id');
    }

    public function activity()
    {
        return $this->morphOne(\Kv\MyCrm\Models\Activity::class, 'recordable');
    }

    public function contacts()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Contact::class, 'contactable');
    }
}
