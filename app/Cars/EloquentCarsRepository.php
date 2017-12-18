<?php

namespace App\Cars;

use App\Car;
use Illuminate\Database\Eloquent\Collection;

class EloquentCarsRepository implements CarsRepository
{
    public function search(string $query = ""): Collection
    {
        return Car::where('make', 'like', "%{$query}%")
            ->orWhere('model', 'like', "%{$query}%")
            ->get();
    }
}
