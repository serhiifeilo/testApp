<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->group(function () {

    Route::post('/', [CompanyController::class, 'store']);

    Route::get(
        '/{edrpou}/versions',
        [CompanyController::class, 'versions']
    );

    Route::controller(CompanyController::class)
        ->prefix('company')
        ->group(function () {

            Route::post('/', 'store');

            Route::get(
                '{edrpou}/versions',
                'versions'
            );

        });

});