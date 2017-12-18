<?php

use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Car::class, 1000)->create()->each(function($car) {
          $car->save();
        });
    }
}
