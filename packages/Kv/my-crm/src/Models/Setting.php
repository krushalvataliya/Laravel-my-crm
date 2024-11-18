<?php

namespace Kv\MyCrm\Models;

use Kv\MyCrm\Traits\BelongsToTeams;
use Kv\MyCrm\Traits\HasCrmAddresses;
use Kv\MyCrm\Traits\HasCrmEmails;
use Kv\MyCrm\Traits\HasCrmPhones;

class Setting extends Model
{
    use BelongsToTeams;
    use HasCrmPhones;
    use HasCrmEmails;
    use HasCrmAddresses;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ($model->global) {
                switch ($model->name) {
                    case "app_name":
                    case "app_env":
                    case "app_url":
                    case "version":
                    case "install_id":
                    case "version_latest":
                        $model->global = 1;

                        break;
                }
            }
        });
    }

    public function getTable()
    {
        return config('laravel-crm.db_table_prefix').'settings';
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function scopeCurrency($query)
    {
        return $query->where('name', 'currency')->first();
    }

    public function scopeCountry($query)
    {
        return $query->where('name', 'country')->first();
    }
}
