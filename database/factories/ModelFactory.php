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

use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Event::class, function(Faker\Generator $faker) {
    return [
        'title' => 'Example Band',
        'subtitle' => 'with Fake Openers',
        'date' => Carbon::parse('+2 weeks'),
        'ticket_price' => 2000,
        'venue' => 'The Example Theatr',
        'venue_address' => '123 Example Street',
        'city' => 'Fakeville',
        'state' => 'ON',
        'zip' => '17906',
        'additional_information' => 'Some additional information'
    ];
});

$factory->state(App\Event::class, 'published', function($faker) {
    return [
        'published_at' => Carbon::parse('-1 week'),
    ];
});

$factory->state(App\Event::class, 'unpublished', function($faker) {
    return [
        'published_at' => null,
    ];
});