<?php

namespace Kv\MyCrm\Database\Seeders;

use Illuminate\Database\Seeder;
use Kv\MyCrm\Models\Deal;
use Kv\MyCrm\Models\Lead;
use Kv\MyCrm\Models\Organisation;
use Kv\MyCrm\Models\Person;
use Kv\MyCrm\Models\Product;
use Kv\MyCrm\Models\ProductCategory;

class LaravelCrmSampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Organisation::class, 100)->create();
        factory(Person::class, 200)->create();
        factory(Lead::class, 100)->create();
        factory(Deal::class, 50)->create();
        factory(Product::class, 10)->create();
        factory(ProductCategory::class, 5)->create();
    }
}
