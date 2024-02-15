<?php

namespace App\Domains\Countries\Transformers;

use App\Domains\Countries\DataTransferObjects\CountryDto;
use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
{
    public function transform(CountryDto $country): array
    {
        return [
            'flag' => $country->flag,
            'name' => $country->name
        ];
    }
}