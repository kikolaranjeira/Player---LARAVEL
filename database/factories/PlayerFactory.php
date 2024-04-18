<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Player;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon; // Add missing import statement
$factory->define(Player::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'address'           => $faker->address,
        'description'       => $faker->paragraph(50),
        'retired'           => $faker->boolean,
        'created_at' => Carbon::now(), // Use Carbon::now() instead of now()
        'updated_at' => Carbon::now() // Use Carbon::now() instead of now()
    ];
});
