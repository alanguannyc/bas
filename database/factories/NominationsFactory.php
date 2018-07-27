<?php

use Faker\Generator as Faker;

$factory->define(App\Nomination::class, function (Faker $faker) {
    return [
        'category' => $faker->randomElement(['Full-Time Room Attendant', 'Full-Time Hourly With Guest Contact', 'Full-Time Hourly Without Guest Contact','Managerial Below General Manager']),
        'name' => $faker->name,
        'title' => $faker->title,
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
