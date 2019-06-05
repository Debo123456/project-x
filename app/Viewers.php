<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewers extends Model
{
    //
    protected $table = 'viewers';

    protected $fillable = [
        'id',
        'car_id',
        'user_id',
        'cookie',
        'ip_address'
    ];
}
