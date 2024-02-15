<?php

namespace App\Domains\Countries\Exceptions;

use Exception;

class CountryProviderException extends Exception
{
    public static function failedToFetchCountries(): self
    {
        return new self('Failed to fetch countries');
    }
}