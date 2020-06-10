<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Key::class, function (Faker $faker) {
    $hasFile = $faker->boolean(30);
    return [
        'name' => $faker->company,
        'host' => $faker->ipv4,
        'login' => $faker->slug,
        'password' => !$hasFile ? $faker->password : null,
        'filepath' => $hasFile ? $faker->slug : null,
    ];
});
