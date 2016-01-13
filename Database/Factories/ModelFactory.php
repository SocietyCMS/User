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
$factory->define(\Modules\User\Entities\Entrust\EloquentUser::class, function (Faker\Generator $faker) {
    $faker = \Faker\Factory::create('de_CH');
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'description' => $faker->sentence,
        'office' => $faker->company,
        'bio' => $faker->paragraph,
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'zip' => $faker->postcode,
        'country' => $faker->country,
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
