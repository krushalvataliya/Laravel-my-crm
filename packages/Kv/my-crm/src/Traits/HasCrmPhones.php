<?php

namespace Kv\MyCrm\Traits;

trait HasCrmPhones
{
    public function phones()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Phone::class, 'phoneable');
    }

    public function getPrimaryPhone()
    {
        return $this->phones()->where('primary', 1)->first();
    }
}
