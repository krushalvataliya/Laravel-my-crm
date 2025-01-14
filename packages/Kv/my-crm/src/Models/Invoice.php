<?php

namespace Kv\MyCrm\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kv\MyCrm\Traits\BelongsToTeams;
use Kv\MyCrm\Traits\HasCrmActivities;
use Kv\MyCrm\Traits\HasCrmFields;
use Kv\MyCrm\Traits\HasGlobalSettings;
use Kv\MyCrm\Traits\SearchFilters;

class Invoice extends Model
{
    use SoftDeletes;
    use HasCrmFields;
    use BelongsToTeams;
    use SearchFilters;
    use HasCrmActivities;
    use HasGlobalSettings;

    protected $guarded = ['id'];

    protected $casts = [
        'issue_date' => 'datetime',
        'due_date' => 'datetime',
        'fully_paid_at' => 'datetime',
    ];

    protected $searchable = [
        'reference',
        'invoice_id',
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
        return config('laravel-crm.db_table_prefix').'invoices';
    }

    public function getInvoiceIdAttribute($value)
    {
        if ($value) {
            return $value;
        } else {
            return (Setting::where('name', 'invoice_prefix')->first()->value ?? null) . $this->number;
        }
    }

    public function getNumberAttribute($value)
    {
        if ($value) {
            return $value;
        } else {
            return $this->id;
        }
    }

    public function getTitleAttribute()
    {
        return money($this->total, $this->currency).' - '.($this->organisation->name ?? $this->person->name ?? null);
    }

    public function setIssueDateAttribute($value)
    {
        if ($value) {
            $this->attributes['issue_date'] = Carbon::createFromFormat($this->dateFormat(), $value);
        }
    }

    public function setDueDateAttribute($value)
    {
        if ($value) {
            $this->attributes['due_date'] = Carbon::createFromFormat($this->dateFormat(), $value);
        }
    }

    public function setFullyPaidAtAttribute($value)
    {
        if ($value) {
            $this->attributes['fully_paid_at'] = Carbon::createFromFormat($this->dateFormat(), $value);
        }
    }

    public function setSubtotalAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['subtotal'] = $value * 100;
        } else {
            $this->attributes['subtotal'] = null;
        }
    }

    public function setTaxAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['tax'] = $value * 100;
        } else {
            $this->attributes['tax'] = null;
        }
    }

    public function setTotalAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['total'] = $value * 100;
        } else {
            $this->attributes['total'] = null;
        }
    }

    public function setAmountDueAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['amount_due'] = $value * 100;
        } else {
            $this->attributes['amount_due'] = null;
        }
    }

    public function getAmountDueAttribute($value)
    {
        if ($value) {
            return $value;
        } else {
            return $this->total;
        }
    }

    public function setAmountPaidAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['amount_paid'] = $value * 100;
        } else {
            $this->attributes['amount_paid'] = null;
        }
    }

    public function person()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Person::class);
    }

    public function organisation()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Organisation::class);
    }

    public function order()
    {
        return $this->belongsTo(\Kv\MyCrm\Models\Order::class);
    }

    public function invoiceLines()
    {
        return $this->hasMany(\Kv\MyCrm\Models\InvoiceLine::class);
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

    /**
     * Get the xero invoice associated with the invoice.
     */
    public function xeroInvoice()
    {
        return $this->hasOne(\Kv\MyCrm\Models\XeroInvoice::class);
    }
}
