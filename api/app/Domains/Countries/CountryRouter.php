<?php

use App\Domains\Countries\Controllers\CountriesController;
use Illuminate\Support\Facades\Route;

Route::controller(CountriesController::class)->group(function () {
    Route::get('/', 'index')->name('.index');
});

