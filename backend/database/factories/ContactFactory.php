<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Contact::class, function (Faker $faker) {
    return [
        'salesman_name' => $faker->name,
        'enterprise_name' => $faker->name,
        'contact_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->numberBetween($min = 1, $max = 10),
        'contact_date' => date('Y-m-d'),
        'validate_date' => date('Y-m-d')
    ];
});