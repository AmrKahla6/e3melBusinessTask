<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $date   = rand(1262055681,1262055681);
    return [
        'name'            => $faker->name,
        'active'          => rand(0,1),
        'created_at'      => date("Y-m-d H:i:s",$date),
        'updated_at'      => date("Y-m-d H:i:s",$date),
    ];
});
