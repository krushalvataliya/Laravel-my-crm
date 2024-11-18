<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\Delivery;

class DeliveryRepository
{
    public function all()
    {
        return Delivery::all();
    }

    public function find($id)
    {
        return Delivery::find($id);
    }
}
