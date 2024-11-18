<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\Quote;

class QuoteRepository
{
    public function all()
    {
        return Quote::all();
    }

    public function find($id)
    {
        return Quote::find($id);
    }
}
