<?php

return [

    'provider' => env('COUNTRY_PROVIDER', 'rest-countries'),
    'providers' => [
        'rest-countries' => [
            'url' => env('REST_COUNTRIES_URL', 'https://restcountries.com/v3.1/all?fields=name,flags'),
        ],
    ]

];
