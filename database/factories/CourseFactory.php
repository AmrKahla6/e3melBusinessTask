<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $levels = ['beginner', 'immediat', 'high'];
    return [
        'name'        => $faker->name,
        'description' => Str::random(100),
        'rating'      => rand(1,5),
        'views'       => rand(1,100),
        'levels'      => $faker->randomElement(['beginner' ,'immediat', 'high']),
        // 'levels'      => $levels[rand(0,2)]
        'hours'       => rand(12,100),
        'active'      => 0,
        'image'       => rand(1,10).'.png',
        'cat_id'      => function(){
            return Category::all()->random();
        },
    ];
});
