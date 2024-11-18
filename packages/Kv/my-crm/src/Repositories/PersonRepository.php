<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\Person;

class PersonRepository
{
    public function all()
    {
        return Person::all();
    }

    public function find($id)
    {
        return Person::find($id);
    }
}
