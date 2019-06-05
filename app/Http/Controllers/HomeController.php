<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index() {
      $car = new Car;
      $cars = $car->join('views', 'cars.id', '=', 'views.id')->paginate(20);

      return view('home', ['cars'=> $cars]);
    }

    public function search(Request $request) {
      $car = new Car;
      $query = $request->input('q');

      $cars = $car->where('make', 'like', "$query%")
                  ->orWhere('model', 'like', "$query%")->paginate(20, ['*'], 'page', null, ['q' => $query]);

      if(count($cars)) {
          return view('home')->with('cars', $cars);
      }
      else {
        return redirect()->back()->with('error', 'No vehicle found!!');
      }
    }

    public function filterSearch(Request $request) {

      $car = new Car;
      $filters = $request->input();
      $w_query = []; //where query array
      $wpb_query = []; //where price between query
      $wyb_query = []; //where year between query

      if (end($filters) == '_token') {
        array_pop($filters);
      }

      //assign make
      if($filters['make'] && $filters['make'] !== 'Any') {
        array_push($w_query, ['make', '=',$filters['make']]);
      }

      //assign model
      if($filters['model'] && $filters['model'] !== 'Any') {
        array_push($w_query, ['model', '=',$filters['model']]);
      }

      //assign condition
      if($filters['condition'] && $filters['condition'] !== 'Any') {
        array_push($w_query, ['condition', '=',$filters['condition']]);
      }

      //assign transmission
      if($filters['transmission'] && $filters['transmission'] !== 'Any') {
        array_push($w_query, ['transmission', '=',$filters['transmission']]);
      }

      //asign price
      if($filters['price-radio']) {
        if ($filters['price-radio'] !== 'Any') {
          $price = $filters['price-radio'];
          if($price == "500000") {
            $wpb_query = ['price', [0, $price]];
          }
          else if($price == '1000000') {
            $wpb_query = ['price', [500000, $price]];
          }
          else if($price == '5000000') {
            $wpb_query = ['price', [1000000, $price]];
          }
          else if($price == "5000000+") {
            array_push($w_query, ['price', '>=', '5000000']);
          }
        }
        
      }

      //assign year
      if($filters['min_year'] != 'Any' && $filters['max_year'] == 'Any') {
        array_push($w_query, ['year', '>=', $filters['min_year']]);
      }
      else if($filters['max_year'] != 'Any' && $filters['min_year'] == 'Any') {
        array_push($w_query, ['year', '<=', $filters['max_year']]);
      }
      else if($filters['min_year'] != 'Any' && $filters['max_year'] != 'Any') {
        $wyb_query = ['year', [(int)$filters['min_year'], (int)$filters['max_year']]];
      }

      $cars = $car->where($w_query);
      if(!empty($wpb_query) && count($cars)) {
        $cars = $cars->whereBetween($wpb_query[0], $wpb_query[1]);
      }
      if(!empty($wyb_query) && count($cars)) {
        $cars = $cars->whereBetween($wyb_query[0], $wyb_query[1]);
      }

      if(count($cars->paginate())) {
        $request->session()->flash('error', false);
          return view('home')->with('cars', $cars->paginate(20, ['*'], 'page', null, $filters));
      }
      else {
        $request->session()->flash('error', 'No vehicle found');
        return view('home')->with('cars', $car->paginate(20));
      }
    }


}
