<?php

namespace App;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use Searchable;

    protected $table = 'cars';

    protected $fillable = [
      'make',
      'model',
      'year',
      'price',
      'img',
      'seller',
      'contact',
      'location',
      'transmission',
      'mileage',
      'description',
      'condition',
      'body_type'
    ];

    public function view()
    {
      return $this->hasOne('App\View', 'id');
    }
}
