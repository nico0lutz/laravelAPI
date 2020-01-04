<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'author' => $faker->name,
        'title' => $faker->word,
        'content' => $faker->text($maxNbChars = 200),        
    ];
});
