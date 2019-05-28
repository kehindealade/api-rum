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

$factory->define(Rumi\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(Rumi\Models\Leaser::class, function (Faker $faker) {
    static $password;
 
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('toyosi'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Rumi\Models\Roomer::class, function(Faker $faker){
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('toyosi'),
		'remember_token' => str_random(10),
	];
});
 
$factory->define(Rumi\Models\LeaserProfile::class, function(Faker $faker){
	return [
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'status' => $faker->word,
		'about_me' => $faker->word,
		'image' => $faker->imageUrl,
		'leaser_id' => $faker->biasedNumberBetween(1, 10),
	];
});

$factory->define(Rumi\Models\RoomerProfile::class, function(Faker $faker){
	return [
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'about_me' => $faker->word,
		'image' => $faker->imageUrl(),
		'roomer_id' => $faker->biasedNumberBetween(1, 10),
	];
});

$factory->define(Rumi\Models\Hostel::class, function(Faker $faker){
	static $rooms;
	 $rooms = [
		'room' => $faker->biasedNumberBetween(1, 10), 
		'budget' => 40000
	];

	
	 
	return [
		'leasers_id' => $faker->biasedNumberBetween(1, 10),
		'description' => $faker->sentences(10, true),
		'toc' => $faker->sentences(5, true),
		'image' => $faker->imageUrl(),
		'location' => $faker->city,
		'no_of_rooms' => $rooms['room'],
		'rooms_left' => $rooms['room'],
		'budget' => $rooms['budget'],

	];
});

$factory->define(Rumi\Models\NewRoomBookOrder::class, function(Faker $faker){
	static $status, $date;
	$status = 'UDC';
	$date = Carbon\Carbon::now();
	return [
		'roomer_id' => $faker->biasedNumberBetween(1, 10),
		'order_notes' => $faker->sentences(3, true),
		'hostel_id' => $faker->biasedNumberBetween(1, 10),
		'book_date' => $date,
	];
});

$factory->define(Rumi\ApiKeys::class, function(Faker $faker){
	$webkey = bcrypt('web-api-rumis');
	$appkey = bcrypt('app-api-rumis');

	return [
		'web' => $webkey,
		'app' => $appkey,
	];
});

$factory->define(Rumi\Student::class, function(Faker $faker){
	return [
		'names' => $faker->firstName,
		'location' => $faker->city,
		'story' => $faker->sentences(3, true),
	];
});