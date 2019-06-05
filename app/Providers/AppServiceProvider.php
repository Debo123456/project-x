<?php

namespace App\Providers;

use Elasticsearch\Client;
use App\Cars\CarsRepository;
use Elasticsearch\ClientBuilder;
use App\Cars\EloquentCarsRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Cars\ElasticsearchCarsRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Validator::extend('not_default', function ($attribute, $value, $parameters, $validator) {
          if($value== "Any" || $value== "Select Parish") {
            return False;
          }

          return True;
      }, 'Please select an option!!');

      Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
          if(preg_match("/((\(\d{3}\) ?))?\d{3}-\d{4}/", $value)== 1) {
            return True;
          }
          return False;
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton(CarsRepository::class, function($app) {
          // This is useful in case we want to turn-off our
          // search cluster or when deploying the search
          // to a live, running application at first.
          if (!config('services.search.enabled')) {
              return new EloquentCarsRepository();
          }

          return new ElasticsearchCarsRepository(
              $app->make(Client::class)
          );
        });

        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
      $this->app->bind(Client::class, function ($app) {
          return ClientBuilder::create()
              ->setHosts(config('services.search.hosts'))
              ->build();
      });
    }
}
