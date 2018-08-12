<?php

use App\Task;
use Faker\Generator as Faker;
use App\User;

$factory->define(App\Task::class, function (Faker $faker) {
    $params = [
        'name' => ucfirst(implode(' ', $faker->words)),
        'type' => $faker->randomElement(['bug', 'feature']),
        'sla' => $faker->randomElement(['small', 'middle', 'long']),
        'status' => $faker->randomElement(['created', 'assigned', 'progress', 'review', 'test', 'done']),
        'deadline' => $faker->randomElement([$faker->date(), null]),
        'user_id' => $faker->randomElement(User::all('id')->pluck('id')->all()),
        'task_id' => $faker->randomElement([null, $faker->randomElement(Task::all('id')->pluck('id')->all())]),
    ];
    if ($params['status'] != 'created') {
        $params['assigned_user_id'] = $faker->randomElement(User::all('id')->pluck('id')->all());
    }

    return $params;
});
