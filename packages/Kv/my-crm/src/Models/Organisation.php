<?php

namespace Kv\MyCrm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Kv\MyCrm\Traits\BelongsToTeams;
use Kv\MyCrm\Traits\HasCrmActivities;
use Kv\MyCrm\Traits\HasCrmFields;
use Kv\MyCrm\Traits\HasCrmUserRelations;
use Kv\MyCrm\Traits\SearchFilters;
use VentureDrake\LaravelEncryptable\Traits\LaravelEncryptableTrait;

class Organisation extends Model
{
    use SoftDeletes;
    use LaravelEncryptableTrait;
    use BelongsToTeams;
    use HasCrmFields;
    use SearchFilters;
    use Sortable;
    use HasCrmActivities;
    use HasCrmUserRelations;

    protected $guarded = ['id'];

    protected $encryptable = [
        'name',
    ];

    protected $searchable = [
        'name',
    ];

    protected $filterable = [
        'user_owner_id',
        'labels.id',
    ];

    public $sortable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function getSearchable()
    {
        return $this->searchable;
    }

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'organisations';
    }

    public function setAnnualRevenueAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['annual_revenue'] = $value * 100;
        } else {
            $this->attributes['annual_revenue'] = null;
        }
    }

    public function setTotalMoneyRaisedAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['total_money_raised'] = $value * 100;
        } else {
            $this->attributes['total_money_raised'] = null;
        }
    }

    public function people()
    {
        return $this->hasMany(\Kv\MyCrm\Models\Person::class);
    }

    /**
     * Get all of the organisation emails.
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
     * Get all of the organisation phone numbers.
     */
    public function phones()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Phone::class, 'phoneable');
    }

    public function getPrimaryPhone()
    {
        return $this->phones()->where('primary', 1)->first();
    }

    public function addresses()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Address::class, 'addressable');
    }

    public function getPrimaryAddress()
    {
        return $this->addresses()->where('primary', 1)->first();
    }

    public function getBillingAddress()
    {
        return $this->addresses()->where('address_type_id', 5)->first();
    }

    public function getShippingAddress()
    {
        return $this->addresses()->where('address_type_id', 6)->first();
    }

    public function deals()
    {
        return $this->hasMany(\Kv\MyCrm\Models\Deal::class);
    }

    /**
     * Get all of the labels for the lead.
     */
    public function labels()
    {
        return $this->morphToMany(\Kv\MyCrm\Models\Label::class, config('laravel-crm.db_table_prefix').'labelable');
    }

    public function organisationType()
    {
        return $this->belongsTo(OrganisationType::class);
    }

    public function contacts()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Contact::class, 'contactable');
    }

    /**
     * Get the xero contact associated with the organisation.
     */
    public function xeroContact()
    {
        return $this->hasOne(\Kv\MyCrm\Models\XeroContact::class);
    }

    public function client()
    {
        return $this->morphOne(\Kv\MyCrm\Models\Client::class, 'clientable');
    }

    public function timezone()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Timezone::class);
    }
}
