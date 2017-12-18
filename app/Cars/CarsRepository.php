<?php
namespace App\Cars;

use Illuminate\Database\Eloquent\Collection;

interface CarsRepository
{
    public function search(string $query = ""): Collection;
}
