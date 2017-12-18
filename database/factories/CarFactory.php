<?php


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

$factory->define(App\Car::class, function (Faker\Generator $faker) {
  $makes = array(
    'Acura',
    'Audi',
    'BMW',
    'Cadillac',
    'Chevrolet',
    'Chrysler',
    'Daewoo',
    'Daihatsu',
    'Ford',
    'Honda',
    'Hyundai',
    'Infiniti',
    'Jaguar',
    'Jeep',
    'Kia_Motors',
    'Land_Rover',
    'Lexus',
    'Mazda',
    'Mercedes',
    'Mitsubishi',
    'Nissan',
    'Subaru',
    'Suzuki',
    'Toyota',
    'Volkswagen',
    'Volvo',
    'Yamaha');

  $transmissions = array('Automatic', 'Manual', 'Tip-tronic');
  $conditions = array('new', 'used', 'damaged');
  $body_types = array('Sedan', 'Coupe', 'Hatch', 'SUV', 'Pickup', 'Truck');

    return [
        'make' => $makes[mt_rand(0,26)],
        //'model' => 'Corolla',
        'year' => $faker->year('now'),
        'price' => ''.mt_rand(300000,7000000),
        'img' =>  '2017/11/'. mt_rand(),
        'seller' => 'Jonathon',
        'contact' => $faker->phoneNumber,
        'location' => $faker->city,
        'transmission' => $transmissions[mt_rand(0,2)],
        'description' => $faker->sentence(6),
        'condition' => $conditions[mt_rand(0,2)],
        'body_type' => $body_types[mt_rand(0,5)],
        'seller_id' => md5($faker->name)
    ];
});
