<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'pseudo' => $faker->word,
        'firstname' => $faker->name,
        'lastname' => $faker->word,
        'job' => $faker->jobTitle,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'confirmation_token' => 'vioejiuvhezihbuezhbiebiejibnueuygcuiyezyu',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

// factory ARTICLE
$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1 , 2),
        'title' => $faker->title(),
        'slug' => $faker->slug(),
        'abstract' => $faker->text(),
        'content' => $faker->realText(600),
    ];
});

// factory OBSERVATION
$factory->define(App\Observation::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1 , 2),
        'matureStage' => 'adulte',
        'plumage' => 'cendré',
        'nidification' => 'nid',
        'quantity' => $faker->numberBetween(1, 10),
        'dateAt' => $faker->date(),
        'hourAt' => $faker->time(),
        'department' => $faker->word,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'comment' => $faker->text(),
        'status' => $faker->numberBetween(0, 1),
        'publishedAt' => $faker->dateTime()
    ];
});

// factory PICTURE
$factory->define(App\Picture::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 2),
        'title' => $faker->title(),
        'url' => $faker->url,
        'alt' => $faker->words(4, true),
        'type' => $faker->fileExtension
    ];
});