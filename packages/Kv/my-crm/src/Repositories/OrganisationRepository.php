<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\Organisation;

class OrganisationRepository
{
    public function all()
    {
        return Organisation::all();
    }

    public function find($id)
    {
        return Organisation::find($id);
    }
}
