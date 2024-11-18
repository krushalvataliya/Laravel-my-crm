<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;
use Kv\MyCrm\Traits\HasCrmActivities;
use Kv\MyCrm\Traits\HasCrmFields;
use Kv\MyCrm\Traits\SearchFilters;

class Lead extends Model
{
    use SoftDeletes;
    use HasCrmFields;
    use BelongsToTeams;
    use SearchFilters;
    use HasCrmActivities;

    protected $guarded = ['id'];

    protected $casts = [
        'converted_at' => 'datetime',
    ];

    protected $searchable = [
        'title',
        'person.first_name',
        'person.middle_name',
        'person.last_name',
        'person.maiden_name',
        'organisation.name',
    ];

    protected $filterable = [
        'user_owner_id',
        'labels.id',
    ];

    public function getSearchable()
    {
        return $this->searchable;
    }

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'leads';
    }

    public function setAmountAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['amount'] = $value * 100;
        } else {
            $this->attributes['amount'] = null;
        }
    }

    public function client()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Client::class);
    }

    public function organisation()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Organisation::class);
    }

    public function person()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Person::class);
    }

    /**
     * Get all of the lead's emails.
     */
    public function emails()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Email::class, 'emailable');
    }

    public function getPrimaryEmail()
    {
        if ($this->person) {
            return $this->person->getPrimaryEmail();
        } else {
            return $this->emails()->where('primary', 1)->first();
        }
    }

    /**
     * Get all of the lead's phone numbers.
     */
    public function phones()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Phone::class, 'phoneable');
    }

    public function getPrimaryPhone()
    {
        if ($this->person) {
            return $this->person->getPrimaryPhone();
        } else {
            return $this->phones()->where('primary', 1)->first();
        }
    }

    /**
     * Get all of the leads addresses.
     */
    public function addresses()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Address::class, 'addressable');
    }

    public function getPrimaryAddress()
    {
        if ($this->organisation) {
            return $this->organisation->getPrimaryAddress();
        } else {
            return $this->addresses()->where('primary', 1)->first();
        }
    }

    public function leadStatus()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\LeadStatus::class, 'lead_status_id');
    }

    public function leadSource()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\LeadSource::class, 'lead_source_id');
    }

    /**
     * Get all of the lead's custom field values.
     */
    public function customFieldValues()
    {
        return $this->morphMany(\Kv\MyCrm\Models\FieldValue::class, 'custom_field_valueable');
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

    /**
     * Get all of the labels for the lead.
     */
    public function labels()
    {
        return $this->morphToMany(\Kv\MyCrm\Models\Label::class, config('laravel-crm.db_table_prefix').'labelable');
    }

    public function pipeline()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Pipeline::class);
    }

    public function pipelineStage()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\PipelineStage::class);
    }
}
