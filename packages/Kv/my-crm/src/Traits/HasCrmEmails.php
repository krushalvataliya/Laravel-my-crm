<?php

namespace Kv\MyCrm\Traits;

trait HasCrmEmails
{
    public function emails()
    {
        return $this->morphMany(\Kv\MyCrm\Models\Email::class, 'emailable');
    }

    public function getPrimaryEmail()
    {
        return $this->emails()->where('primary', 1)->first();
    }
}
