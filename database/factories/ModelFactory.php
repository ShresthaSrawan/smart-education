<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker)
{
    static $password;

    $name = $faker->firstName;

    return [
        'first_name'     => $name,
        'last_name'      => $faker->lastName,
        'username'       => str_slug($name),
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Student::class, function (Faker\Generator $faker)
{

    return [
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'symbol'     => $faker->md5
    ];
});