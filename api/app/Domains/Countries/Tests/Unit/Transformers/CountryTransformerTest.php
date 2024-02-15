<?php

namespace App\Domains\Countries\Tests\Unit\Transformers;


use App\Domains\Countries\DataTransferObjects\CountryDto;
use App\Domains\Countries\Transformers\CountryTransformer;
use Tests\UnitTestCase;

class CountryTransformerTest extends UnitTestCase
{


    /** @test */
    public function it_transforms_country_fields(): void
    {
        $flag = 'flag1.svg';
        $name = 'Country1';

        $countryDto = new CountryDto(
            flag: $flag,
            name: $name
        );

        $transformed = (new CountryTransformer())->transform($countryDto);

        $this->assertEquals($countryDto->flag, $transformed['flag']);
        $this->assertEquals($countryDto->name, $transformed['name']);
    }
}
