<?php

namespace App\Domains\Countries\Interfaces;

use App\Domains\Countries\DataTransferObjects\CountryDto;
use Illuminate\Support\Collection;


interface CountryProviderInterface
{
    /**
     * @return Collection<CountryDto>
     */
    public function getAll(): Collection;

}
