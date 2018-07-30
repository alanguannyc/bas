<?php

use Faker\Generator as Faker;

$factory->define(App\Final_score::class, function (Faker $faker) {
    return [
        'nomination_id' => $faker->unique()->numberBetween($min = 1, $max = 30),
        'user_id' => 4,
        'q1' => $faker->numberBetween($min = 0, $max = 5),
        'q2' => $faker->numberBetween($min = 0, $max = 5),
        'q3' => $faker->numberBetween($min = 0, $max = 5),
        'q4' => $faker->numberBetween($min = 0, $max = 5),
        'q5' => $faker->numberBetween($min = 0, $max = 5),
        
    ];
});
