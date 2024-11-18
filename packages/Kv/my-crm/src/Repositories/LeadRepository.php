<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\Lead;

class LeadRepository
{
    public function all()
    {
        return Lead::all();
    }

    public function find($id)
    {
        return Lead::find($id);
    }
}
