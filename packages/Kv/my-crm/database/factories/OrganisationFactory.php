<?php

namespace Kv\MyCrm\Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Kv\MyCrm\Models\Organisation;

$factory->define(Organisation::class, function (Faker $faker) {
    return [
        'external_id' => $faker->uuid,
        'name' => $faker->company,
        'user_owner_id' => 1,
    ];
});
