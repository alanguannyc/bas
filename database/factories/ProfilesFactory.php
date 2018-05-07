<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'company' => $faker->company,
        'title' => $faker->jobTitle,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'user_id' => $faker->numberBetween($min = 1, $max = 30),
    ];
});
