<?php

namespace Kv\MyCrm\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Kv\MyCrm\Traits\BelongsToTeams;
use Kv\MyCrm\Traits\HasCrmActivities;
use Kv\MyCrm\Traits\HasCrmFields;
use Kv\MyCrm\Traits\HasGlobalSettings;
use Kv\MyCrm\Traits\SearchFilters;
use VentureDrake\LaravelEncryptable\Traits\LaravelEncryptableTrait;

class Person extends Model
{
    use SoftDeletes;
    use LaravelEncryptableTrait;
    use BelongsToTeams;
    use HasCrmFields;
    use SearchFilters;
    use Sortable;
    use HasCrmActivities;
    use HasGlobalSettings;

    protected $guarded = ['id'];

    protected $encryptable = [
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'maiden_name',
    ];

    protected $searchable = [
        'first_name',
        'middle_name',
        'last_name',
        'maiden_name',
    ];

    protected $filterable = [
        'user_owner_id',
        'labels.id',
    ];

    public $sortable = [
        'id',
        'first_name',
        'last_name',
        'created_at',
        'updated_at',
    ];

    public function getSearchable()
    {
        return $this->searchable;
    }

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'people';
    }

    public function getNameAttribute()
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    public function setBirthdayAttribute($value)
    {
        if ($value) {
            $this->attributes['birthday'] = Carbon::createFromFormat($this->dateFormat(), $this->decryptField($value));
        }
    }

    public function getBirthdayAttribute($value)
    {
        if ($value) {
            return Carbon::parse($this->decryptField($value))->format($this->dateFormat());
        }
    }

    public function getFirstNameDecryptedAttribute()
    {
        return $this->decryptField($this->first_name);
    }

    /**
     * Get all of the persons emails.
     */
    public function emails()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Email::class, 'emailable');
    }

    public function getPrimaryEmail()
    {
        return $this->emails()->where('primary', 1)->first();
    }

    /**
     * Get all of the persons phone numbers.
     */
    public function phones()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Phone::class, 'phoneable');
    }

    public function getPrimaryPhone()
    {
        return $this->phones()->where('primary', 1)->first();
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
        return $this->addresses()->where('primary', 1)->first();
    }

    public function organisation()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Organisation::class);
    }

    public function deals()
    {
        return $this->hasMany(\Kv\MyCrm\Models\Deal::class);
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

    /**
     * Get all of the labels for the person.
     */
    public function labels()
    {
        return $this->morphToMany(\Kv\MyCrm\Models\Label::class, config('laravel-crm.db_table_prefix').'labelable');
    }

    public function contacts()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Contact::class, 'contactable');
    }

    /**
     * Get the xero person associated with the person.
     */
    public function xeroPerson()
    {
        return $this->hasOne(\Kv\MyCrm\Models\XeroPerson::class);
    }

    public function client()
    {
        return $this->morphOne(\Kv\MyCrm\Models\Client::class, 'clientable');
    }
}
