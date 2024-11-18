<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\Order;

class OrderRepository
{
    public function all()
    {
        return Order::all();
    }

    public function find($id)
    {
        return Order::find($id);
    }
}
