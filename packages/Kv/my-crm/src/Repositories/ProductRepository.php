<?php

namespace Kv\MyCrm\Repositories;

use Kv\MyCrm\Models\Product;

class ProductRepository
{
    public function all()
    {
        return Product::all();
    }

    public function find($id)
    {
        return Product::find($id);
    }
}
