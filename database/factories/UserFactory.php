<?php

use App\Enums\UserTypeEnum;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'admin', [
    'first_name' => 'Admin',
    'last_name' => 'User',
    'email' => 'admin@blog.test',
    'user_type' => UserTypeEnum::ADMIN
]);

$factory->state(User::class, 'supervisor', [
    'user_type' => UserTypeEnum::SUPERVISOR
]);

$factory->state(User::class, 'blogger', [
    'user_type' => UserTypeEnum::BLOGGER
]);
