<?php

namespace App\Http\Controllers;

use App\Car;
use App\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    //
    public function index($id) {
      $cars = new Car;

      $car = $cars->findOrFail($id);

      $images = Storage::allFiles('public/uploads/vehicles/'. $car->img);

      return view('car', [
        'car' => $car,
        'images' => $images
      ]);

    }

    public function myCar($user) {
      if ($user == str_replace(" ", "-", Auth::user()->name)) {
        $car = new Car;

        $cars = $car->where([
          ['seller', '=', Auth::user()->name]
          //['seller_id', '=', md5(Auth::user()->seller_id)], remove for developement
          ])->paginate(20);

        return view('mycars')->with('cars', $cars);
      }
    }

    public function viewMyCar($user, $id) {
      if ($user == str_replace(" ", "-", Auth::user()->name)) {
        $cars = new Car;
        $car = $cars->findOrFail($id);

        $images = Storage::allFiles('public/uploads/vehicles/'. $car->img);
        return view('mycar', [
          'car' => $car,
          'images' => $images
        ]);
      }
    }

    public function deleteCar($user, $id) {
      if ($user == str_replace(" ", "-", Auth::user()->name)) {

        $cars= new Car;
        $car = $cars->findOrFail($id);

        $directory = 'uploads/vehicles/'. $car->img;

        if($car->delete()) {
          storage::deleteDirectory($directory);
          return redirect()->back()->with('success', 'Vehicle deleted.');
        }
        else {
          return redirect()->back()->with('error', 'Looks like something went wrong.');
        }

      }
    }
}
