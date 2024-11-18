<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\Deal;

class DealRepository
{
    public function all()
    {
        return Deal::all();
    }

    public function find($id)
    {
        return Deal::find($id);
    }
}
