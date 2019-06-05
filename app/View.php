<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    //
    protected $table = 'views';

    protected $fillable = [
        'id',
        'views'
    ];

    public function car()
    {
        return $this->belongsTo('App\Car', 'id');
    }
}
