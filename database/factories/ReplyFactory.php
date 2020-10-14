<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    $created_at = $faker->dateTimeThisMonth();
    $updated_at = $faker->dateTimeThisMonth($created_at);
    return [
        // 'name' => $faker->name,
        'content' => $faker->sentence(),
        'updated_at' => $updated_at,
        'created_at' => $created_at,
    ];
});
