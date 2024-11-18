<?php

namespace Kv\MyCrm\Traits;

trait HasCrmAddresses
{
    public function addresses()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Address::class, 'addressable');
    }

    public function getPrimaryAddress()
    {
        return $this->addresses()->where('primary', 1)->first();
    }
}
