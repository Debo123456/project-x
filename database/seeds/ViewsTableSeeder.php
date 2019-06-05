<?php

use Illuminate\Database\Seeder;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\View::class, 1000)->create()->each(function($view) {
            $view->save();
          });
    }
}
