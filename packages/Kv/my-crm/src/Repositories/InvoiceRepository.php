<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\Invoice;

class InvoiceRepository
{
    public function all()
    {
        return Invoice::all();
    }

    public function find($id)
    {
        return Invoice::find($id);
    }
}
