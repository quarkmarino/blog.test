<?php

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'blog_name' => $faker->word,
        'description' => $faker->text,
    ];
});
