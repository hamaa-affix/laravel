<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'title' => $faker->title,
        'article' => $faker->paragraph,
    ];
});

// $factory->define(App\Post::class, function ($faker) {
//     return [
//         'title' => $faker->title,
//         'content' => $faker->paragraph,
//         'user_id' => factory(App\User::class),
//     ];
// });
