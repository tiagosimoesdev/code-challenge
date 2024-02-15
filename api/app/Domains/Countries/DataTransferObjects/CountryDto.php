<?php

namespace App\Domains\Countries\DataTransferObjects;


class CountryDto
{
    public function __construct(
        public string $flag,
        public string $name,
    ) {
    }
}