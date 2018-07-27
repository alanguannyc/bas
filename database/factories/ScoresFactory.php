<?php

use Faker\Generator as Faker;

$factory->define(App\Score::class, function (Faker $faker) {
    return [
        'nomination_id' => $faker->numberBetween($min = 42, $max = 67),
        'q1' => $faker->numberBetween($min = 0, $max = 5),
        'q2' => $faker->numberBetween($min = 0, $max = 5),
        'q3' => $faker->numberBetween($min = 0, $max = 5),
        'q4' => $faker->numberBetween($min = 0, $max = 5),
        'q5' => $faker->numberBetween($min = 0, $max = 5),
        
    ];
});
