<?php

namespace Kv\MyCrm\Traits;

trait HasCrmAccess
{
    public function hasCrmAccess()
    {
        return $this->crm_access;
    }

    public function isCrmOwner()
    {
        return config('laravel-crm.crm_owner') == $this->email;
    }

    public function emails()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Email::class, 'emailable');
    }

    public function getPrimaryEmail()
    {
        return $this->emails()->where('primary', 1)->first();
    }

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

    public function crmSettings()
    {
        return $this->hasMany(\Kv\MyCrm\Models\Setting::class);
    }
}
