<?php

namespace App\Http\Controllers;

use App\Cars\CarsRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    //
    public function search(Request $request, CarsRepository $repository){
      //dd($request->input());
    /*  if(!$request->input('filtered')){
        $query = $request->query('q');

        $filter = [
          'multi_match' => [
            'fields' => ['make', 'model'],
            'query' => $query,
            'type' => 'phrase_prefix'
          ]
        ];

        $cars = $repository->search($query, $filter);

        $cars = $this->collection_paginate($cars, 5, $request);

        return view('home', [
          'cars' => $cars,
        ]);
      }
      else{
        $filter = $this->buildFilter($request);*/
        $filter = [];
        $cars = $repository->search($query ="", $filter);

        $cars = $this->collection_paginate($cars, 5, $request);

        return view('home', [
          'cars' => $cars,
        ]);
      //}
    }


    private function buildFilter($request){
      $filter = [
        "bool" => [
        ]
      ];

      if($request->input('make') && $request->input('make') != "Any"){
        $filter["bool"]["must"] = [
          "match" => [
            "make" => $request->input("make")
          ]
        ];

        if($request->input('model') && $request->input('model') != "Any"){
          $filter["bool"]["should"] = [
            "match" => [
              "model" => "Not specified"
            ]
          ];
        }
      }

      if($request->input("price-radio") && $request->input("price-radio") != "Any"){
        $price = $request->input("price-radio");
        $filter["bool"]["should"]["range"] = [
            "price" => $this->setPriceRange($price)
          ];
      }

      if($request->input("min_year") && $request->input("min_year") != "Any"){
        $max_year = $request->input("max_year");
        $min_year = $request->input("min_year");

        if($max_year != "Any" && $min_year != "Any"){
          $filter["bool"]["must"]["range"]["year"] = [
            "lte" => $max_year,
            "gte" => $min_year
          ];
        }
        elseif ($max_year != "Any") {
          # code...
          $filter["bool"]["must"]["range"]["year"] = [
            "lte" => $max_year
          ];
        }
        elseif ($min_year != "Any") {
          # code...
          $filter["bool"]["must"]["range"]["year"] = [
            "gte" => $min_year
          ];
        }
      }


      dd($filter);
      return $filter;
    }

    private function setPriceRange($price){
      $prices = [
        "500000" => [
          "lte" => "500000"
        ],
        "1000000" => [
          "lte" => "1000000",
          "gte" => "500000"
        ],
        "5000000" => [
          "lte" => "5000000",
          "gte" => "1000000"
        ],
        "5000000+" => [
          "gte" => "5000000"
        ]
      ];

      return $prices[$price];

    }

    private function collection_paginate($items, $per_page, $request)
    {
      $page   = $request->input("page", 1);
      $offset = ($page * $per_page) - $per_page;
      $query = $request->input();

      if($request->input("filtered")){
        unset($query["_token"]);
        foreach ($request->input() as $key => $value) {
          # code...
          if($value == "Any"){
            unset($query[$key]);
          }
        }
      }

      return new LengthAwarePaginator(
        $items->forPage($page, $per_page)->all(),
        $items->count(),
        $per_page,
        Paginator::resolveCurrentPage(),
        ['path' => $request->url(), 'query' => $query]
      );
    }
}
