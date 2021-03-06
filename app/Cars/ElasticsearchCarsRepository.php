<?php

namespace App\Cars;

use App\Car;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchCarsRepository implements CarsRepository
{
    private $search;

    public function __construct(Client $client) {
        $this->search = $client;
    }

    public function search(string $query = "", $filter = []): Collection
    {
        $items = $this->searchOnElasticsearch($query, $filter);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query, $filter): array
    {
    	$instance = new Car;

        $items = $this->search->search([
            'index' => $instance->getSearchIndex(),
            'type' => $instance->getSearchType(),
            'body' => [
                'query' => [
                  "bool" => [
                    "must" => [
                      "match" => [
                        "make" => "Ford"
                      ]
                    ],
                    "should" => [
                      "match" => [
                        "model" => "Not specified"
                      ]
                    ]
                  ]
                ]
            ],
        ]);
        return $items;
    }

    private function buildCollection(array $items): Collection
    {
        /**
         * The data comes in a structure like this:
         *
         * [
         *      'hits' => [
         *          'hits' => [
         *              [ '_source' => 1 ],
         *              [ '_source' => 2 ],
         *          ]
         *      ]
         * ]
         *
         * And we only care about the _source of the documents.
        */
        $hits = array_pluck($items['hits']['hits'], '_source') ?: [];

        $sources = array_map(function ($source) {
            // The hydrate method will try to decode this
            // field but ES gives us an array already.
            return $source;
        }, $hits);

        // We have to convert the results array into Eloquent Models.
        return Car::hydrate($sources);
    }
}
