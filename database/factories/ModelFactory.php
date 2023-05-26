<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FormAttendanceMaster;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(FormAttendanceMaster::class, function (Faker $faker) {
    return [
        'category_training' => $faker->numberBetween(1, 5),
        'registered_by_dept' => $faker->numberBetween(1, 9),
        'reference' => $faker->word(),
        'topic_1' => $faker->word(),
        'topic_2' => $faker->word(),
        'duration' => $faker->numberBetween(0, 10),
        'frequency' => $faker->numberBetween(0, 10),
    ];
});
