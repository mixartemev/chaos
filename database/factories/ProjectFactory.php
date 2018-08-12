<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->domainWord),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'type' => $faker->randomElement(['personal', 'commercial']),
    ];
});
