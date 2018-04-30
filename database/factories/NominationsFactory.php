<?php

use Faker\Generator as Faker;

$factory->define(App\Nomination::class, function (Faker $faker) {
    return [
        'category' => $faker->company,
        'name' => $faker->name,
        'q1' => $faker->paragraph,
        'q2' => $faker->paragraph,
        'q3' => $faker->paragraph,
        'q4' => $faker->paragraph,
        'q5' => $faker->paragraph,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
