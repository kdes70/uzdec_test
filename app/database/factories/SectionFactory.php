<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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

$factory->define(\App\Section::class, function (Faker $faker) {
    $filePath = storage_path('logo');

    if (!File::exists($filePath)) {
        File::makeDirectory($filePath);  //follow the declaration to see the complete signature
    }
    return [
        'name' => $faker->name,
        'description' => $faker->text(250),
        'logo' => $faker->image($filePath, 400, 300, null, false)
    ];
});
