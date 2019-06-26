<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        "title" => $faker->name,
        "rate"  => $faker->randomNumber(2),
        "qty"   => $faker->randomNumber(1),
        "type"  => $faker->randomElement($array = array ('sales','purchase')),
        "author"    => function () {
            return factory(App\User::class)->create()->id;
        },
        "description"   => $faker->paragraph,

    ];
});
