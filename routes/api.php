<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::controller(CompanyController::class)->group(function () {
    Route::post('/company', 'store');

    Route::get('/company/{edrpou}/versions', 'versions');
});