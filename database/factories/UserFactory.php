<?php

use App\User;
use App\Comment;
use App\Models\Post;
use App\Models\Attachment;
use Illuminate\Support\Str;
use App\Models\CommentsPost;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;

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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'role' => 0,
        'confirmation_token' => NULL
    ];
});

$factory->define(Attachment::class, function(Faker $faker) {
    return [
        'name' => $faker->name.'.jpg',
        'attachable_id' => $faker->randomDigitNotNull,
        'attachable_type' => Post::class
    ];
});

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'introduce' => implode(',',$faker->paragraphs(3)),
        'body' => implode(',',$faker->paragraphs(20)),
        'online' => 1,
        'category_id' => 1,
    ];
});

$factory->define(CommentsPost::class, function(Faker $faker) {
    return [
        'comment' => $faker->sentence,
        'user_id' => 1,
        'post_id' => 1
    ];
});

$factory->define(Comment::class, function(Faker $faker) {
    return [
        'username' => $faker->username,
        'email' => $faker->email,
        'content' => $faker->sentence,
        'ip' => $faker->ipv4
    ];
});