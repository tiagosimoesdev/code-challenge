<?php

namespace App\Domains\Countries\Controllers;


use App\Domains\Countries\Interfaces\CountryProviderInterface;
use App\Domains\Countries\Transformers\CountryTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CountriesController extends Controller
{
    public function __construct(
        protected CountryProviderInterface  $countryProvider,
        private readonly CountryTransformer $transformer,
    )
    {
    }

    public function index(): JsonResponse
    {
        $countries = $this->countryProvider->getAll();

        return response()->json(fractal($countries, $this->transformer));
    }

}
