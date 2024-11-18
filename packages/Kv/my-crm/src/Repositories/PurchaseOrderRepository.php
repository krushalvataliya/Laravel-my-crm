<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\PurchaseOrder;

class PurchaseOrderRepository
{
    public function all()
    {
        return PurchaseOrder::all();
    }

    public function find($id)
    {
        return PurchaseOrder::find($id);
    }
}
